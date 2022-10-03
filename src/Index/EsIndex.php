<?php

namespace Imdhemy\EsSugar\Index;

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
