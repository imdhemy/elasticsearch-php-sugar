<?php


namespace Tests;


class Transaction
{
    /**
     * @var TransactionRequest
     */
    protected $request;

    /**
     * @var TransactionResponse
     */
    protected $response;

    /**
     * Transaction constructor.
     * @param TransactionRequest $request
     * @param TransactionResponse $response
     */
    public function __construct(TransactionRequest $request, TransactionResponse $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return TransactionRequest
     */
    public function getRequest(): TransactionRequest
    {
        return $this->request;
    }

    /**
     * @return TransactionResponse
     */
    public function getResponse(): TransactionResponse
    {
        return $this->response;
    }
}