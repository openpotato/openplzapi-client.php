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
     * Key (Bfs-Nummer des Bezirks)
     * 
     * @var string
     */
    public string $key;

    /**
     * Historical code (Historisierte Nummer des Bezirks)
     * 
     * @var string
     */
    public string $historicalCode;

    /**
     * Name (Bezirksname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Short name (Bezirksname, kurz)
     * 
     * @var string
     */
    public string $shortName;

    /**
     * Canton (Kanton)
     * 
     * @var CantonSummary
     */
    public CantonSummary $canton;
 
    /**
     * Initializes a new instance of the District class.
     *
     * @param string $key  Key (Bfs-Nummer des Bezirks)
     * @param string $historicalCode  Key (Bezirksnummer)
     * @param string $name  Name (Bezirksname)
     * @param string $shortName  Short name (Bezirksname, kurz)
     * @param CantonSummary $canton  Canton (Kanton)
     */
    public function __construct(
        string $key, 
        string $historicalCode, 
        string $name, 
        string $shortName, 
        CantonSummary $canton)
    {
        $this->key = $key;
        $this->historicalCode = $historicalCode;
        $this->name = $name;
        $this->shortName = $shortName;
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
            $data['historicalCode'] ?? null,
            $data['name'] ?? null,
            $data['shortName'] ?? null,
            CantonSummary::fromJson($data['canton'] ?? [])
        );
    }
}
?>