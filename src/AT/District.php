<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\AT;
 
use OpenPlzApi\AT\FederalProvinceSummary;
 
/**
 * Representation of an Austrian district (Bezirk)
 */
class District
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
     * Federal province (Bundesland)
     * 
     * @var FederalProvinceSummary
     */
    public FederalProvinceSummary $federalProvince;
 
    /**
     * Initializes a new instance of the District class.
     *
     * @param string $key  Unique key (Bezirkskennziffer)
     * @param string $name  Name (Bezirksname)
     * @param string $code  Code (Bezirkskodierung)
     * @param FederalProvinceSummary $federalProvince  Federal province (Bundesland)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $code, 
        FederalProvinceSummary $federalProvince)
    {
        $this->key = $key;
        $this->name = $name;
        $this->code = $code;
        $this->federalProvince = $federalProvince;
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
            $data['code'] ?? null,
            FederalProvinceSummary::fromJson($data['federalProvince'] ?? [])
        );
    }
}
?>