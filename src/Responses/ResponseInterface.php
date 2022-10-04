<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Responses;

/**
 * Response Interface
 */
interface ResponseInterface
{
    /**
     * Returns the response data as an array
     *
     * @return array
     */
    public function asArray(): array;
}
