<?php


namespace Imdhemy\EsSugar\Contracts;

/**
 * Interface ManagerInterface
 * @package Imdhemy\EsSugar
 */
interface ManagerInterface
{
    /**
     * Creates an index
     * @param IndexInterface $index
     * @return IndexInterface
     */
    public function createIndex(IndexInterface $index): IndexInterface;

    /**
     * @param string $name
     * @return IndexInterface
     * @deprecated This method will be removed on supporting PHP 8.0
     * use @link \Imdhemy\EsSugar\Contracts\ManagerInterface::createIndex()
     */
    public function createIndexByName(string $name): IndexInterface;

    /**
     * Deletes the specified index
     * @param IndexInterface $index
     * @return IndexInterface
     */
    public function deleteIndex(IndexInterface $index): IndexInterface;

    /**
     * Updates the specified index
     * @param IndexInterface $index
     * @return IndexInterface
     */
    public function putIndex(IndexInterface $index): IndexInterface;

    /**
     * Finds the specified index
     * @param string $name
     * @return IndexInterface
     */
    public function getIndex(string $name): IndexInterface;

    /**
     * Gets the internal ES client
     * @return ClientInterface
     */
    public function getClient(): ClientInterface;
}
