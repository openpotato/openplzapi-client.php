<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\AT;

use OpenPlzApi\ApiBaseClient;
use OpenPlzApi\ApiClientException;
use OpenPlzApi\ReadOnlyList;
use OpenPlzApi\ReadOnlyPagedList;

/**
 * Client for the Autrian API endpoint of the OpenPLZ API
 */
class ApiClientForAustria extends ApiBaseClient
{
    /**
     * Returns federal provinces (Bundesländer).
     *
     * @return ReadOnlyList  A list of {@see OpenPlzApi\AT\FederalProvince} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getFederalProvinces(): ReadOnlyList
    {
        $url = $this->createUrl("at/FederalProvinces");
        return $this->getList($url, FederalProvince::class);
    }

    /**
     * Returns districts (Bezirke) within a federal province (Bundesland).
     *
     * @param string $key  Key of the federal province
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\AT\District} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getDistrictsByFederalProvince(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("at/FederalProvinces/{$key}/Districts");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getDistrictsByFederalProvince($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, District::class, $nextPage);
    }

    /**
     * Returns municipalities (Gemeinden) within a district (Bezirk).
     *
     * @param string $key  Key of the district
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\AT\Municipality} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getMunicipalitiesByDistrict(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("at/Districts/{$key}/Municipalities");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getMunicipalitiesByDistrict($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, Municipality::class, $nextPage);
    }

    /**
     * Returns municipalities (Gemeinden) within a federal province (Bundesland).
     *
     * @param string $key  Key of the federal province
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\AT\Municipality} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getMunicipalitiesByFederalProvince(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("at/FederalProvinces/{$key}/Municipalities");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getMunicipalitiesByFederalProvince($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, Municipality::class, $nextPage);
    }

    /**
     * Returns localities whose postal code and/or name matches the given patterns.
     *
     * @param string $postalCode  Postal code pattern
     * @param string $name  Name pattern
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\AT\Locality} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getLocalities(?string $postalCode, ?string $name, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("at/Localities");
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
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\AT\Street} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getStreets(?string $name, ?string $postalCode, ?string $locality, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("at/Streets");
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
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\AT\Street} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function performFullTextSearch(string $searchTerm, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("at/FullTextSearch");
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
