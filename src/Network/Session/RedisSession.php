<?php
namespace App\Network\Session;

use App\Model\Redis\RedisClient;
use SessionHandlerInterface;

/** Stores PHP sessions in Redis under ck_sessions:{id}. */
class RedisSession implements SessionHandlerInterface {

    public function open($path, $name) { return true; }

    public function close() { return true; }

    public function read($id) {
        return (string)RedisClient::cmd(['GET', 'ck_sessions:' . $id]);
    }

    public function write($id, $data) {
        RedisClient::cmd(['SET', 'ck_sessions:' . $id, $data, 'EX', (string)max(60, (int)ini_get('session.gc_maxlifetime'))]);
        return true;
    }

    public function destroy($id) {
        RedisClient::cmd(['DEL', 'ck_sessions:' . $id]);
        return true;
    }

    public function gc($max) { return true; }
}
