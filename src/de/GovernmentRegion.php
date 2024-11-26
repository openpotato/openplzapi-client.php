<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

/**
 * Representation of a German government region (Regierungsbezirk)
 */
class GovernmentRegion
{
    /**
     * Regional key (Regionalschlüssel)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Bundeslandname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Administrative headquarters (Verwaltungssitz des Regierungsbezirks)
     * 
     * @var string
     */
    public string $administrativeHeadquarters;

    /**
     * Federal state (Bundesland)
     * 
     * @var FederalStateSummary
     */
    public FederalStateSummary $federalState;

    /**
     * Initializes a new instance of the GovernmentRegion class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
     * @param string $name  Name (Bundeslandname)
     * @param string $administrativeHeadquarters  Administrative headquarters (Verwaltungssitz des Regierungsbezirks)
     * @param FederalStateSummary $federalState  Federal state (Bundesland)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $administrativeHeadquarters, 
        FederalStateSummary $federalState)
    {
        $this->key = $key;
        $this->name = $name;
        $this->administrativeHeadquarters = $administrativeHeadquarters;
        $this->federalState = $federalState;
    }

    /**
     * Creates a GovernmentRegion instance from an JSON array.
     *
     * @param array $data  The data array
     * @return GovernmentRegion  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['administrativeHeadquarters'] ?? null,
            FederalStateSummary::fromJson($data['federalState'] ?? [])
        );
    }
}
?>
