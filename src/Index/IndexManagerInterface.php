<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Index;

use Imdhemy\EsSugar\Responses\ResponseInterface;

/**
 * Index Manager Interface
 * Index management operations allows to manage the indices in the cluster,
 * such as create, delete and updating index mappings and settings.
 */
interface IndexManagerInterface
{
    /**
     * Creates an index
     *
     * @param EsIndex $index
     *
     * @return ResponseInterface
     */
    public function create(EsIndex $index): ResponseInterface;
}
