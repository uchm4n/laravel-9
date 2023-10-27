<?php

namespace Tests\Unit;

use App\Utilities\Services\ElasticHelper;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use PHPUnit\Framework\TestCase;

class TestElasticHelper extends TestCase
{

    public ElasticHelper $elasticHelper;

    public function __construct()
    {
        parent::__construct();

        $client = ClientBuilder::create()
            ->setHosts(config('elasticsearch.connections.default.hosts'))
            ->build();


        $this->elasticHelper = new ElasticHelper($client);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_all_data()
    {
        $data = data_get($this->elasticHelper->listAllEmails(), 'hits.hits.*._source');

        $this->assertArrayHasKey('email', $data);
        $this->assertArrayHasKey('subject', $data);
        $this->assertArrayHasKey('body', $data);
    }


    public function test_send_function()
    {

        $data = $this->elasticHelper->storeEmail('testing body','testing subject','testing@gmail.com');

        $this->assertArrayHasKey('result', $data);
        $this->assertContains('created',$data['result']);
    }



}
