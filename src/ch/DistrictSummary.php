<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;
 
/**
 * Reduced representation of a Swiss district (Bezirk)
 */
class DistrictSummary
{
    /**
     * Key (Bfs-Nummer der Gemeinde)
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
     * Short name (Bezirksname, kurz)
     * 
     * @var string
     */
    public string $shortName;
 
    /**
     * Initializes a new instance of the DistrictSummary class.
     *
     * @param string $key  Key (Bfs-Nummer der Gemeinde)
     * @param string $name  Name (Bezirksname)
     * @param string $shortName  Short name (Bezirksname, kurz)
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
     * Creates a DistrictSummary instance from an JSON array.
     *
     * @param array $data  The data array
     * @return DistrictSummary  The new instance
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