<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;
 
/**
 * Representation of a Swiss locality (Ort oder Stadt)
 */
class Locality
{
    /**
     * Name (Ortsname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Postal code (Postleitzahl)
     * 
     * @var string
     */
    public string $postalCode;

    /**
     * Commune (Gemeinde)
     * 
     * @var CommuneSummary
     */
    public CommuneSummary $commune;
 
    /**
     * District (Bezirk)
     * 
     * @var DistrictSummary
     */
    public DistrictSummary $district;

    /**
     * Canton (Kanton)
     * 
     * @var CantonSummary
     */
    public CantonSummary $canton;

    /**
     * Initializes a new instance of the Locality class.
     *
     * @param string $name  Name (Ortsname)
     * @param string $postalCode  Postal code (Postleitzahl)
     * @param CommuneSummary $commune  Commune (Gemeinde)
     * @param DistrictSummary $district  District (Bezirk)
     * @param CantonSummary $canton  Canton (Kanton)
     */
    public function __construct(
        string $name, 
        string $postalCode,
        CommuneSummary $commune,
        DistrictSummary $district,
        CantonSummary $canton)
    {
        $this->name = $name;
        $this->postalCode = $postalCode;
        $this->commune = $commune;
        $this->district = $district; 
        $this->canton = $canton;
    }
 
    /**
     * Creates a Locality instance from an JSON array.
     *
     * @param array $data The data array
     * @return Locality The new instance
     */
    public static function fromJson(array $data)
    {
        return new self(
            $data['name'] ?? null,
            $data['postalCode'] ?? null,
            CommuneSummary::fromJson($data['commune'] ?? []),
            DistrictSummary::fromJson($data['district'] ?? []),
            CantonSummary::fromJson($data['canton'] ?? [])
         );
    }
}
?>