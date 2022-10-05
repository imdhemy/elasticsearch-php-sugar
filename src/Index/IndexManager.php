<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Index;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Exception;
use Imdhemy\EsSugar\Attributes\IndexSettings;
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

    /**
     * Updates index settings and mappings
     *
     * @param EsIndex $index
     *
     * @return ResponseInterface
     */
    public function update(EsIndex $index): ResponseInterface
    {
        return $this->updateSettings($index);
    }

    /**
     * Put index settings
     *
     * @param EsIndex $index
     *
     * @return ResponseInterface
     */
    public function updateSettings(EsIndex $index): ResponseInterface
    {
        $params = [
            'index' => $index->getName(),
            'body' => [
                'settings' => $index->getSettings()->exclude(IndexSettings::STATIC_SETTINGS),
            ],
        ];

        try {
            /** @var Elasticsearch $response */
            $response = $this->client->indices()->putSettings($params);

            return $this->responseFactory->create($response);
        } catch (Exception $exception) {
            throw new EsSugarException($exception->getMessage());
        }
    }
}
