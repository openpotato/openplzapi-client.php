<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi;

use \Psr\Http\Message\ResponseInterface;

/**
 * An iterable read-only list.
 */
class ReadOnlyList implements \IteratorAggregate, \Countable
{
    private array $items;

    /**
     * Initializes a new instance of the ReadOnlyList class.
     *
     * @param array $items The list of items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
 
    /**
     * Get an item by its index.
     *
     * @param int $index  The index
     * @return mixed  The found item
     * @throws OutOfBoundsException if the index does not exist
     */
    public function get(int $index): mixed
    {
        if (!isset($this->items[$index])) {
            throw new \OutOfBoundsException("Index $index does not exist in the list.");
        }

        return $this->items[$index];
    }

    /**
     * Get all items as an array.
     *
     * @return array  Array of items
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * Count the number of items in the list.
     *
     * @return int  NUmber of items
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Get an iterator for the list (to support foreach).
     *
     * @return Traversable
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * Creates a ReadOnlyList instance from an HTTP response.
     *
     * @param ResponseInterface $response  An HTTP response object
     * @param class-string $modelClass  The class name of items in the list
     * @return ReadOnlyList  The new instance
     */
    public static function fromJson(ResponseInterface $response, string $modelClass): self
    {
        $jsonArray = json_decode($response->getBody(), true);
 
        $items = array_map(function ($item) use ($modelClass) {
            return $modelClass::fromJson($item);
        }, $jsonArray);
 
        return new self($items);
    }
}
 
