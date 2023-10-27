<?php

namespace Tests\Unit;

use App\Utilities\Services\ElasticHelper;
use App\Utilities\Services\RedisHelper;
use Elasticsearch\ClientBuilder;
use PHPUnit\Framework\TestCase;

class TestRedisHelper extends TestCase
{

    private RedisHelper $redisHelper;

    public function __construct()
    {
        parent::__construct();

        $this->redisHelper = new RedisHelper();
    }


    public function test_store_data()
    {
        $data = $this->redisHelper->storeRecentMessage('1', 'testing redis', 'testing@gmail.com');
        $this->assertEquals(null, $data);
    }


    public function test_get_all_data()
    {
        $data = $this->redisHelper->list(1);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('messageSubject', $data);
        $this->assertArrayHasKey('toEmailAddress', $data);
    }
}
