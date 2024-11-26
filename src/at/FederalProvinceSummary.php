<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\AT;

/**
 * Reduced representation of an Austrian federal province (Bundesland)
 */
class FederalProvinceSummary
{
    /**
     * Unique key (Bundeslandkennziffer)
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
     * Initializes a new instance of the FederalProvinceSummary class.
     *
     * @param string $key  Unique key (Bundeslandkennziffer)
     * @param string $name  Name (Bundeslandname)
     */
    public function __construct(
        string $key, 
        string $name)
    {
        $this->key = $key;
        $this->name = $name;
    }

    /**
     * Creates a FederalProvinceSummary instance from an JSON array.
     *
     * @param array $data  The data array
     * @return FederalProvinceSummary  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null
        );
    }
}
?>
