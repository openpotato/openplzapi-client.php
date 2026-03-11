<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

 namespace OpenPlzApi\DE;
 
 use OpenPlzApi\DE\FederalStateSummary;
 
/**
 * Representation of a German district (Kreis)
 */
class District
{
    /**
     * Regional key (Regionalschlüssel)
     * 
     * @var string
     */
    public $key;

    /**
     * Name (Kreisname)
     * 
     * @var string
     */
    public $name;

    /**
     * Type (Kennzeichen)
     * 
     * @var string
     */
    public $type;

    /**
     * Administrative headquarters (Sitz der Kreisverwaltung)
     * 
     * @var string
     */
    public string $administrativeHeadquarters;

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
     * Initializes a new instance of the District class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
     * @param string $name  Name (Kreisname)
     * @param string $type  Type (Kennzeichen)
     * @param string $administrativeHeadquarters  Administrative headquarters (Sitz der Kreisverwaltung)
     * @param GovernmentRegionSummary $governmentRegion  Government region (Regierungsbezirk)
     * @param FederalProvinceSummary $federalState  Federal state (Bundesland)
     */
    public function __construct(
       string $key, 
       string $name, 
       string $type, 
       string $administrativeHeadquarters, 
       ?GovernmentRegionSummary $governmentRegion, 
       FederalStateSummary $federalState)
    {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
        $this->administrativeHeadquarters = $administrativeHeadquarters;
        $this->governmentRegion = $governmentRegion;
        $this->federalState = $federalState;
    }
 
    /**
     * Creates a district instance from an JSON array.
     *
     * @param array $data  The data array
     * @return District  The new instance
     */
    public static function fromJson(array $data)
    {
        return new self(
            $data['key'],
            $data['name'],
            $data['type'],
            $data['administrativeHeadquarters'] ?? null,
            GovernmentRegionSummary::fromJson($data['governmentRegion'] ?? null),
            FederalStateSummary::fromJson($data['federalState'])
        );
    }
}
?>