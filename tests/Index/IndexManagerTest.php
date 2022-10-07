<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Tests\Index;

use Imdhemy\EsSugar\Attributes\IndexMappings;
use Imdhemy\EsSugar\Attributes\IndexSettings;
use Imdhemy\EsSugar\Index\EsIndex;
use Imdhemy\EsSugar\Index\Index;
use Imdhemy\EsSugar\Index\IndexManager;
use Imdhemy\EsSugar\Responses\ResponseFactory;
use Imdhemy\EsSugar\Responses\ResponseFactoryInterface;
use Imdhemy\EsSugar\Tests\TestCase;
use Imdhemy\EsUtils\Assertions\IndexAssertions;
use Imdhemy\EsUtils\EsMocker;

class IndexManagerTest extends TestCase
{
    use IndexAssertions;

    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    /**
     * @test
     */
    public function delete(): void
    {
        $expected = $this->faker->esDeleteIndex();
        $history = [];
        $client = EsMocker::mock($expected)->build($history);
        $sut = new IndexManager($client, $this->responseFactory);

        $index = $this->getMockForAbstractClass(Index::class);
        $response = $sut->delete($index);
        $this->assertEquals($expected, $response->asArray());
        $this->assertRequestedDeleteIndex($history, $index->getName());
    }

    /**
     * @test
     */
    public function update_updates_index_settings(): void
    {
        $expected = $this->faker->esPutIndexSettings();
        $history = [];
        $client = EsMocker::mock($expected)->build($history);
        $sut = new IndexManager($client, $this->responseFactory);

        $index = $this->getMockForAbstractClass(Index::class);
        $indexSettings = new IndexSettings([
            'number_of_replicas' => 0,
            'refresh_interval' => -1,
        ]);
        $index->setSettings($indexSettings);

        $response = $sut->update($index);

        $this->assertEquals($expected, $response->asArray());
        $this->assertRequestedPutIndexSettingsWith($history, $index->getName(), $indexSettings->getArrayCopy());
    }

    /**
     * @test
     */
    public function update_updates_index_mappings(): void
    {
        $expected = $this->faker->esPutIndexMappings();
        $history = [];
        $client = EsMocker::mock($expected)->build($history);
        $sut = new IndexManager($client, $this->responseFactory);

        $index = $this->getMockForAbstractClass(Index::class);
        $index->setMappings(
            new IndexMappings([
                'properties' => [
                    'name' => [
                        'type' => 'text',
                        'analyzer' => 'standard',
                    ],
                ],
            ])
        );

        $response = $sut->update($index);

        $this->assertEquals($expected, $response->asArray());
        $this->assertRequestedPutIndexMappingsWith($history, $index->getName(), $index->getMappings()->getArrayCopy());
    }

    /**
     * @test
     */
    public function create(): EsIndex
    {
        $expected = $this->faker->esCreateIndex();
        $history = [];
        $client = EsMocker::mock($expected)->build($history);
        $sut = new IndexManager($client, $this->responseFactory);

        $index = $this->getMockForAbstractClass(Index::class);

        $response = $sut->create($index);

        $this->assertEquals($expected, $response->asArray());
        $this->assertRequestedCreateIndex(
            $history,
            $index->getName(),
            $index->getSettings()->getArrayCopy(),
            $index->getMappings()->getArrayCopy()
        );

        return $index;
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
