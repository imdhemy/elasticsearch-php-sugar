<?php

namespace Imdhemy\EsSugar\ValueObjects;

use ArrayObject as BaseArrayObject;

/**
 * Class ArrayObject
 * This class allows objects to work as arrays
 */
class ArrayObject extends BaseArrayObject
{
    /**
     * Checks if this object is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->getArrayCopy());
    }
}
