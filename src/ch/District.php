<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;
 
use OpenPlzApi\CH\CantonSummary;
 
/**
 * Representation of a Swiss district (Bezirk)
 */
class District
{
    /**
     * Key (Bezirksnummer)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Bezirksname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Canton (Kanton)
     * 
     * @var CantonSummary
     */
    public CantonSummary $canton;
 
    /**
     * Initializes a new instance of the District class.
     *
     * @param string $key  Key (Bezirksnummer)
     * @param string $name  Name (Bezirksname)
     * @param CantonSummary $canton  Canton (Kanton)
     */
    public function __construct(
        string $key, 
        string $name, 
        CantonSummary $canton)
    {
        $this->key = $key;
        $this->name = $name;
        $this->canton = $canton;
    }
 
    /**
     * Creates a District instance from an JSON array.
     *
     * @param array $data  The data array
     * @return District  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            CantonSummary::fromJson($data['canton'] ?? [])
        );
    }
}
?>