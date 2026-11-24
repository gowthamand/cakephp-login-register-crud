<?php
namespace App\Model\Redis;

/** Minimal Upstash Redis REST client. */
class RedisClient {

    public static function cmd(array $args) {
        $url = getenv('UPSTASH_REDIS_REST_URL');
        if (!$url || !getenv('UPSTASH_REDIS_REST_TOKEN')) {
            throw new \RuntimeException('Redis env vars UPSTASH_REDIS_REST_URL / UPSTASH_REDIS_REST_TOKEN are not set');
        }
        $ch = curl_init(rtrim($url, '/'));
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($args),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . getenv('UPSTASH_REDIS_REST_TOKEN'),
                'Content-Type: application/json',
            ],
        ]);
        $body = curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);
        if ($body === false) {
            throw new \RuntimeException('Redis request failed: ' . $curlError);
        }
        $res = json_decode($body, true);
        if (!is_array($res) || isset($res['error'])) {
            throw new \RuntimeException('Redis error: ' . ($res['error'] ?? 'no response'));
        }
        return $res['result'];
    }
}
