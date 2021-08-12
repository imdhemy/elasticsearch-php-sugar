<?php


namespace Tests;


class TransactionRequest
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $scheme;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var array|null
     */
    protected $body;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $client;

    /**
     * @param array $attributes
     * @return static
     */
    public static function fromArray(array $attributes): self
    {
        $obj = new self();

        $obj->method = $attributes['http_method'];
        $obj->scheme = $attributes['scheme'];
        $obj->uri = $attributes['uri'];
        $obj->body = $attributes['body'];
        $obj->headers = $attributes['headers'];
        $obj->client = $attributes['client'];

        return $obj;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return array|null
     */
    public function getBody(): ?array
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getClient(): array
    {
        return $this->client;
    }
}