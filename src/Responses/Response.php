<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Responses;

use Elastic\Elasticsearch\Response\Elasticsearch as EsResponse;

/**
 * Base Response class
 */
class Response implements ResponseInterface
{
    /**
     * @var EsResponse
     */
    private readonly EsResponse $response;

    /**
     * @param EsResponse $response
     */
    public function __construct(EsResponse $response)
    {
        $this->response = $response;
    }

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
