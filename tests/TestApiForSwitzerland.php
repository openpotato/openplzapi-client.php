<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi;

use OpenPlzApi\CH\ApiClientForSwitzerland;
use PHPUnit\Framework\TestCase;

class TestApiForSwitzerland extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new ApiClientForSwitzerland(); 
    }

    public function testCantons(): void
    {
        $cantons = $this->client->getCantons();

        $this->assertCount(26, $cantons);
        $this->assertNotEmpty(array_filter($cantons->toArray(), fn($canton) => $canton->name === "Zürich"));
        $this->assertNotEmpty(array_filter($cantons->toArray(), fn($canton) => $canton->name === "Aargau"));
    }

    public function testDistrictsByCanton(): void
    {
        $districts = $this->client->getDistrictsByCanton("10", 1, 10);

        $this->assertGreaterThan(0, count($districts));
        $this->assertEquals(1, $districts->pageIndex());
        $this->assertEquals(10, $districts->pageSize());
        $this->assertGreaterThanOrEqual(1, $districts->totalPages());
        $this->assertGreaterThanOrEqual(1, $districts->totalCount());

        $existsKey = false; 

        foreach ($districts as $district) {
            if ($district->key === "1001") {
                $this->assertEquals("District de la Broye", $district->name);
                $this->assertEquals("10107", $district->historicalCode);
                $this->assertEquals("10", $district->canton->key);
                $this->assertEquals("FR", $district->canton->shortName);
                $this->assertEquals("Fribourg / Freiburg", $district->canton->name);
                $existsKey = true;
                break;
            }
        };

        $this->assertTrue($existsKey, "District with key '1001' should exist.");
    }

    public function testCommunesByCanton(): void
    {
        $communes = $this->client->getCommunesByCanton("10", 1, 10);

        $this->assertGreaterThan(0, count($communes));
        $this->assertEquals(1, $communes->pageIndex());
        $this->assertEquals(10, $communes->pageSize());
        $this->assertGreaterThanOrEqual(1, $communes->totalPages());
        $this->assertGreaterThanOrEqual(1, $communes->totalCount());

        $existsKey = false; 

        foreach ($communes as $commune) {
            if ($commune->key === "2008") {
                $this->assertEquals("Châtillon (FR)", $commune->name);
                $this->assertEquals("11419", $commune->historicalCode);
                $this->assertEquals("Châtillon (FR)", $commune->shortName);
                $this->assertEquals("1001", $commune->district->key);
                $this->assertEquals("District de la Broye", $commune->district->name);
                $this->assertEquals("10", $commune->canton->key);
                $this->assertEquals("FR", $commune->canton->shortName);
                $this->assertEquals("Fribourg / Freiburg", $commune->canton->name);
                $existsKey = true;
                break;
            }
        };

        $this->assertTrue($existsKey, "Commune with key '2008' should exist.");
    }

    public function testCommunesByDistrict(): void
    {
        $communes = $this->client->getCommunesByDistrict("1002", 1, 10);

        $this->assertGreaterThan(0, count($communes));
        $this->assertEquals(1, $communes->pageIndex());
        $this->assertEquals(10, $communes->pageSize());
        $this->assertGreaterThanOrEqual(1, $communes->totalPages());
        $this->assertGreaterThanOrEqual(1, $communes->totalCount());

        $existsKey = false; 

        foreach ($communes as $commune) {
            if ($commune->key === "2061") {
                $this->assertEquals("Auboranges", $commune->name);
                $this->assertEquals("Auboranges", $commune->shortName);
                $this->assertEquals("1002", $commune->district->key);
                $this->assertEquals("District de la Glâne", $commune->district->name);
                $this->assertEquals("10", $commune->canton->key);
                $this->assertEquals("FR", $commune->canton->shortName);
                $this->assertEquals("Fribourg / Freiburg", $commune->canton->name);
                $existsKey = true;
                break;
            }
        };

        $this->assertTrue($existsKey, "Commune with key '2061' should exist.");
    }

    public function testLocalities(): void
    {
        $localities = $this->client->getLocalities(null, "Zürich", 1, 10);

        $this->assertGreaterThan(0, count($localities));
        $this->assertEquals(1, $localities->pageIndex());
        $this->assertEquals(10, $localities->pageSize());
        $this->assertGreaterThanOrEqual(1, $localities->totalPages());
        $this->assertGreaterThanOrEqual(1, $localities->totalCount());

        $existsKey = false; 

        foreach ($localities as $locality) {
            if ($locality->postalCode === "8001") {
                $this->assertEquals("Zürich", $locality->name);
                $this->assertEquals("8001", $locality->postalCode);
                $this->assertEquals("ZH", $locality->canton->shortName);
                $this->assertEquals("Zürich", $locality->canton->name);
                $existsKey = true;
                break;
            }
        };

        $this->assertTrue($existsKey, "Locality with key '8001' should exist.");
    }

    public function testStreets(): void
    {
        $streets = $this->client->getStreets("Bederstrasse", "8002", null, 1, 10);

        $this->assertGreaterThan(0, count($streets));
        $this->assertEquals(1, $streets->pageIndex());
        $this->assertEquals(10, $streets->pageSize());
        $this->assertGreaterThanOrEqual(1, $streets->totalPages());
        $this->assertGreaterThanOrEqual(1, $streets->totalCount());

        $existsKey = false; 

        foreach ($streets as $street) {
            if ($street->key === "10098541") {
                $this->assertEquals("Bederstrasse", $street->name);
                $this->assertEquals("8002", $street->postalCode);
                $this->assertEquals("Zürich", $street->locality);
                $this->assertEquals("Real", $street->status);
                $this->assertEquals("261", $street->commune->key);
                $this->assertEquals("Zürich", $street->commune->name);
                $this->assertEquals("Zürich", $street->commune->shortName);
                $this->assertEquals("112", $street->district->key);
                $this->assertEquals("Bezirk Zürich", $street->district->name);
                $this->assertEquals("1", $street->canton->key);
                $this->assertEquals("ZH", $street->canton->shortName);
                $this->assertEquals("Zürich", $street->canton->name);
                $existsKey = true;
                break;
            }
        };

        $this->assertTrue($existsKey, "Street with key '10098541' should exist.");
    }

    public function testFullTextSearch(): void
    {
        $streets = $this->client->performFullTextSearch("8002 Bederstrasse", 1, 10);

        $this->assertGreaterThan(0, count($streets));
        $this->assertEquals(1, $streets->pageIndex());
        $this->assertEquals(10, $streets->pageSize());
        $this->assertGreaterThanOrEqual(1, $streets->totalPages());
        $this->assertGreaterThanOrEqual(1, $streets->totalCount());

        $existsKey = false; 

        foreach ($streets as $street) {
            if ($street->key === "10098541") {
                $this->assertEquals("Bederstrasse", $street->name);
                $this->assertEquals("8002", $street->postalCode);
                $this->assertEquals("Zürich", $street->locality);
                $this->assertEquals("Real", $street->status);
                $this->assertEquals("261", $street->commune->key);
                $this->assertEquals("Zürich", $street->commune->name);
                $this->assertEquals("Zürich", $street->commune->shortName);
                $this->assertEquals("112", $street->district->key);
                $this->assertEquals("Bezirk Zürich", $street->district->name);
                $this->assertEquals("1", $street->canton->key);
                $this->assertEquals("ZH", $street->canton->shortName);
                $this->assertEquals("Zürich", $street->canton->name);
                $existsKey = true;
                break;
            }
        };

        $this->assertTrue($existsKey, "Street with key '10098541' should exist.");
    }
}
?>
