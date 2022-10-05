<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Tests\Index;

use Imdhemy\EsSugar\Attributes\IndexMappings;
use Imdhemy\EsSugar\Attributes\IndexSettings;
use Imdhemy\EsSugar\Index\Index;
use Imdhemy\EsSugar\Tests\Doubles\Index\Example;
use Imdhemy\EsSugar\Tests\Doubles\Index\IndexWithAttributes;
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

    /**
     * @test
     */
    public function set_settings_accepts_an_array(): void
    {
        $sut = new Example();
        $settings = [
            'number_of_shards' => 1,
            'number_of_replicas' => 0,
        ];

        $sut->setSettings($settings);

        $this->assertEquals($settings, $sut->getSettings()->getArrayCopy());
    }

    /**
     * @test
     */
    public function set_settings_accepts_array_object(): void
    {
        $sut = new Example();
        $settings = [
            'number_of_shards' => 1,
            'number_of_replicas' => 0,
        ];

        $sut->setSettings(new IndexSettings($settings));

        $this->assertEquals($settings, $sut->getSettings()->getArrayCopy());
    }

    /**
     * @test
     */
    public function get_index_settings(): void
    {
        $sut = new IndexWithAttributes();

        $expected = [
            'number_of_shards' => 1,
            'number_of_replicas' => 1,
        ];
        $this->assertEquals($expected, $sut->getSettings()->getArrayCopy());
    }

    /**
     * @test
     */
    public function set_mappings_accepts_an_array(): void
    {
        $sut = new Example();
        $mappings = [
            'properties' => [
                'name' => [
                    'type' => 'text',
                ],
            ],
        ];

        $sut->setMappings($mappings);

        $this->assertEquals($mappings, $sut->getMappings()->getArrayCopy());
    }

    /**
     * @test
     */
    public function set_mappings_accepts_an_array_object(): void
    {
        $sut = new Example();
        $mappings = [
            'properties' => [
                'name' => [
                    'type' => 'text',
                ],
            ],
        ];

        $sut->setMappings(new IndexMappings($mappings));

        $this->assertEquals($mappings, $sut->getMappings()->getArrayCopy());
    }

    /**
     * @test
     */
    public function get_mappings(): void
    {
        $sut = new IndexWithAttributes();

        $expected = [
            'properties' => [
                'name' => [
                    'type' => 'text',
                    'analyzer' => 'standard',
                ],
            ],
        ];
        $this->assertEquals($expected, $sut->getMappings()->getArrayCopy());
    }
}
