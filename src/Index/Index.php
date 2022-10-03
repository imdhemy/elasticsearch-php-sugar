<?php

namespace Imdhemy\EsSugar\Index;

use Illuminate\Support\Str;

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
    public function setIndex(?string $index): Index
    {
        $this->index = $index;

        return $this;
    }
}
