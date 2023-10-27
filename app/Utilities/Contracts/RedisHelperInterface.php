<?php

namespace App\Utilities\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RedisHelperInterface {

    /**
     * get all data
     * @return mixed
     */
    public function list(): mixed;



    /**
     * Store the id of a message along with a message subject in Redis.
     *
     * @param  mixed  $id
     * @param  string  $messageSubject
     * @param  string  $toEmailAddress
     * @return void
     */
    public function storeRecentMessage(mixed $id, string $messageSubject, string $toEmailAddress): void;
}
