<?php

namespace App\Utilities\Services;

use App\Utilities\Contracts\RedisHelperInterface;

class RedisHelper implements RedisHelperInterface
{


    public function list(): mixed
    {
        // TODO: Implement list() method.
    }

    public function storeRecentMessage(mixed $id, string $messageSubject, string $toEmailAddress): void
    {
        // TODO: Implement storeRecentMessage() method.
    }
}