<?php

namespace Imdhemy\EsSugar\Tests\Index;

use Imdhemy\EsSugar\Index\Index;
use Imdhemy\EsSugar\Tests\Doubles\Index\Example;
use Imdhemy\EsSugar\Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * @test
     */
    public function get_name_qualifies_class_name(): Index
    {
        $sut = new Example();

        $this->assertEquals('examples', $sut->getName());

        return $sut;
    }

    /**
     * @test
     * @depends get_name_qualifies_class_name
     */
    public function get_name_uses_index_attribute_if_exists(Index $sut): void
    {
        $sut->setIndex('example');

        $this->assertEquals('example', $sut->getName());
    }
}
