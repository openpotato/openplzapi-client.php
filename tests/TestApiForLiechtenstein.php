<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi;

use OpenPlzApi\LI\ApiClientForLiechtenstein;
use PHPUnit\Framework\TestCase;

class TestApiForLiechtenstein extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new ApiClientForLiechtenstein(); 
    }

    public function testCommunes(): void
    {
        $communes = $this->client->getCommunes();

        $this->assertCount(11, $communes);

        $this->assertNotEmpty(array_filter($communes->toArray(), fn($commune) => $commune->name === "Triesen"));
        $this->assertNotEmpty(array_filter($communes->toArray(), fn($commune) => $commune->name === "Planken"));
    }

    public function testLocalities(): void
    {
        $localities = $this->client->getLocalities("", "Vaduz", 1, 10);

        $this->assertGreaterThan(0, count($localities));
        $this->assertEquals(1, $localities->pageIndex());
        $this->assertEquals(10, $localities->pageSize());
        $this->assertGreaterThanOrEqual(1, $localities->totalPages());
        $this->assertGreaterThanOrEqual(1, $localities->totalCount());

        $existsName = false;
        $existsPostalCode = false;

        foreach ($localities as $locality) {
            if ($locality->postalCode === "9490" && $locality->name === "Vaduz") {
                $existsName = true;
                $existsPostalCode = true;
                $this->assertEquals("7001", $locality->commune->key);
                $this->assertEquals("Vaduz", $locality->commune->name);
                break;
            }
        }

        $this->assertTrue($existsName, "Locality 'Vaduz' should exist.");
        $this->assertTrue($existsPostalCode, "Postal code '9490' should exist.");
    }

    public function testStreets(): void
    {
        $streets = $this->client->getStreets("Alte Landstrasse", "9490", null, 1, 10);

        $this->assertGreaterThan(0, count($streets));
        $this->assertEquals(1, $streets->pageIndex());
        $this->assertEquals(10, $streets->pageSize());
        $this->assertGreaterThanOrEqual(1, $streets->totalPages());
        $this->assertGreaterThanOrEqual(1, $streets->totalCount());

        $existsKey = false;

        foreach ($streets as $street) {
            if ($street->key === "89440155") {
                $this->assertEquals("Alte Landstrasse", $street->name);
                $this->assertEquals("9490", $street->postalCode);
                $this->assertEquals("Vaduz", $street->locality);
                $this->assertEquals("Real", $street->status);
                $this->assertEquals("7001", $street->commune->key);
                $this->assertEquals("Vaduz", $street->commune->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Street with key '89440155' should exist.");
    }

    public function testFullTextSearch(): void
    {
        $streets = $this->client->performFullTextSearch("9490 Alte Landstrasse", 1, 10);

        $this->assertGreaterThan(0, count($streets));
        $this->assertEquals(1, $streets->pageIndex());
        $this->assertEquals(10, $streets->pageSize());
        $this->assertGreaterThanOrEqual(1, $streets->totalPages());
        $this->assertGreaterThanOrEqual(1, $streets->totalCount());

        $existsKey = false;

        foreach ($streets as $street) {
            if ($street->key === "89440155") {
                $this->assertEquals("Alte Landstrasse", $street->name);
                $this->assertEquals("9490", $street->postalCode);
                $this->assertEquals("Vaduz", $street->locality);
                $this->assertEquals("Real", $street->status);
                $this->assertEquals("7001", $street->commune->key);
                $this->assertEquals("Vaduz", $street->commune->name);
                $existsKey = true;
                break;
            }
        }

        $this->assertTrue($existsKey, "Street with key '89440155' should exist.");
    }
} 
?>
