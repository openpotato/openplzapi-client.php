<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\LI;
 
/**
 * Reduced representation of a Liechtenstein commune (Gemeinde)
 */
class CommuneSummary
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
     * Initializes a new instance of the CommuneSummary class.
     *
     * @param string $key  Key (Gemeindenummer)
     * @param string $name  Name (Amtlicher Gemeindename)
     */
    public function __construct(
        string $key, 
        string $name)
    {
        $this->key = $key;
        $this->name = $name;
    }
 
    /**
     * Creates a CommuneSummary instance from an JSON array.
     *
     * @param array $data  The data array
     * @return CommuneSummary  The new instance
     */
    public static function fromJson(?array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
        );
    }
}
?>