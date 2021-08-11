<?php


namespace Imdhemy\EsSugar;


use Imdhemy\EsSugar\Contracts\ClientInterface;

/**
 * @mixin Client
 */
class Client implements ClientInterface
{
    /**
     * @var \Elasticsearch\Client
     */
    protected $client;

    /**
     * Client constructor.
     * @param \Elasticsearch\Client $client
     */
    public function __construct(\Elasticsearch\Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->client->$name(...$arguments);
    }
}
