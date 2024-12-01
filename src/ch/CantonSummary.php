<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;

/**
 * Reduced representation of a Swiss canton (Kanton)
 */
class CantonSummary
{
    /**
     * Key (Bfs-Nummer des Kantons)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Kantonsname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Short name (Kantonskürzel)
     * 
     * @var string
     */
    public string $shortName;

    /**
     * Initializes a new instance of the CantonSummary class.
     *
     * @param string $key  Key (Bfs-Nummer des Kantons)
     * @param string $name  Name (Kantonsname)
     * @param string $shortName  Short name (Kantonskürzel)
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
     * Creates a CantonSummary instance from an JSON array.
     *
     * @param array $data  The data array
     * @return CantonSummary  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['shortName'] ?? null
        );
    }
}
?>
