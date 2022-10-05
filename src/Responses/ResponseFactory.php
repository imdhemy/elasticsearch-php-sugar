<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Responses;

use Elastic\Elasticsearch\Response\Elasticsearch;

class ResponseFactory implements ResponseFactoryInterface
{
    public function create(Elasticsearch $response): ResponseInterface
    {
        return new Response($response);
    }
}
