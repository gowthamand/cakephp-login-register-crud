<?php
namespace App\Model\Redis;

use App\Model\Entity\User;
use Cake\I18n\FrozenTime;

/**
 * Stores users in Upstash Redis (REST API). All keys start with "ck_".
 *   ck_users:seq        INCR counter
 *   ck_users:ids        SET of ids
 *   ck_users:{id}       JSON document
 *   ck_users:usernames  HASH username -> id
 */
class RedisUserStore {

    const P = 'ck_users';

    private function cmd(array $args) {
        $ch = curl_init(rtrim(getenv('UPSTASH_REDIS_REST_URL'), '/'));
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($args),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . getenv('UPSTASH_REDIS_REST_TOKEN'),
                'Content-Type: application/json',
            ],
        ]);
        $res = json_decode(curl_exec($ch), true);
        curl_close($ch);
        if (!is_array($res) || isset($res['error'])) {
            throw new \RuntimeException('Redis error: ' . ($res['error'] ?? 'no response'));
        }
        return $res['result'];
    }

    private function toEntity($json) {
        if (!$json) {
            return null;
        }
        $d = json_decode($json, true);
        foreach (['created', 'modified'] as $f) {
            $d[$f] = new FrozenTime($d[$f]);
        }
        $u = new User();
        $u->set($d, ['setter' => false, 'guard' => false]);
        $u->isNew(false);
        return $u;
    }

    public function all() {
        $users = [];
        foreach ($this->cmd(['SMEMBERS', self::P . ':ids']) as $id) {
            $users[] = $this->get($id);
        }
        $users = array_filter($users);
        usort($users, function ($a, $b) { return $a->id <=> $b->id; });
        return $users;
    }

    public function get($id) {
        return $this->toEntity($this->cmd(['GET', self::P . ':' . (int)$id]));
    }

    public function findByUsername($username) {
        $id = $this->cmd(['HGET', self::P . ':usernames', $username]);
        return $id ? $this->get($id) : null;
    }

    /** Returns false if the username is taken by another user. */
    public function save(User $user) {
        $existing = $this->findByUsername($user->username);
        if ($existing && $existing->id != $user->id) {
            return false;
        }
        $now = gmdate('c');
        if ($user->isNew()) {
            $user->id = (int)$this->cmd(['INCR', self::P . ':seq']);
            $created = $now;
            $this->cmd(['SADD', self::P . ':ids', $user->id]);
        } else {
            $old = $this->get($user->id);
            $created = $old->created->toIso8601String();
            if ($old->username !== $user->username) {
                $this->cmd(['HDEL', self::P . ':usernames', $old->username]);
            }
        }
        $doc = [
            'id' => $user->id, 'name' => $user->name, 'username' => $user->username,
            'password' => $user->password, 'role' => $user->role,
            'created' => $created, 'modified' => $now,
        ];
        $this->cmd(['SET', self::P . ':' . $user->id, json_encode($doc)]);
        $this->cmd(['HSET', self::P . ':usernames', $user->username, $user->id]);
        return true;
    }

    public function delete($id) {
        $u = $this->get($id);
        if (!$u) {
            return false;
        }
        $this->cmd(['DEL', self::P . ':' . (int)$id]);
        $this->cmd(['SREM', self::P . ':ids', $id]);
        $this->cmd(['HDEL', self::P . ':usernames', $u->username]);
        return true;
    }
}
