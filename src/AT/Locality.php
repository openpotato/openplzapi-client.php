<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\AT;
 
/**
 * Representation of an Austrian locality (Ortschaft)
 */
class Locality
{
    /**
     * Key (Ortschaftskennziffer)
     * 
     * @var string
     */
    public string $key;

    /**
     * Postal code (Postleitzahl)
     * 
     * @var string
     */
    public string $postalCode;

    /**
     * Name (Ortschaftsname)
     * 
     * @var string
     */
    public string $name;
 
    /**
     * Municipality (Gemeinde)
     * 
     * @var string
     */
    public MunicipalitySummary $municipality;
 
    /**
     * District (Bezirk)
     * 
     * @var string
     */
    public DistrictSummary $district;

    /**
     * Federal province (Bundesland)
     * 
     * @var FederalProvinceSummary
     */
    public FederalProvinceSummary $federalProvince;

    /**
     * Constructor to initialize a Locality instance.
     *
     * @param string $key  Key (Ortschaftskennziffer)
     * @param string $postalCode  Postal code (Postleitzahl)
     * @param string $name  Name (Ortschaftsname)
     * @param MunicipalitySummary $municipality  Municipality (Gemeinde)
     * @param DistrictSummary $district  District (Bezirk)
     * @param FederalProvinceSummary $federalProvince  Federal province (Bundesland)
     */
    public function __construct(
        string $key, 
        string $postalCode,
        string $name, 
        MunicipalitySummary $municipality,
        DistrictSummary $district,
        FederalProvinceSummary $federalProvince)
    {
        $this->key = $key;
        $this->postalCode = $postalCode;
        $this->name = $name;
        $this->municipality = $municipality;
        $this->district = $district; 
        $this->federalProvince = $federalProvince;
    }
 
    /**
     * Creates a Locality instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Locality  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['postalCode'] ?? null,
            $data['name'] ?? null,
            MunicipalitySummary::fromJson($data['municipality'] ?? []),
            DistrictSummary::fromJson($data['district'] ?? []),
            FederalProvinceSummary::fromJson($data['federalProvince'] ?? [])
         );
    }
}
?>