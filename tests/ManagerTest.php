<?php

namespace Tests;

use Imdhemy\EsSugar\Contracts\IndexInterface;
use Imdhemy\EsSugar\Contracts\ManagerInterface;
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
     * @var string
     */
    private $indexName;

    /**
     * @var MockHandler
     */
    private $mockHandler;

    /**
     * @var ManagerInterface
     */
    private $manager;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->indexName = $this->faker->index();
        $this->mockHandler = $this->faker->mockHandler('create_index', ['index' => $this->indexName]);
        $this->manager = $this->getManager($this->mockHandler);
    }

    /**
     * @test
     */
    public function test_it_can_create_an_index()
    {
        $index = new Index($this->indexName);
        $this->manager->createIndex($index);

        $transaction = $this->mockHandler->getTransactions()[0];

        $this->assertEquals(sprintf('/%s', $this->indexName), $transaction->getRequest()->getUri());
        $this->assertEquals('PUT', $transaction->getRequest()->getMethod());
        $this->assertEquals(
            [
                'acknowledged' => true,
                'shards_acknowledged' => true,
                'index' => $this->indexName,
            ],
            $transaction->getResponse()->getBody()
        );
    }

    /**
     * @test
     */
    public function test_it_can_create_index_by_scalar_name()
    {
        $indexName = $this->faker->index();
        $mockHandler = $this->faker->mockHandler('create_index', ['index' => $indexName]);
        $manager = $this->getManager($mockHandler);

        $index = $manager->createIndexByName($indexName);
        $this->assertInstanceOf(IndexInterface::class, $index);

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
