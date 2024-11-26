<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi;

use PHPUnit\Framework\TestCase;
use OpenPlzApi\DE\ApiClientForGermany;
use OpenPlzApi\ProblemDetailsException;

class TestApiAspects extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new ApiClientForGermany(); 
    }

    public function testPagination()
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

    public function testProblemDetails()
    {
        $this->expectException(ProblemDetailsException::class);

        $this->client->performFullTextSearch("Berlin Platz", pageSize: 99);
    }
}
?>
