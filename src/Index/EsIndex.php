<?php

namespace Imdhemy\EsSugar\Index;

use Imdhemy\EsSugar\Attributes\IndexMappings;
use Imdhemy\EsSugar\Attributes\IndexSettings;

/**
 * Elasticsearch index
 */
interface EsIndex
{
    /**
     * Gets the index name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Gets index settings
     *
     * @return IndexSettings
     */
    public function getSettings(): IndexSettings;

    /**
     * Gets index mappings
     *
     * @return IndexMappings
     */
    public function getMappings(): IndexMappings;
}
