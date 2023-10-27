<?php

namespace App\Utilities\Contracts;

interface ElasticsearchHelperInterface {

    /**
     * get all email data
     * @return mixed
     */
    public function listAllEmails(): mixed;

    /**
     * Store the email's message body, subject and to address inside elasticsearch.
     *
     * @param  string  $messageBody
     * @param  string  $messageSubject
     * @param  string  $toEmailAddress
     * @return mixed - Return the id of the record inserted into Elasticsearch
     */
    public function storeEmail(string $messageBody, string $messageSubject, string $toEmailAddress): mixed;
}
