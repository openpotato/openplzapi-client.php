<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;
 
use OpenPlzApi\DE\MunicipalAssociationSummary;
use OpenPlzApi\DE\DistrictSummary;
use OpenPlzApi\DE\GovernmentRegionSummary;
use OpenPlzApi\DE\FederalStateSummary;
 
/**
 * Representation of a German municipality (Gemeinde)
 */
class Municipality
{
    /**
     * Regional key (Regionalschlüssel)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Gemeindename)
     * 
     * @var string
     */
    public string $name;

    /**
     * Code (Gemeindecode)
     * 
     * @var string
     */
    public string $code;

    /**
     * Postal code of the administrative headquarters (Verwaltungssitz), if there are multiple postal codes available
     * 
     * @var string
     */
    public string $postalCode;

    /**
     * This municipality has multiple postal codes?
     * 
     * @var bool
     */
    public bool $multiplePostalCodes;

    /**
     * Type (Kennzeichen)
     * 
     * @var string
     */
    public string $type;

    /**
     * Association (Gemeindeverbund)
     * 
     * @var MunicipalAssociationSummary
     */
    public ?MunicipalAssociationSummary $association;

    /**
     * District (Bezirk)
     * 
     * @var DistrictSummary
     */
    public DistrictSummary $district;

    /**
     * Government region (Regierungsbezirk)
     * 
     * @var GovernmentRegionSummary
     */
    public ?GovernmentRegionSummary $governmentRegion;

    /**
     * Federal state (Bundesland)
     * 
     * @var FederalStateSummary
     */
    public FederalStateSummary $federalState;
 
    /**
     * Initializes a new instance of the Municipality class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
     * @param string $name  Name (Gemeindename)
     * @param string $postalCode  Postal code of the administrative headquarters (Verwaltungssitz), if there are multiple postal codes available
     * @param bool $multiplePostalCodes  This municipality has multiple postal codes?
     * @param string $type  Type (Kennzeichen)
     * @param ?MunicipalAssociationSummary $association  Association (Gemeindeverbund)
     * @param DistrictSummary $district  District (Bezirk)
     * @param ?GovernmentRegionSummary $governmentRegion  Government region (Regierungsbezirk)
     * @param FederalStateSummary $federalState  Federal state (Bundesland)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $postalCode,
        string $multiplePostalCodes,
        string $type,
        ?MunicipalAssociationSummary $association,
        DistrictSummary $district,
        ?GovernmentRegionSummary $governmentRegion,
        FederalStateSummary $federalState)
    {
        $this->key = $key;
        $this->name = $name;
        $this->postalCode = $postalCode;
        $this->multiplePostalCodes = $multiplePostalCodes;
        $this->type = $type;
        $this->association = $association; 
        $this->district = $district; 
        $this->governmentRegion = $governmentRegion; 
        $this->federalState = $federalState;
    }
 
    /**
     * Creates a Municipality instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Municipality  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'],
            $data['name'],
            $data['postalCode'],
            $data['multiplePostalCodes'],
            $data['type'] ?? '',
            MunicipalAssociationSummary::fromJson($data['association'] ?? null),
            DistrictSummary::fromJson($data['district'] ?? null),
            GovernmentRegionSummary::fromJson($data['governmentRegion'] ?? null),
            FederalStateSummary::fromJson($data['federalState'])
        );
    }
}
?>