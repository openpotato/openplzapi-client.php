<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\LI;
 
/**
 * Representation of a Liechtenstein commune (Gemeinde)
 */
class Commune
{
    /**
     * Key (Gemeindenummer)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Amtlicher Gemeindename)
     * 
     * @var string
     */
    public string $name;

    /**
     * Electoral district (Wahlkreis)
     * 
     * @var string
     */
    public string $electoralDistrict;

     /**
     * Initializes a new instance of the Commune class.
     *
     * @param string $key  Key (Gemeindenummer)
     * @param string $name  Name (Amtlicher Gemeindename)
     * @param string $electoralDistrict  Electoral district (Wahlkreis)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $electoralDistrict)
    {
        $this->key = $key;
        $this->name = $name;
        $this->electoralDistrict = $electoralDistrict;
    }
 
    /**
     * Creates a Commune instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Commune  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['electoralDistrict'] ?? null
        );
    }
}
?>