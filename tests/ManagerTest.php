<?php

namespace Tests;

use Elasticsearch\ClientBuilder;
use Imdhemy\EsSugar\Client;
use Imdhemy\EsSugar\Index;
use Imdhemy\EsSugar\Manager;

/**
 * Class ManagerTest
 * @package Imdhemy\EsSugar
 * @link Manager
 */
class ManagerTest extends TestCase
{
    /**
     * @test
     */
    public function test_it_can_create_an_index()
    {
        $indexName = $this->faker->index();
        $mockHandler = $this->faker->mockHandler('create_index', ['index' => $indexName]);

        $baseClient = ClientBuilder::create()->setHandler($mockHandler)->build();

        $client = new Client($baseClient);
        $manager = new Manager($client);

        $index = new Index($indexName);

        $manager->createIndex($index);

        $transaction = $mockHandler->getTransactions()[0];

        $this->assertEquals(sprintf('/%s', $indexName), $transaction->getRequest()->getUri());
        $this->assertEquals('PUT', $transaction->getRequest()->getMethod());
        $this->assertEquals(
            [
                'acknowledged' => true,
                'shards_acknowledged' => true,
                'index' => $indexName,
            ],
            $transaction->getResponse()->getBody()
        );
    }
}
