<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

/**
 * Representation of a German municipal association (Gemeindeverband)
 */
class MunicipalAssociation
{
    /**
     * Regional key (Regionalschlüssel)
     * 
     * @var string
     */
    public $key;

    /**
     * Name (Name des Gemeindeverbandes)
     * 
     * @var string
     */
    public $name;

    /**
     * Type (Kennzeichen des Gemeindeverbandes)
     * 
     * @var string
     */
    public $type;

    /**
     * Administrative headquarters (Verwaltungssitz des Gemeindeverbandes)
     * 
     * @var string
     */
    public $administrativeHeadquarters;

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
    public GovernmentRegionSummary $governmentRegion;

    /**
     * Federal state (Bundesland)
     * 
     * @var FederalStateSummary
     */
    public FederalStateSummary $federalState;
     
    /**
     * Initializes a new instance of the MunicipalAssociation class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
     * @param string $name  Name (Name des Gemeindeverbandes)
     * @param string $type  Type (Kennzeichen des Gemeindeverbandes)
     * @param string $administrativeHeadquarters  Administrative headquarters (Verwaltungssitz des Gemeindeverbandes)
     * @param DistrictSummary $district  District (Bezirk)
     * @param FederalStateSummary $federalState  Federal state (Bundesland)
     */
    public function __construct(
        string $key, 
        string $name,
        string $type,
        string $administrativeHeadquarters,
        DistrictSummary $district,
        FederalStateSummary $federalState)
    {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
        $this->administrativeHeadquarters = $administrativeHeadquarters;
        $this->district = $district; 
        $this->federalState = $federalState;
    }

    /**
     * Creates a MunicipalAssociation instance from an JSON array.
     *
     * @param array $data  The data array
     * @return MunicipalAssociation  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['type'] ?? null,
            $data['administrativeHeadquarters'] ?? null,
            DistrictSummary::fromJson($data['district']),
            FederalStateSummary::fromJson($data['federalState'])
        );
    }
}
?>
