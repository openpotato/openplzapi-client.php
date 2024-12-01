<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;
 
/**
 * Reduced representation of a Swiss commune (Gemeinde)
 */
class CommuneSummary
{
    /**
     * Key (Bfs-Nummer der Gemeinde)
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
     * Short name (Gemeindename, kurz)
     * 
     * @var string
     */
    public string $shortName;
 
    /**
     * Initializes a new instance of the CommuneSummary class.
     *
     * @param string $key  Key (Bfs-Nummer der Gemeinde)
     * @param string $name  Name (Amtlicher Gemeindename)
     * @param string $shortName  Short name (Gemeindename, kurz)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $shortName)
    {
        $this->key = $key;
        $this->name = $name;
        $this->shortName = $shortName;
    }
 
    /**
     * Creates a CommuneSummary instance from an JSON array.
     *
     * @param array $data  The data array
     * @return CommuneSummary  The new instance
     */
    public static function fromJson(?array $data): ?self
    {
        if (empty($data)) {
            return null;
        }
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['shortName'] ?? null
        );
    }
}
?>