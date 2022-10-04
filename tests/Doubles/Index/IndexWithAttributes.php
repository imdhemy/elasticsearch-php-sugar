<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Tests\Doubles\Index;

use Imdhemy\EsSugar\{Attributes\IndexName, Attributes\IndexSettings, Index\Index};

#[IndexName('test_index')]
#[IndexSettings([
    'number_of_shards' => 1,
    'number_of_replicas' => 1,
])]
class IndexWithAttributes extends Index
{
}
