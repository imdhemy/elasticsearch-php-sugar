<?php

namespace Imdhemy\EsSugar\Responses;

use Elastic\Elasticsearch\Response\Elasticsearch as EsResponse;

/**
 * Base Response class
 */
class Response implements ResponseInterface
{
    /**
     * @param EsResponse $response
     */
    public function __construct(private readonly EsResponse $response) { }

    /**
     * Returns the response data as an array
     *
     * @return array
     */
    public function asArray(): array
    {
        return $this->response->asArray();
    }
}
