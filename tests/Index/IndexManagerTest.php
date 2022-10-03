<?php

namespace Imdhemy\EsSugar\Tests\Index;

use Elastic\Elasticsearch\ClientBuilder;
use Imdhemy\EsSugar\Index\Index;
use Imdhemy\EsSugar\Index\IndexManager;
use Imdhemy\EsSugar\Responses\ResponseFactory;
use PHPUnit\Framework\TestCase;

class IndexManagerTest extends TestCase
{
    /**
     * @var IndexManager
     */
    private IndexManager $sut;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $client = ClientBuilder::create()->build();
        $client->indices()->delete(['index' => 'my_index']);
        $responseFactory = new ResponseFactory();

        $this->sut = new IndexManager($client, $responseFactory);
    }

    /**
     * @test
     */
    public function create(): void
    {
        $index = new Index();
        $response = $this->sut->create($index);
        $this->assertNotNull($response);
    }
}
