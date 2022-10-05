<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Tests\Index;

use Imdhemy\EsSugar\Attributes\IndexSettings;
use Imdhemy\EsSugar\Index\EsIndex;
use Imdhemy\EsSugar\Index\Index;
use Imdhemy\EsSugar\Index\IndexManager;
use Imdhemy\EsSugar\Responses\ResponseFactory;
use Imdhemy\EsSugar\Responses\ResponseFactoryInterface;
use Imdhemy\EsSugar\Tests\TestCase;
use Imdhemy\EsUtils\EsMocker;

class IndexManagerTest extends TestCase
{
    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    /**
     * @test
     */
    public function create(): EsIndex
    {
        $expected = $this->faker->esCreateIndex();
        $client = EsMocker::mock($expected)->build();
        $sut = new IndexManager($client, $this->responseFactory);

        $index = $this->getMockForAbstractClass(Index::class);
        $response = $sut->create($index);
        $this->assertEquals($expected, $response->asArray());

        return $index;
    }

    /**
     * @test
     */
    public function delete(): void
    {
        $expected = $this->faker->esDeleteIndex();
        $client = EsMocker::mock($expected)->build();
        $sut = new IndexManager($client, $this->responseFactory);

        $index = $this->getMockForAbstractClass(Index::class);
        $response = $sut->delete($index);
        $this->assertEquals($expected, $response->asArray());
    }

    /**
     * @test
     */
    public function update_updates_index_settings(): void
    {
        $expected = $this->faker->esPutIndexSettings();
        $client = EsMocker::mock($expected)->build();
        $sut = new IndexManager($client, $this->responseFactory);

        $index = $this->getMockForAbstractClass(Index::class);
        $indexSettings = new IndexSettings([
            'number_of_replicas' => 0,
            'refresh_interval' => -1,
        ]);
        $index->setSettings($indexSettings);

        $response = $sut->update($index);
        $this->assertEquals($expected, $response->asArray());
    }

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->responseFactory = new ResponseFactory();
    }
}
