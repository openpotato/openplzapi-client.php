<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;

use OpenPlzApi\ApiBaseClient;
use OpenPlzApi\ApiClientException;
use OpenPlzApi\ReadOnlyList;
use OpenPlzApi\ReadOnlyPagedList;

/**
 * Client for the Swiss API endpoint of Open PLZ API
 */
class ApiClientForSwitzerland extends ApiBaseClient
{
    /**
     * Returns all cantons (Kantone).
     *
     * @return ReadOnlyList  A list of {@see OpenPlzApi\CH\Canton} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getCantons(): ReadOnlyList
    {
        $url = $this->createUrl("ch/Cantons");
        return $this->getList($url, Canton::class);
    }

    /**
     * Returns communes (Gemeinden) within a canton (Kanton).
     *
     * @param string $key  Key of the caton
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\CH\Commune} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getCommunesByCanton(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("ch/Cantons/{$key}/Communes");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getCommunesByCanton($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, Commune::class, $nextPage);
    }

    /**
     * Returns communes (Gemeinden) within a district (Bezirk).
     *
     * @param string $key  Key of the district
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\CH\Commune} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getCommunesByDistrict(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("ch/Districts/{$key}/Communes");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getCommunesByDistrict($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, Commune::class, $nextPage);
    }

    /**
     * Returns districts (Bezirke) within a canton (Kanton).
     *
     * @param string $key  Key of the canton
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\CH\District} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getDistrictsByCanton(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("ch/Cantons/{$key}/Districts");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getDistrictsByCanton($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, District::class, $nextPage);
    }

    /**
     * Returns localities whose postal code and/or name matches the given patterns.
     *
     * @param string $postalCode  Postal code pattern
     * @param string $name  Name pattern
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\CH\Locality} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getLocalities(?string $postalCode, ?string $name, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("ch/Localities");
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
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\CH\Street} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getStreets(?string $name, ?string $postalCode, ?string $locality, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("ch/Streets");
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
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\CH\Street} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function performFullTextSearch(string $searchTerm, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("ch/FullTextSearch");
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
