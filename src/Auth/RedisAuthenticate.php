<?php
namespace App\Auth;

use App\Model\Redis\RedisUserStore;
use Cake\Auth\BaseAuthenticate;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

class RedisAuthenticate extends BaseAuthenticate {

    public function authenticate(ServerRequest $request, Response $response) {
        $username = $request->getData('username');
        $password = $request->getData('password');
        if (!$username || !$password) {
            return false;
        }
        $user = (new RedisUserStore())->findByUsername($username);
        if (!$user || !(new DefaultPasswordHasher)->check($password, $user->password)) {
            return false;
        }
        $data = $user->toArray();
        unset($data['password']);
        return $data;
    }
}
