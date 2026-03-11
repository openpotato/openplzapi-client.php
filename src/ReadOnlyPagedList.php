<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi;

use \Psr\Http\Message\ResponseInterface;

/**
 * An iterable read-only list with additional pagination information.
 */
class ReadOnlyPagedList extends ReadOnlyList
{
    private int $pageIndex;
    private int $pageSize;
    private int $totalPages;
    private int $totalCount;
    private $nextPage;

    /**
     * Initializes a new instance of the ReadOnlyPagedList class.
     *
     * @param array $items The list of items
     * @param int $pageIndex The page index
     * @param int $pageSize The page size
     * @param int $totalPages The total number of pages
     * @param int $totalCount The total number of items
     * @param $nextPage  A delegate for getting the next page
     */
    public function __construct(
        array $items, 
        int $pageIndex, 
        int $pageSize, 
        int $totalPages, 
        int $totalCount, 
        $nextPage)
    {
        parent::__construct($items);
         
        if ($nextPage == null || !is_callable($nextPage)) {
           throw new \InvalidArgumentException("nextPage must be a callable.");
        }
         
        $this->pageIndex = $pageIndex;
        $this->pageSize = $pageSize;
        $this->totalPages = $totalPages;
        $this->totalCount = $totalCount;
        $this->nextPage = $nextPage;
    }
 
    /**
     * The page index
     *
     * @return int  
     */
    public function pageIndex(): int
    { 
       return $this->pageIndex; 
    }
    
    /**
     * The page size
     *
     * @return int  
     */
    public function pageSize(): int
    { 
       return $this->pageSize; 
    }
    
    /**
     * The total number of pages
     *
     * @return int  
     */
    public function totalPages(): int 
    { 
        return $this->totalPages; 
    }
    
    /**
     * The total number of elements 
     *
     * @return int  
     */
    public function totalCount(): int 
    { 
        return $this->totalCount; 
    }
    
    /**
     * Checks if the current page is the last page.
     *
     * @return bool True if it is the last page, false otherwise.
     */
    public function isLastPage(): bool
    { 
        return ($this->pageIndex * $this->pageSize) >= $this->totalCount; 
    }

    /**
     * Returns the next page with elements.
     *
     * @return ReadOnlyPagedList|null A new ReadOnlyPagedList object or null if there are no more pages.
     */
    public function getNextPage(): ?ReadOnlyPagedList
    {
        if ($this->isLastPage()) {
            return null;
        }

        return is_callable($this->nextPage) ? call_user_func($this->nextPage) : null;
    }    

    /**
     * Creates a ReadOnlyPagedList instance from an HTTP response.
     *
     * @param ResponseInterface $response  An HTTP response object
     * @param class-string $modelClass  The class name of items in the list
     * @param $nextPage  A delegate for getting the next page
     * @return ReadOnlyPagedList  The new instance
     */
    static function fromJson(ResponseInterface $response, string $modelClass, $nextPage = null): ReadOnlyPagedList
    {
        $jsonArray = json_decode($response->getBody(), true);
 
        $items = array_map(function ($item) use ($modelClass) {
            return $modelClass::fromJson($item);
        }, $jsonArray);
 
        return new self(
            $items,
            (int) $response->getHeaderLine("x-page"),
            (int) $response->getHeaderLine("x-page-size"),
            (int) $response->getHeaderLine("x-total-pages"),
            (int) $response->getHeaderLine("x-total-count"),
            $nextPage
        );
    }
}

 