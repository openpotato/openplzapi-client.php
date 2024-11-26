<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\AT;
 
/**
 * Representation of an Austrian street (Straße)
 */
class Street
{
    /**
     * Key (Straßenkennziffer)
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
     * Locality (Ortschaftsname)
     * 
     * @var string
     */
    public string $locality;
 
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
     * Constructor to initialize a Street instance.
     *
     * @param string $key  Key (Straßenkennziffer)
     * @param string $name  Name (Straßenname)
     * @param string $postalCode  Postal code (Postleitzahl)
     * @param string $locality  Locality (Ortschaftsname)
     * @param MunicipalitySummary $municipality  Municipality (Gemeinde)
     * @param DistrictSummary $district  District (Bezirk)
     * @param FederalProvinceSummary $federalProvince  Federal province (Bundesland)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $postalCode,
        string $locality,
        MunicipalitySummary $municipality,
        DistrictSummary $district,
        FederalProvinceSummary $federalProvince)
    {
        $this->key = $key;
        $this->name = $name;
        $this->postalCode = $postalCode;
        $this->locality = $locality;
        $this->municipality = $municipality;
        $this->district = $district; 
        $this->federalProvince = $federalProvince;
    }
 
    /**
     * Creates a Street instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Street  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['postalCode'] ?? null,
            $data['locality'] ?? null,
            MunicipalitySummary::fromJson($data['municipality']),
            DistrictSummary::fromJson($data['district']),
            FederalProvinceSummary::fromJson($data['federalProvince'])
         );
    }
}
?>