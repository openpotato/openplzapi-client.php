<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

 namespace OpenPlzApi\DE;
 
 use OpenPlzApi\DE\MunicipalitySummary;
 use OpenPlzApi\DE\FederalStateSummary;
 
/**
 * Representation of a German street (Straße)
 */
class Street
 {
    /**
     * Name (Straßenname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Postal code (Postleitzahl)
     * 
     * @var CantonSummary
     */
    public string $postalCode;

    /**
     * Locality (Ortsname)
     * 
     * @var string
     */
    public string $locality;

    /**
     * Borough (Stadtbezirk)
     * 
     * @var string
     */
    public ?string $borough;

    /**
     * Suburb (Stadtteil)
     * 
     * @var string
     */
    public ?string $suburb;

    /**
     * Municipality (Gemeinde)
     * 
     * @var MunicipalitySummary
     */
    public MunicipalitySummary $municipality;

    /**
     * District (Kreis)
     * 
     * @var DistrictSummary
     */
    public ?DistrictSummary $district;

    /**
     * Federal state (Bundesland)
     * 
     * @var FederalStateSummary
     */
    public FederalStateSummary $federalState;
 
     /**
      * Initializes a new instance of the Street class.
      *
      * @param string $name  Name (Straßenname)
      * @param string $postalCode  Postal code (Postleitzahl)
      * @param string $locality  Locality (Ortsname)
      * @param ?string $borough  Borough (Stadtbezirk)
      * @param ?string $suburb  Suburb (Stadtteil)
      * @param MunicipalitySummary $municipality  Municipality (Gemeinde)
      * @param ?DistrictSummary $district  District (Kreis)
      * @param FederalStateSummary $federalState  Federal state (Bundesland)
      */
     public function __construct(
        string $name,
        string $postalCode,
        string $locality,
        ?string $borough,
        ?string $suburb,
        MunicipalitySummary $municipality, 
        ?DistrictSummary $district, 
        FederalStateSummary $federalState)
     {
         $this->name = $name;
         $this->postalCode = $postalCode;
         $this->locality = $locality;
         $this->borough = $borough;
         $this->suburb = $suburb;
         $this->municipality = $municipality;
         $this->district = $district;
         $this->federalState = $federalState;
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
             $data['name'] ?? null,
             $data['postalCode'] ?? null,
             $data['locality'] ?? null,
             $data['borough'] ?? null,
             $data['suburb'] ?? null,
             MunicipalitySummary::fromJson($data['municipality']),
             DistrictSummary::fromJson($data['district'] ?? null),
             FederalStateSummary::fromJson($data['federalState'])
         );
     }
 }
 ?>