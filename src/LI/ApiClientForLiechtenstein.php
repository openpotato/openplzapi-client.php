<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\LI;

use OpenPlzApi\ApiBaseClient;
use OpenPlzApi\ApiClientException;
use OpenPlzApi\ReadOnlyList;
use OpenPlzApi\ReadOnlyPagedList;

/**
 * Client for the Liechtenstein API endpoint of Open PLZ API
 */
class ApiClientForLiechtenstein extends ApiBaseClient
{
    /**
     * Returns communes (Gemeinden)
     *
     * @return ReadOnlyList  A list of {@see OpenPlzApi\LI\Commune} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getCommunes()
    {
        $url = $this->createUrl("li/Communes");
        return $this->getList($url, Commune::class);
    }

    /**
     * Returns localities whose postal code and/or name matches the given patterns.
     *
     * @param string $postalCode  Postal code pattern
     * @param string $name  Name pattern
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\LI\Locality} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getLocalities(?string $postalCode, ?string $name, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("li/Localities");
        $params = array_filter(
            [
                'postalCode' => $postalCode,
                'name' => $name,
                'page' => $pageIndex,
                'pageSize' => $pageSize
            ],
            fn($value) => $value !== null
        );
        $nextPage = function () use ($postalCode, $name, $pageIndex, $pageSize)  {
            return $this->getLocalities($postalCode, $name, $pageIndex + 1, $pageSize);
        };
        return $this->getPage($url, $params, Locality::class, $nextPage);
    }

    /**
     * Returns streets whose name, postal code and/or name matches the given patterns.
     *
     * @param string $name  Name pattern
     * @param string $postalCode  Postal code pattern
     * @param string $locality  Locality pattern
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\LI\Street} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getStreets(?string $name, ?string $postalCode, ?string $locality, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("li/Streets");
        $params = array_filter(
            [
                'name' => $name,
                'postalCode' => $postalCode,
                'locality' => $locality,
                'page' => $pageIndex,
                'pageSize' => $pageSize
            ],
            fn($value) => $value !== null
        );
        $nextPage = function () use ($name, $postalCode, $locality, $pageIndex, $pageSize)  {
            return $this->getStreets($name, $postalCode, $locality, $pageIndex + 1, $pageSize);
        };
        return $this->getPage($url, $params, Street::class, $nextPage);
    }

    /**
     * Performs a full-text search using the street name, postal code and city.
     *
     * @param string $searchTerm  The search term
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\LI\Street} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function performFullTextSearch(string $searchTerm, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("li/FullTextSearch");
        $params = [
            'searchTerm' => $searchTerm,
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($searchTerm, $pageIndex, $pageSize)  {
            return $this->performFullTextSearch($searchTerm, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, Street::class, $nextPage);
    }
}
?>
