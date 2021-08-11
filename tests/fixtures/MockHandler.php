<?php


namespace Tests\fixtures;


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
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
