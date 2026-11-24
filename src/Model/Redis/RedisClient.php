<?php
namespace App\Model\Redis;

/** Minimal Upstash Redis REST client. */
class RedisClient {

    public static function cmd(array $args) {
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
}
