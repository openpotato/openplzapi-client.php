<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi;

use OpenPlzApi\AT\ApiClientForAustria;
use PHPUnit\Framework\TestCase;

class ApiForAustriaTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new ApiClientForAustria(); 
    }

    public function testFederalProvinces(): void
    {
        $federalProvinces = $this->client->getFederalProvinces();

        $this->assertCount(9, $federalProvinces);
        $this->assertNotEmpty(array_filter($federalProvinces->toArray(), fn($federalProvince) => $federalProvince->name === "Wien"));
        $this->assertNotEmpty(array_filter($federalProvinces->toArray(), fn($federalProvince) => $federalProvince->name === "Burgenland"));
    }

    public function testDistrictsByFederalProvince(): void
    {
        $districts = $this->client->getDistrictsByFederalProvince("7", 1, 10);

        $this->assertEquals(1, $districts->pageIndex());
        $this->assertEquals(10, $districts->pageSize());
        $this->assertGreaterThanOrEqual(1, $districts->totalPages());
        $this->assertGreaterThanOrEqual(1, $districts->totalCount());

        $existsKey = false;

        foreach ($districts as $district) {
            if ($district->key === "701") {
                $this->assertEquals("701", $district->code);
                $this->assertEquals("Innsbruck-Stadt", $district->name);
                $this->assertEquals("7", $district->federalProvince->key);
                $this->assertEquals("Tirol", $district->federalProvince->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "District with key '701' was not found.");
    }

    public function testMunicipalitiesByFederalProvince(): void
    {
        $municipalities = $this->client->getMunicipalitiesByFederalProvince("7", 1, 10);

        $this->assertGreaterThan(0, count($municipalities), "No municipalities returned from the API.");
        $this->assertEquals(1, $municipalities->pageIndex());
        $this->assertEquals(10, $municipalities->pageSize());
        $this->assertGreaterThanOrEqual(1, $municipalities->totalPages());
        $this->assertGreaterThanOrEqual(1, $municipalities->totalCount());

        $existsKey = false;

        foreach ($municipalities as $municipality) {
            if ($municipality->key === "70101") {
                $this->assertEquals("70101", $municipality->code);
                $this->assertEquals("Innsbruck", $municipality->name);
                $this->assertEquals("6020", $municipality->postalCode);
                $this->assertTrue($municipality->multiplePostalCodes, "Expected multiple postal codes to be true.");
                $this->assertEquals("Statutarstadt", $municipality->status);
                $this->assertEquals("701", $municipality->district->key);
                $this->assertEquals("701", $municipality->district->code);
                $this->assertEquals("Innsbruck-Stadt", $municipality->district->name);
                $this->assertEquals("7", $municipality->federalProvince->key);
                $this->assertEquals("Tirol", $municipality->federalProvince->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Municipality with key '70101' was not found.");
    }

    public function testMunicipalitiesByDistrict(): void
    {
        $municipalities = $this->client->getMunicipalitiesByDistrict("701", 1, 10);

        $this->assertGreaterThan(0, count($municipalities), "No municipalities returned from the API.");
        $this->assertEquals(1, $municipalities->pageIndex());
        $this->assertEquals(10, $municipalities->pageSize());
        $this->assertGreaterThanOrEqual(1, $municipalities->totalPages());
        $this->assertGreaterThanOrEqual(1, $municipalities->totalCount());

        $existsKey = false;

        foreach ($municipalities as $municipality) {
            if ($municipality->key === "70101") {
                $this->assertEquals("70101", $municipality->code);
                $this->assertEquals("Innsbruck", $municipality->name);
                $this->assertEquals("6020", $municipality->postalCode);
                $this->assertTrue($municipality->multiplePostalCodes, "Expected multiple postal codes to be true.");
                $this->assertEquals("Statutarstadt", $municipality->status);
                $this->assertEquals("701", $municipality->district->key);
                $this->assertEquals("701", $municipality->district->code);
                $this->assertEquals("Innsbruck-Stadt", $municipality->district->name);
                $this->assertEquals("7", $municipality->federalProvince->key);
                $this->assertEquals("Tirol", $municipality->federalProvince->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Municipality with key '70101' was not found.");
    }

    public function testLocalities(): void
    {
        $localities = $this->client->getLocalities(null, "Wien", 1, 10);

        $this->assertGreaterThan(0, count($localities));
        $this->assertEquals(1, $localities->pageIndex());
        $this->assertEquals(10, $localities->pageSize());
        $this->assertGreaterThanOrEqual(1, $localities->totalPages());
        $this->assertGreaterThanOrEqual(1, $localities->totalCount());

        $existsKey = false;

        foreach ($localities as $locality) {
            if ($locality->key === "17223") {
                $this->assertEquals("Wien, Innere Stadt", $locality->name);
                $this->assertEquals("1010", $locality->postalCode);
                $this->assertEquals("90001", $locality->municipality->key);
                $this->assertEquals("90401", $locality->municipality->code);
                $this->assertEquals("Wien", $locality->municipality->name);
                $this->assertEquals("Statutarstadt", $locality->municipality->status);
                $this->assertEquals("900", $locality->district->key);
                $this->assertEquals("904", $locality->district->code);
                $this->assertEquals("Wien  4., Wieden", $locality->district->name);
                $this->assertEquals("9", $locality->federalProvince->key);
                $this->assertEquals("Wien", $locality->federalProvince->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Locality with key '17223' was not found.");
    }

    public function testStreets(): void
    {
        $streets = $this->client->getStreets(null, "1020", null, 1, 10);

        $this->assertGreaterThan(0, count($streets));
        $this->assertEquals(1, $streets->pageIndex());
        $this->assertEquals(10, $streets->pageSize());
        $this->assertGreaterThanOrEqual(1, $streets->totalPages());
        $this->assertGreaterThanOrEqual(1, $streets->totalCount());

        $existsKey = false;

        foreach ($streets as $street) {
            if ($street->key === "900017") {
                $this->assertEquals("Adambergergasse", $street->name);
                $this->assertEquals("1020", $street->postalCode);
                $this->assertEquals("Wien, Leopoldstadt", $street->locality);
                $this->assertEquals("90001", $street->municipality->key);
                $this->assertEquals("90201", $street->municipality->code);
                $this->assertEquals("Wien", $street->municipality->name);
                $this->assertEquals("Statutarstadt", $street->municipality->status);
                $this->assertEquals("900", $street->district->key);
                $this->assertEquals("902", $street->district->code);
                $this->assertEquals("Wien  2., Leopoldstadt", $street->district->name);
                $this->assertEquals("9", $street->federalProvince->key);
                $this->assertEquals("Wien", $street->federalProvince->name);

                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Street with key '900017' was not found.");
    }

    public function testFullTextSearch(): void
    {
        $streets = $this->client->performFullTextSearch("1020 Adambergergasse", 1, 10);

        $this->assertGreaterThan(0, count($streets));
        $this->assertEquals(1, $streets->pageIndex());
        $this->assertEquals(10, $streets->pageSize());
        $this->assertGreaterThanOrEqual(1, $streets->totalPages());
        $this->assertGreaterThanOrEqual(1, $streets->totalCount());

        $existsKey = false;

        foreach ($streets as $street) {
            if ($street->key === "900017") {
                $this->assertEquals("Adambergergasse", $street->name);
                $this->assertEquals("1020", $street->postalCode);
                $this->assertEquals("Wien, Leopoldstadt", $street->locality);
                $this->assertEquals("90001", $street->municipality->key);
                $this->assertEquals("90201", $street->municipality->code);
                $this->assertEquals("Wien", $street->municipality->name);
                $this->assertEquals("Statutarstadt", $street->municipality->status);
                $this->assertEquals("900", $street->district->key);
                $this->assertEquals("902", $street->district->code);
                $this->assertEquals("Wien  2., Leopoldstadt", $street->district->name);
                $this->assertEquals("9", $street->federalProvince->key);
                $this->assertEquals("Wien", $street->federalProvince->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Street with key '900017' was not found.");
    }
}
?>
