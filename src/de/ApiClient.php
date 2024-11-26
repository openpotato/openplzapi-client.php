<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

use OpenPlzApi\ApiBaseClient;
use OpenPlzApi\ApiClientException;
use OpenPlzApi\ReadOnlyList;
use OpenPlzApi\ReadOnlyPagedList;

/**
 * Client for the German API endpoint of Open PLZ API
 */
class ApiClientForGermany extends ApiBaseClient
{
    /**
     * Returns federal states (Bundesländer).
     *
     * @return ReadOnlyList  A list of {@see OpenPlzApi\DE\FederalState} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getFederalStates(): ReadOnlyList
    {
        $url = $this->createUrl("de/FederalStates");
        return $this->getList($url, FederalState::class);
    }

    /**
     * Returns districts (Kreise) within a federal state (Bundesland).
     *
     * @param string $key  Key of the federal state
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\District} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getDistrictsByFederalState(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/FederalStates/{$key}/Districts");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getDistrictsByFederalState($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, District::class, $nextPage);
    }

    /**
     * Returns districts (Kreise) within a government region (Regierungsbezirk).
     *
     * @param string $key  Key of the government region
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\District} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getDistrictsByGovernmentRegion(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/GovernmentRegions/{$key}/Districts");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getDistrictsByGovernmentRegion($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, District::class, $nextPage);
    }

    /**
     * Returns government regions (Regierungsbezirke) within a federal state (Bundesaland).
     *
     * @param string $key  Key of the federal state
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\GovernmentRegion} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getGovernmentRegionsByFederalState(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/FederalStates/{$key}/GovernmentRegions");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getGovernmentRegionsByFederalState($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, GovernmentRegion::class, $nextPage);
    }

    /**
     * Returns municipal associations (Gemeindeverbände) within a district (Kreis).
     *
     * @param string $key  Key of the district
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\MunicipalAssociation} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getMunicipalAssociationsByDistrict(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/Districts/{$key}/MunicipalAssociations");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getMunicipalAssociationsByDistrict($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, MunicipalAssociation::class, $nextPage);
    }

    /**
     * Returns municipal associations (Gemeindeverbände) within a federal state (Bundesland).
     *
     * @param string $key  Key of the federal state
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\MunicipalAssociation} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getMunicipalAssociationsByFederalState(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/FederalStates/{$key}/MunicipalAssociations");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getMunicipalAssociationsByFederalState($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, MunicipalAssociation::class, $nextPage);
    }

    /**
     * Returns municipal associations (Gemeindeverbünde) within a government region (Regierungsbezirk).
     *
     * @param string $key  Key of the government region
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\MunicipalAssociation} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getMunicipalAssociationsByGovernmentRegion(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/GovernmentRegions/{$key}/MunicipalAssociations");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getMunicipalAssociationsByGovernmentRegion($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, MunicipalAssociation::class, $nextPage);
    }

    /**
     * Returns municipalities (Gemeinden) within a district (Kreis).
     *
     * @param string $key  Key of the district
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\Municipality} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getMunicipalitiesByDistrict (string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/Districts/{$key}/Municipalities");
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
     * Returns municipalities (Gemeinden) within a federal state (Bundesland).MunicipalitiesByFederalState
     *
     * @param string $key  Key of the federal state
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\Municipality} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getMunicipalitiesByFederalState(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/FederalStates/{$key}/Municipalities");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getMunicipalitiesByFederalState($key, $pageIndex + 1, $pageSize);
        };

        return $this->getPage($url, $params, Municipality::class, $nextPage);
    }

    /**
     * Returns municipalities (Gemeinden) within a government region (Regierungsbezirk).
     *
     * @param string $key  Key of the government region
     * @param int $pageIndex  Page index for paging
     * @param int $pageSize  Page size for paging
     * @return ReadOnlyPagedList A paged list of {@see OpenPlzApi\DE\Municipality} instances
     * @throws ProblemDetailsException If the request fails
     */
    public function getMunicipalitiesByGovernmentRegion(string $key, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/GovernmentRegions/{$key}/Municipalities");
        $params = [
            'page' => $pageIndex,
            'pageSize' => $pageSize
        ];
        $nextPage = function () use ($key, $pageIndex, $pageSize)  {
            return $this->getMunicipalitiesByGovernmentRegion($key, $pageIndex + 1, $pageSize);
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
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\DE\Locality} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getLocalities(?string $postalCode, ?string $name, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/Localities");
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
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\DE\Street} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function getStreets(?string $name, ?string $postalCode, ?string $locality, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/Streets");
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
     * @return ReadOnlyPagedList  A paged list of {@see OpenPlzApi\DE\Street} instances
     * @throws ProblemDetailsException  If the request fails
     */
    public function performFullTextSearch(string $searchTerm, int $pageIndex = 1, int $pageSize = 50): ReadOnlyPagedList
    {
        $url = $this->createUrl("de/FullTextSearch");
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
