<?php


namespace Tests;


use GuzzleHttp\Ring\Future\CompletedFutureArray;

class TransactionResponse
{
    /**
     * @var int|null
     */
    protected $status;

    /**
     * @var array|null
     */
    protected $transferStats;

    /**
     * @var string|null
     */
    protected $effectiveUrl;

    /**
     * @var array|null
     */
    protected $body;

    /**
     * @var array|null
     */
    protected $headers;

    /**
     * @var string|null
     */
    protected $reason;

    /**
     * @param CompletedFutureArray $value
     * @return static
     */
    public static function fromCompletedFutureArray(CompletedFutureArray $value): self
    {
        $obj = new self();

        $obj->status = $value['status'];
        $obj->transferStats = $value['transfer_stats'];
        $obj->effectiveUrl = $value['effective_url'];
        $obj->body = json_decode(stream_get_contents($value['body']), true);
        $obj->headers = $value['headers'];
        $obj->reason = $value['reason'];

        return $obj;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return array|null
     */
    public function getTransferStats(): ?array
    {
        return $this->transferStats;
    }

    /**
     * @return string|null
     */
    public function getEffectiveUrl(): ?string
    {
        return $this->effectiveUrl;
    }

    /**
     * @return array|null
     */
    public function getBody(): ?array
    {
        return $this->body;
    }

    /**
     * @return array|null
     */
    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }
}