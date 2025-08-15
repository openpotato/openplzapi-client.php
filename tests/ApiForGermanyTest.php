<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi;

use OpenPlzApi\DE\ApiClientForGermany;
use PHPUnit\Framework\TestCase;

class ApiForGermanyTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new ApiClientForGermany(); 
    }

    public function testFederalStates(): void
    {
        $federalStates = $this->client->getFederalStates();

        $this->assertCount(16, $federalStates);
        $this->assertNotEmpty(array_filter($federalStates->toArray(), fn($federalState) => $federalState->name === "Berlin"));
        $this->assertNotEmpty(array_filter($federalStates->toArray(), fn($federalState) => $federalState->name === "Rheinland-Pfalz"));
    }

    public function testGovernmentRegionsByFederalState(): void
    {
        $governmentRegions = $this->client->getGovernmentRegionsByFederalState("09", 1, 10);

        $this->assertGreaterThan(0, count($governmentRegions));
        $this->assertEquals(1, $governmentRegions->pageIndex());
        $this->assertEquals(10, $governmentRegions->pageSize());
        $this->assertGreaterThanOrEqual(1, $governmentRegions->totalPages());
        $this->assertGreaterThanOrEqual(1, $governmentRegions->totalCount());

        $existsKey = false;

        foreach ($governmentRegions as $region) {
            if ($region->key === "091") {
                $this->assertEquals("Oberbayern", $region->name);
                $this->assertEquals("09", $region->federalState->key);
                $this->assertEquals("Bayern", $region->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Government region with key '091' was not found.");
    }

    public function testDistrictsByFederalState(): void
    {
        $districts = $this->client->getDistrictsByFederalState("09", 1, 10);

        $this->assertGreaterThan(0, count($districts));
        $this->assertEquals(1, $districts->pageIndex());
        $this->assertEquals(10, $districts->pageSize());
        $this->assertGreaterThanOrEqual(1, $districts->totalPages());
        $this->assertGreaterThanOrEqual(1, $districts->totalCount());

        $existsKey = false;

        foreach ($districts as $district) {
            if ($district->key === "09161") {
                $this->assertEquals("Ingolstadt", $district->name);
                $this->assertEquals("Kreisfreie Stadt", $district->type);
                $this->assertEquals("Ingolstadt", $district->administrativeHeadquarters);
                $this->assertEquals("091", $district->governmentRegion->key);
                $this->assertEquals("Oberbayern", $district->governmentRegion->name);
                $this->assertEquals("09", $district->federalState->key);
                $this->assertEquals("Bayern", $district->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "District with key '09161' was not found.");
    }
    
    public function testDistrictsByGovernmentRegion(): void
    {
        $districts = $this->client->getDistrictsByGovernmentRegion("091", 1, 10);

        $this->assertGreaterThan(0, count($districts));
        $this->assertEquals(1, $districts->pageIndex());
        $this->assertEquals(10, $districts->pageSize());
        $this->assertGreaterThanOrEqual(1, $districts->totalPages());
        $this->assertGreaterThanOrEqual(1, $districts->totalCount());

        $existsKey = false;

        foreach ($districts as $district) {
            if ($district->key === "09161") {
                $this->assertEquals("Ingolstadt", $district->name);
                $this->assertEquals("Kreisfreie Stadt", $district->type);
                $this->assertEquals("Ingolstadt", $district->administrativeHeadquarters);
                $this->assertEquals("091", $district->governmentRegion->key);
                $this->assertEquals("Oberbayern", $district->governmentRegion->name);
                $this->assertEquals("09", $district->federalState->key);
                $this->assertEquals("Bayern", $district->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "District with key '09161' was not found.");
    }    
    
    public function testMunicipalAssociationsByFederalState(): void
    {
        $municipalAssociations = $this->client->getMunicipalAssociationsByFederalState("09", 1, 10);

        $this->assertGreaterThan(0, count($municipalAssociations));
        $this->assertEquals(1, $municipalAssociations->pageIndex());
        $this->assertEquals(10, $municipalAssociations->pageSize());
        $this->assertGreaterThanOrEqual(1, $municipalAssociations->totalPages());
        $this->assertGreaterThanOrEqual(1, $municipalAssociations->totalCount());

        $existsKey = false;

        foreach ($municipalAssociations as $association) {
            if ($association->key === "091715101") {
                $this->assertEquals("Emmerting (VGem)", $association->name);
                $this->assertEquals("Verwaltungsgemeinschaft", $association->type);
                $this->assertEquals("Emmerting", $association->administrativeHeadquarters);
                $this->assertEquals("09171", $association->district->key);
                $this->assertEquals("Altötting", $association->district->name);
                $this->assertEquals("09", $association->federalState->key);
                $this->assertEquals("Bayern", $association->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Municipal association with key '09161' was not found.");
    }

    public function testMunicipalAssociationsByDistrict(): void
    {
        $municipalAssociations = $this->client->getMunicipalAssociationsByDistrict("09180", 1, 10);

        $this->assertGreaterThan(0, count($municipalAssociations));
        $this->assertEquals(1, $municipalAssociations->pageIndex());
        $this->assertEquals(10, $municipalAssociations->pageSize());
        $this->assertGreaterThanOrEqual(1, $municipalAssociations->totalPages());
        $this->assertGreaterThanOrEqual(1, $municipalAssociations->totalCount());

        $existsKey = false;

        foreach ($municipalAssociations as $association) {
            if ($association->key === "091805133") {
                $this->assertEquals("Saulgrub (VGem)", $association->name);
                $this->assertEquals("Verwaltungsgemeinschaft", $association->type);
                $this->assertEquals("09180", $association->district->key);
                $this->assertEquals("Garmisch-Partenkirchen", $association->district->name);
                $this->assertEquals("Landkreis", $association->district->type);
                $this->assertEquals("09", $association->federalState->key);
                $this->assertEquals("Bayern", $association->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Municipal association with key '09180' was not found.");
    }
    
    public function testMunicipalitiesByFederalState(): void
    {
        $municipalities = $this->client->getMunicipalitiesByFederalState("09", 1, 10);

        $this->assertGreaterThan(0, count($municipalities));
        $this->assertEquals(1, $municipalities->pageIndex());
        $this->assertEquals(10, $municipalities->pageSize());
        $this->assertGreaterThanOrEqual(1, $municipalities->totalPages());
        $this->assertGreaterThanOrEqual(1, $municipalities->totalCount());

        $existsKey = false;

        foreach ($municipalities as $municipality) {
            if ($municipality->key === "09161000") {
                $this->assertEquals("Ingolstadt", $municipality->name);
                $this->assertEquals("Kreisfreie Stadt", $municipality->type);
                $this->assertEquals("85047", $municipality->postalCode);
                $this->assertTrue($municipality->multiplePostalCodes, "Expected multiple postal codes to be true.");
                $this->assertEquals("09161", $municipality->district->key);
                $this->assertEquals("Ingolstadt", $municipality->district->name);
                $this->assertEquals("Kreisfreie Stadt", $municipality->district->type);
                $this->assertEquals("091", $municipality->governmentRegion->key);
                $this->assertEquals("Oberbayern", $municipality->governmentRegion->name);
                $this->assertEquals("09", $municipality->federalState->key);
                $this->assertEquals("Bayern", $municipality->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Municipality with key '09161000' was not found.");
    }

    public function testMunicipalitiesByDistrict(): void
    {
        $municipalities = $this->client->getMunicipalitiesByDistrict("09180", 1, 10);

        $this->assertGreaterThan(0, count($municipalities));
        $this->assertEquals(1, $municipalities->pageIndex());
        $this->assertEquals(10, $municipalities->pageSize());
        $this->assertGreaterThanOrEqual(1, $municipalities->totalPages());
        $this->assertGreaterThanOrEqual(1, $municipalities->totalCount());

        $existsKey = false;

        foreach ($municipalities as $municipality) {
            if ($municipality->key === "09180112") {
                $this->assertEquals("Bad Kohlgrub", $municipality->name);
                $this->assertEquals("Kreisangehörige Gemeinde", $municipality->type);
                $this->assertEquals("82433", $municipality->postalCode);
                $this->assertFalse($municipality->multiplePostalCodes, "Expected multiple postal codes to be false.");
                $this->assertEquals("09180", $municipality->district->key);
                $this->assertEquals("Garmisch-Partenkirchen", $municipality->district->name);
                $this->assertEquals("Landkreis", $municipality->district->type);
                $this->assertEquals("091", $municipality->governmentRegion->key);
                $this->assertEquals("Oberbayern", $municipality->governmentRegion->name);
                $this->assertEquals("09", $municipality->federalState->key);
                $this->assertEquals("Bayern", $municipality->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Municipality with key '09180112' was not found.");
    }    

    public function testLocalities(): void
    {
        $localities = $this->client->getLocalities("56566", null, 1, 10);

        $this->assertGreaterThan(0, count($localities));
        $this->assertEquals(1, $localities->pageIndex());
        $this->assertEquals(10, $localities->pageSize());
        $this->assertGreaterThanOrEqual(1, $localities->totalPages());
        $this->assertGreaterThanOrEqual(1, $localities->totalCount());

        $existsKey = false;

        foreach ($localities as $locality) {
            if ($locality->name === "Neuwied" && $locality->postalCode === "56566") {
                $this->assertEquals("07138045", $locality->municipality->key);
                $this->assertEquals("Neuwied, Stadt", $locality->municipality->name);
                $this->assertEquals("Stadt", $locality->municipality->type);
                $this->assertEquals("07138", $locality->district->key);
                $this->assertEquals("Neuwied", $locality->district->name);
                $this->assertEquals("07", $locality->federalState->key);
                $this->assertEquals("Rheinland-Pfalz", $locality->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Locality with name 'Neuwied' and postal code '56566' was not found.");
    }

    public function testFullTextSearch()
    {
        $streetsPage = $this->client->performFullTextSearch("Berlin Pariser Platz", 1, 10);

        $this->assertGreaterThan(0, count($streetsPage));
        $this->assertEquals(1, $streetsPage->pageIndex());
        $this->assertEquals(10, $streetsPage->pageSize());
        $this->assertGreaterThanOrEqual(1, $streetsPage->totalPages());
        $this->assertGreaterThanOrEqual(1, $streetsPage->totalCount());

        $existsKey = false;

        foreach ($streetsPage as $street) {
            if ($street->name === "Pariser Platz" && $street->postalCode === "10117") {
                $this->assertEquals("Berlin", $street->locality);
                $this->assertEquals("11000000", $street->municipality->key);
                $this->assertEquals("Berlin, Stadt", $street->municipality->name);
                $this->assertEquals("Kreisfreie Stadt", $street->municipality->type);
                $this->assertEquals("11", $street->federalState->key);
                $this->assertEquals("Berlin", $street->federalState->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey);
    }

    public function testCompleteFullTextSearch()
    {
        $existsKey = false;
        $pageIndex = 1;

        $streetsPage = $this->client->performFullTextSearch("Berlin Platz", pageSize: 10);

        while ($streetsPage !== null)
        {
            $this->assertGreaterThan(0, count($streetsPage));
            $this->assertEquals($pageIndex, $streetsPage->pageIndex());
            $this->assertEquals(10, $streetsPage->pageSize());
            $this->assertGreaterThanOrEqual(2, $streetsPage->totalPages());
            $this->assertGreaterThanOrEqual(10, $streetsPage->totalCount());

            foreach ($streetsPage as $street) {
                if ($street->name === "Pariser Platz" && $street->postalCode === "10117") {
                    $this->assertEquals("Berlin", $street->locality);
                    $this->assertEquals("11000000", $street->municipality->key);
                    $this->assertEquals("Berlin, Stadt", $street->municipality->name);
                    $this->assertEquals("Kreisfreie Stadt", $street->municipality->type);
                    $this->assertEquals("11", $street->federalState->key);
                    $this->assertEquals("Berlin", $street->federalState->name);
                    $existsKey = true;
                    break;
                }
            }

            $streetsPage = $streetsPage->getNextPage();
            $pageIndex++;
        }

        $this->assertTrue($existsKey);
    }
}
?>
