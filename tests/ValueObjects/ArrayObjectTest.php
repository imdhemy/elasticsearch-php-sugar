<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Tests\ValueObjects;

use Imdhemy\EsSugar\Tests\TestCase;
use Imdhemy\EsSugar\ValueObjects\ArrayObject;

class ArrayObjectTest extends TestCase
{
    /**
     * @test
     */
    public function is_empty(): ArrayObject
    {
        $sut = new ArrayObject();

        $this->assertTrue($sut->isEmpty());

        return $sut;
    }

    /**
     * @test
     * @depends is_empty
     */
    public function is_empty_should_return_false_if_not_empty(ArrayObject $sut): void
    {
        $sut->append('foo');

        $this->assertFalse($sut->isEmpty());
    }
}
