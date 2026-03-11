<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

 namespace OpenPlzApi\AT;
 
/**
 * Reduced representation of an Austrian district (Bezirk)
 */
class DistrictSummary
{
    /**
     * Unique key (Bezirkskennziffer)
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
     * Code (Bezirkskodierung)
     * 
     * @var string
     */
    public string $code;
 
    /**
     * Initializes a new instance of the DistrictSummary class.
     *
     * @param string $key  Unique key (Bezirkskennziffer)
     * @param string $name  Name (Bezirksname)
     * @param string $code  Code (Bezirkskodierung)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $code)
    {
        $this->key = $key;
        $this->name = $name;
        $this->code = $code;
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
            $data['code'] ?? null
        );
    }
 }
 ?>