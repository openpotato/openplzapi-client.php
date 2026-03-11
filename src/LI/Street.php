<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\LI;
 
/**
 * Representation of a Liechtenstein street (Straße)
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
     * Constructor to initialize a Street instance.
     *
     * @param string $key  Key (Straßenschlüssel)
     * @param string $name  Name (Straßenname)
     * @param string $postalCode  Postal code (Postleitzahl)
     * @param string $locality  Locality (Ortsname)
     * @param string $status  Status
     * @param CommuneSummary $commune  Commune (Gemeinde)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $postalCode,
        string $locality,
        string $status,
        CommuneSummary $commune)
    {
        $this->key = $key;
        $this->name = $name;
        $this->postalCode = $postalCode;
        $this->locality = $locality;
        $this->status = $status;
        $this->commune = $commune;
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
         );
    }
}
?>