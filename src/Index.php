<?php


namespace Imdhemy\EsSugar;


use Imdhemy\EsSugar\Contracts\IndexInterface;

class Index implements IndexInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Index constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
