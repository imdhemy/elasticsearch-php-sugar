<?php

declare(strict_types=1);

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

    /**
     * Excludes the provided keys from the array and return a new ArrayObject
     *
     * @param array $keys
     *
     * @return self
     */
    public function exclude(array $keys): self
    {
        $data = $this->getArrayCopy();

        $values = array_diff_key($data, array_flip($keys));

        return new self($values);
    }
}
