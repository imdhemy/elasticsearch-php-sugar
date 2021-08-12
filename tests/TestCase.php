<?php


namespace Tests;


use Elasticsearch\ClientBuilder;
use Faker\Factory;
use Imdhemy\EsSugar\Client;
use Imdhemy\EsSugar\Contracts\ManagerInterface;
use Imdhemy\EsSugar\Manager;

/**
 * Class TestCase
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $faker;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = new Faker(Factory::create());
    }

    /**
     * @inheritDoc
     */
    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }

    /**
     * @param MockHandler $handler
     * @return ManagerInterface
     */
    protected function getManager(MockHandler $handler): ManagerInterface
    {
        $baseClient = ClientBuilder::create()->setHandler($handler)->build();
        $client = new Client($baseClient);
        return new Manager($client);
    }
}
