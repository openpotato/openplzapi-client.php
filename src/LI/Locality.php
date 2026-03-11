<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\LI;
 
/**
 * Representation of a Liechtenstein locality (Ort oder Stadt)
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
     * Commune (Gemeinde)
     * 
     * @var CommuneSummary
     */
    public CommuneSummary $commune;
 
    /**
     * Constructor to initialize a Locality instance.
     *
     * @param string $name  Name (Ortsname)
     * @param string $postalCode  Postal code (Postleitzahl)
     * @param CommuneSummary $commune  Commune (Gemeinde)
     */
    public function __construct(
        string $name, 
        string $postalCode,
        CommuneSummary $commune)
    {
        $this->name = $name;
        $this->postalCode = $postalCode;
        $this->commune = $commune;
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
            CommuneSummary::fromJson($data['commune'] ?? []),
         );
    }
}
?>