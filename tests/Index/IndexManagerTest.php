<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Tests\Index;

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
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->responseFactory = new ResponseFactory();
    }

    /**
     * @test
     */
    public function create(): void
    {
        $expected = $this->faker->esCreateIndex();
        $client = EsMocker::mock($expected)->build();
        $sut = new IndexManager($client, $this->responseFactory);

        $index = $this->getMockForAbstractClass(Index::class);
        $response = $sut->create($index);
        $this->assertEquals($expected, $response->asArray());
    }
}
