<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;
 
/**
 * Representation of an Austrian street (Straße)
 */
class Street
{
    /**
     * Key (Straßenschlüssel)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Straßenname)
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
     * Locality (Ortsname)
     * 
     * @var string
     */
    public string $locality;
 
    /**
     * Status
     * 
     * @var string
     */
    public string $status;
 
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
     * Initializes a new instance of the Street class.
     *
     * @param string $key  Key (Straßenschlüssel)
     * @param string $name  Name (Straßenname)
     * @param string $postalCode  Postal code (Postleitzahl)
     * @param string $locality Locality (Ortsname)
     * @param string $status  Status
     * @param CommuneSummary $commune  Commune (Gemeinde)
     * @param DistrictSummary $district  District (Bezirk)
     * @param CantonSummary $canton  Canton (Kanton)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $postalCode,
        string $locality,
        string $status,
        CommuneSummary $commune,
        DistrictSummary $district,
        CantonSummary $canton)
    {
        $this->key = $key;
        $this->name = $name;
        $this->postalCode = $postalCode;
        $this->locality = $locality;
        $this->status = $status;
        $this->commune = $commune;
        $this->district = $district; 
        $this->canton = $canton;
    }
 
    /**
     * Creates a Street instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Street  The new instance
     */
    public static function fromJson(array $data)
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['postalCode'] ?? null,
            $data['locality'] ?? null,
            $data['status'] ?? null,
            CommuneSummary::fromJson($data['commune'] ?? []),
            DistrictSummary::fromJson($data['district'] ?? []),
            CantonSummary::fromJson($data['canton'] ?? [])
         );
    }
}
?>