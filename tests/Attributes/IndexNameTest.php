<?php

namespace Imdhemy\EsSugar\Tests\Attributes;

use Imdhemy\EsSugar\Tests\Doubles\Index\IndexWithAttributes;
use Imdhemy\EsSugar\Tests\TestCase;

class IndexNameTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_set_the_index_name(): void
    {
        $index = new IndexWithAttributes();

        $this->assertEquals('test_index', $index->getName());
    }
}
