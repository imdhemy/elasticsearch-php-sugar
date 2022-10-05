<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Tests\Doubles\Index;

use Imdhemy\EsSugar\{Attributes\IndexMappings, Attributes\IndexName, Attributes\IndexSettings, Index\Index};

#[IndexName('test_index')]
#[IndexSettings([
    'number_of_shards' => 1,
    'number_of_replicas' => 1,
])]
#[IndexMappings([
    'properties' => [
        'name' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
    ],
])]
class IndexWithAttributes extends Index
{
}
