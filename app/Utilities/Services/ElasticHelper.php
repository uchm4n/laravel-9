<?php

namespace App\Utilities\Services;

use App\Models\User;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;


class ElasticHelper implements ElasticsearchHelperInterface
{

    public function __construct(public ClientBuilder|Client|null $client = null)
    {
        $this->client = ClientBuilder::create()
            ->setHosts(config('elasticsearch.connections.default.hosts'))
            ->build();
    }

    public function listAllEmails(): mixed
    {

        // search query
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
        ];

        return $this->client->search($params);
    }

    public function storeEmail(string $messageBody, string $messageSubject, string $toEmailAddress): mixed
    {
        $data = [
            'body' => [
                'email' => $toEmailAddress,
                'subject' => $messageSubject,
                'body' => $messageBody
            ],
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => str()->random(),
        ];

        return $this->client->index($data);
    }
}