<?php
namespace App\Model\Redis;

/** Minimal Upstash Redis REST client. */
class RedisClient {

    /** Reads REDIS_REST_*, falling back to the older UPSTASH_REDIS_REST_* names. */
    public static function config($key) {
        return getenv('REDIS_REST_' . $key) ?: getenv('UPSTASH_REDIS_REST_' . $key);
    }

    public static function cmd(array $args) {
        $url = self::config('URL');
        $token = self::config('TOKEN');
        if (!$url || !$token) {
            throw new \RuntimeException('Redis env vars REDIS_REST_URL / REDIS_REST_TOKEN are not set');
        }
        $ch = curl_init(rtrim($url, '/'));
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($args),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $token,
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
