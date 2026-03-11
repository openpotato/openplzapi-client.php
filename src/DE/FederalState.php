<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

/**
 * Representation of a German federal state (Bundesland)
 */
class FederalState
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
     * Seat of government (Sitz der Landesregierung)
     * 
     * @var string
     */
    public string $seatOfGovernment;

    /**
     * Initializes a new instance of the FederalState class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
     * @param string $name  Name (Bundeslandname)
     * @param string $seatOfGovernment  Seat of government (Sitz der Landesregierung)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $seatOfGovernment)
    {
        $this->key = $key;
        $this->name = $name;
        $this->seatOfGovernment = $seatOfGovernment;
    }

    /**
     * Creates a FederalState instance from an JSON array.
     *
     * @param array $data  The data array
     * @return FederalState  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['seatOfGovernment'] ?? null
        );
    }
}
?>
