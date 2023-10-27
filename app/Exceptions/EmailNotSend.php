<?php

namespace App\Exceptions;

class EmailNotSend extends \Exception
{

    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::debug('Emails is not sent'); // can dump more than this. trace file etc..
    }
}