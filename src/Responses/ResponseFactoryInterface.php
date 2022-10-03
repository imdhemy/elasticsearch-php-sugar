<?php

namespace Imdhemy\EsSugar\Responses;

use Elastic\Elasticsearch\Response\Elasticsearch;

interface ResponseFactoryInterface
{
    public function create(Elasticsearch $response): ResponseInterface;
}
