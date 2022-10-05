<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Index;

use Imdhemy\EsSugar\Responses\ResponseInterface;

/**
 * Elasticsearch Index Manager Interface
 * Index management operations allows to manage the indices in the cluster,
 * such as create, delete and updating index mappings and settings.
 */
interface EsIndexManager
{
    /**
     * Creates an index
     *
     * @param EsIndex $index
     *
     * @return ResponseInterface
     */
    public function create(EsIndex $index): ResponseInterface;

    /**
     * Deletes an index
     *
     * @param EsIndex $index
     *
     * @return ResponseInterface
     */
    public function delete(EsIndex $index): ResponseInterface;
}
