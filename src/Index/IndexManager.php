<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Index;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Exception;
use Imdhemy\EsSugar\Exceptions\EsSugarException;
use Imdhemy\EsSugar\Responses\ResponseFactoryInterface;
use Imdhemy\EsSugar\Responses\ResponseInterface;

/**
 * ES Sugar Index Manager
 */
class IndexManager implements EsIndexManager
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    /**
     * @param Client $client
     * @param ResponseFactoryInterface $responseFactory
     */
    public function __construct(Client $client, ResponseFactoryInterface $responseFactory)
    {
        $this->client = $client;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Creates an index
     *
     * @param EsIndex $index
     *
     * @return ResponseInterface
     */
    public function create(EsIndex $index): ResponseInterface
    {
        $params = ['index' => $index->getName()];

        $settings = $index->getSettings();
        if (! $settings->isEmpty()) {
            $params['body']['settings'] = $settings;
        }

        $mappings = $index->getMappings();
        if (! $mappings->isEmpty()) {
            $params['body']['mappings'] = $mappings;
        }

        try {
            /** @var Elasticsearch $response */
            $response = $this->client->indices()->create($params);

            return $this->responseFactory->create($response);
        } catch (Exception $exception) {
            throw new EsSugarException($exception->getMessage());
        }
    }

    /**
     * Deletes an index
     *
     * @param EsIndex $index
     *
     * @return ResponseInterface
     */
    public function delete(EsIndex $index): ResponseInterface
    {
        $params = ['index' => $index->getName()];
        try {
            /** @var Elasticsearch $response */
            $response = $this->client->indices()->delete($params);

            return $this->responseFactory->create($response);
        } catch (Exception $exception) {
            throw new EsSugarException($exception->getMessage());
        }
    }
}
