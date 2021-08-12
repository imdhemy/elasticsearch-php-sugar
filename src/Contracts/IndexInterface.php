<?php


namespace Imdhemy\EsSugar\Contracts;

use Stringable;

interface IndexInterface extends Stringable
{
    /**
     * @return string
     */
    public function getName(): string;
}
