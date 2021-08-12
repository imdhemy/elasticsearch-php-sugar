<?php


namespace Tests\fixtures;


use GuzzleHttp\Ring\Future\CompletedFutureArray;
use GuzzleHttp\Ring\Future\FutureArrayInterface;

/**
 * Class MockHandler
 * You can use this handler for testing purposes
 * @package Tests\fixtures
 */
class MockHandler extends \GuzzleHttp\Ring\Client\MockHandler
{
    /**
     * @var array
     */
    protected $transactions;

    /**
     * MockHandler constructor.
     * @param $result
     */
    public function __construct($result)
    {
        parent::__construct($result);
        $this->transactions = [];
    }

    /**
     * Called when trying to call the handler object as a function
     * @param array $request
     * @return callable|CompletedFutureArray|FutureArrayInterface
     */
    public function __invoke(array $request)
    {
        $response = parent::__invoke($request);

        $transaction = [
            'request' => $request,
            'response' => $response,
        ];

        $this->transactions[] = $transaction;

        return $response;
    }

    /**
     * Get List of all transactions committed by the client
     * using this handler
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
