<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Tests;

use Imdhemy\EsUtils\Faker;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Faker
     */
    protected Faker $faker;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Faker::create();
    }
}
