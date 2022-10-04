<?php

namespace Imdhemy\EsSugar\Attributes;

use Attribute;

#[Attribute]
final class IndexName
{
    /**
     * @param string|null $name The name of the index
     */
    public function __construct(public ?string $name = null)
    {
    }
}
