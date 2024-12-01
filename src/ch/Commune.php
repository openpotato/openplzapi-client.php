<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;
 
use OpenPlzApi\CH\DistrictSummary;
use OpenPlzApi\CH\CantonSummary;
 
/**
 * Representation of a Swiss commune (Gemeinde)
 */
class Commune
{
    /**
     * Key (Bfs-Nummer der Gemeinde)
     * 
     * @var string
     */
    public string $key;

    /**
     * Historical code (Historisierte Nummer der Gemeinde)
     * 
     * @var string
     */
    public string $historicalCode;

    /**
     * Name (Amtlicher Gemeindename)
     * 
     * @var string
     */
    public string $name;

    /**
     * Short name (Gemeindename, kurz)
     * 
     * @var string
     */
    public string $shortName;

    /**
     * District (Bezirk)
     * 
     * @var string
     */
    public DistrictSummary $district;

    /**
     * Canton (Kanton)
     * 
     * @var CantonSummary
     */
    public CantonSummary $canton;
 
    /**
     * Initializes a new instance of the Commune class.
     *
     * @param string $key  Key (Bfs-Nummer der Gemeinde)
     * @param string $historicalCode  Historical code (Historisierte Nummer der Gemeinde)
     * @param string $name  Name (Amtlicher Gemeindename)
     * @param string $shortName  Short name (Gemeindename, kurz)
     * @param DistrictSummary $district  District (Bezirk)
     * @param CantonSummary $canton  Canton (Kanton)
     */
    public function __construct(
        string $key, 
        string $historicalCode,
        string $name, 
        string $shortName, 
        DistrictSummary $district,
        CantonSummary $canton)
    {
        $this->key = $key;
        $this->historicalCode = $historicalCode;
        $this->name = $name;
        $this->shortName = $shortName;
        $this->district = $district; 
        $this->canton = $canton;
    }
 
    /**
     * Creates a Commune instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Commune  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['historicalCode'] ?? null,
            $data['name'] ?? null,
            $data['shortName'] ?? null,
            DistrictSummary::fromJson($data['district'] ?? []),
            CantonSummary::fromJson($data['canton'] ?? [])
        );
    }
}
?>