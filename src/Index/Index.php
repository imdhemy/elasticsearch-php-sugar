<?php

namespace Imdhemy\EsSugar\Index;

use Illuminate\Support\Str;
use Imdhemy\EsSugar\Attributes\IndexName;
use ReflectionClass;

/**
 * Elasticsearch base index class
 *
 * @property string $index;
 */
abstract class Index implements EsIndex
{
    /**
     * @var string|null
     */
    protected ?string $index = null;

    /**
     * Gets the index name
     *
     * @return string
     */
    public function getName(): string
    {
        if (null !== $this->index) {
            return $this->index;
        }

        $reflection = new ReflectionClass($this);
        $attributes = $reflection->getAttributes(IndexName::class);

        if (isset($attributes[0])) {
            $this->index = $attributes[0]->newInstance()->name;
        }

        return $this->index ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    /**
     * Gets index settings
     *
     * @return IndexSettings
     */
    public function getSettings(): IndexSettings
    {
        return new IndexSettings();
    }

    /**
     * Gets index mappings
     *
     * @return IndexMappings
     */
    public function getMappings(): IndexMappings
    {
        return new IndexMappings();
    }

    /**
     * @param string|null $index
     *
     * @return Index
     */
    public function setIndex(?string $index): self
    {
        $this->index = $index;

        return $this;
    }
}
