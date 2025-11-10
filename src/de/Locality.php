<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;
 
/**
 * Representation of a German locality (Ort oder Stadt)
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
     * Municipality (Gemeinde)
     * 
     * @var MunicipalitySummary
     */
    public MunicipalitySummary $municipality;

    /**
     * District (Kreis)
     * 
     * @var ?DistrictSummary
     */
    public ?DistrictSummary $district;

    /**
     * Federal state (Bundesland)
     * 
     * @var FederalStateSummary
     */
    public FederalStateSummary $federalState;

    /**
     * Initializes a new instance of the Locality class.
     *
     * @param string $name  Name (Ortsname)
     * @param string $postalCode  Postal code (Postleitzahl)
     * @param MunicipalitySummary $municipality  Municipality (Gemeinde)
     * @param ?DistrictSummary $district  District (Kreis)
     * @param FederalStateSummary $federalState  Federal state (Bundesland)
     */
    public function __construct(
        string $name, 
        string $postalCode,
        MunicipalitySummary $municipality,
        ?DistrictSummary $district,
        FederalStateSummary $federalState)
    {
        $this->name = $name;
        $this->postalCode = $postalCode;
        $this->municipality = $municipality;
        $this->district = $district; 
        $this->federalState = $federalState;
    }
 
    /**
     * Creates a Locality instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Locality  The new instance
     */
    public static function fromJson(array $data)
    {
        return new self(
            $data['name'] ?? null,
            $data['postalCode'] ?? null,
            MunicipalitySummary::fromJson($data['municipality']),
            DistrictSummary::fromJson($data['district'] ?? null),
            FederalStateSummary::fromJson($data['federalState'])
         );
    }
}
?>