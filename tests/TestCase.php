<?php


namespace Tests;


use Faker\Factory;

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
}
