<?php


namespace Imdhemy\EsSugar;


use Imdhemy\EsSugar\Contracts\ClientInterface;
use Imdhemy\EsSugar\Contracts\IndexInterface;
use Imdhemy\EsSugar\Contracts\ManagerInterface;

/**
 * Class Manager
 * @package Imdhemy\EsSugar
 */
class Manager implements ManagerInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * Manager constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Creates an index
     * @param IndexInterface $index
     * @return IndexInterface
     */
    public function createIndex(IndexInterface $index): IndexInterface
    {
        // TODO: throws already exists index
        $this->client->indices()->create(
            [
                'index' => $index->getName(),
            ]
        );
        return $index;
    }

    /**
     * Deletes the specified index
     * @param IndexInterface $index
     * @return IndexInterface
     */
    public function deleteIndex(IndexInterface $index): IndexInterface
    {
        // TODO: Implement deleteIndex() method.
    }

    /**
     * Updates the specified index
     * @param IndexInterface $index
     * @return IndexInterface
     */
    public function putIndex(IndexInterface $index): IndexInterface
    {
        // TODO: Implement putIndex() method.
    }

    /**
     * Finds the specified index
     * @param string $name
     * @return IndexInterface
     */
    public function getIndex(string $name): IndexInterface
    {
        // TODO: Implement getIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @param ClientInterface $client
     * @return Manager
     */
    public function setClient(ClientInterface $client): Manager
    {
        $this->client = $client;
        return $this;
    }
}
