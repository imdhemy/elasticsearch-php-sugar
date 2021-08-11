<?php


namespace Tests;

use Faker\Generator;
use Tests\fixtures\MockHandler;

/**
 * Class Faker
 * @package Tests
 * @mixin Generator
 */
class Faker
{
    private const CUSTOM_GENERATORS = [
        'index',
    ];

    private const DEFAULT_MOCK_OPTIONS = [
        'status' => 200,
        'transfer_stats' => ['total_time' => 100],
        'effective_url' => 'localhost'
    ];

    /**
     * @var Generator
     */
    private $generator;

    /**
     * Faker constructor.
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (in_array(self::CUSTOM_GENERATORS, $name)) {
            return $this->$name(...$arguments);
        }

        return $this->generator->$name(...$arguments);
    }

    /**
     * @return string
     */
    public function index(): string
    {
        $indexes = require(__DIR__ . '/fixtures/custom_fakers/index.php');
        $names = $indexes['names'];
        return $names[array_rand($names)];
    }

    /**
     * @param string $template
     * @param array $overrides
     * @param array $options
     * @return MockHandler
     */
    public function mockHandler(string $template, array $overrides = [], array $options = []): MockHandler
    {
        $responseBody = json_encode(array_merge($this->getTemplate($template), $overrides));
        $stream = fopen(sprintf('data://text/plain;base64,%s', base64_encode($responseBody)), 'r');

        $options = array_merge(self::DEFAULT_MOCK_OPTIONS, $options);
        $options['body'] = $stream;

        return new MockHandler($options);
    }

    /**
     * @param string $template
     * @return mixed
     */
    private function getTemplate(string $template)
    {
        return require(__DIR__ . '/fixtures/responses/' . $template . '.php');
    }
}
