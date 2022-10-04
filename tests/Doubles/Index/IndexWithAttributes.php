<?php

namespace Imdhemy\EsSugar\Tests\Doubles\Index;

use Imdhemy\EsSugar\Attributes\IndexName;
use Imdhemy\EsSugar\Index\Index;

#[IndexName('test_index')]
class IndexWithAttributes extends Index
{
}
