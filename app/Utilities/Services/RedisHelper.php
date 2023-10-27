<?php

namespace App\Utilities\Services;

use App\Utilities\Contracts\RedisHelperInterface;
use Illuminate\Support\Facades\Redis;

class RedisHelper implements RedisHelperInterface
{


    /**
     * get all as an associative array
     * @return mixed
     */
    public function list(string $id = '*'): mixed
    {
        return Redis::HGETALL('emails.'. $id);
    }

    /**
     * set user_details --redis_key-- and --redis_value-- as array of key_values
     * @param mixed $id
     * @param string $messageSubject
     * @param string $toEmailAddress
     * @return void
     */
    public function storeRecentMessage(mixed $id, string $messageSubject, string $toEmailAddress): void
    {
        Redis::HSET('emails.' . $id ,compact('id','messageSubject','toEmailAddress'));
    }
}