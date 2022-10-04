<?php

namespace Imdhemy\EsSugar\Tests\Doubles\Index;

use Imdhemy\EsSugar\Attributes\IndexName;
use Imdhemy\EsSugar\Attributes\IndexSettings;
use Imdhemy\EsSugar\Index\Index;

#[IndexName('test_index')]
#[IndexSettings([
    'number_of_shards' => 1,
    'number_of_replicas' => 1,
])]
class IndexWithAttributes extends Index
{
}
