<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\AT;
 
use OpenPlzApi\AT\DistrictSummary;
use OpenPlzApi\AT\FederalProvinceSummary;
 
/**
 * Representation of an Austrian municipality (Gemeinde)
 */
class Municipality
{
    /**
     * Key (Gemeindekennziffer)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Gemeindename)
     * 
     * @var string
     */
    public string $name;

    /**
     * Code (Gemeindecode)
     * 
     * @var string
     */
    public string $code;

    /**
     * Postal code (Postleitzahl des Gemeindeamtes)
     * 
     * @var string
     */
    public string $postalCode;

    /**
     * This municipality has multiple postal codes?
     * 
     * @var bool
     */
    public bool $multiplePostalCodes;

    /**
     * Status (Gemeindestatus)
     * 
     * @var string|null
     */
    public ?string $status;

    /**
     * District (Bezirk)
     * 
     * @var string
     */
    public DistrictSummary $district;

    /**
     * Federal province (Bundesland)
     * 
     * @var FederalProvinceSummary
     */
    public FederalProvinceSummary $federalProvince;
 
    /**
     * Initializes a new instance of the Municipality class.
     *
     * @param string $key  Key (Gemeindekennziffer)
     * @param string $name The name
     * @param string $code  Code (Gemeindecode)
     * @param string $postalCode  Postal code (Postleitzahl des Gemeindeamtes)
     * @param bool $multiplePostalCodes  This municipality has multiple postal codes?
     * @param string|null $status  Status (Gemeindestatus)
     * @param DistrictSummary $district  District (Bezirk)
     * @param FederalProvinceSummary $federalProvince  Federal province (Bundesland)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $code, 
        string $postalCode,
        string $multiplePostalCodes,
        ?string $status,
        DistrictSummary $district,
        FederalProvinceSummary $federalProvince)
    {
        $this->key = $key;
        $this->name = $name;
        $this->code = $code;
        $this->postalCode = $postalCode;
        $this->multiplePostalCodes = $multiplePostalCodes;
        $this->status = $status;
        $this->district = $district; 
        $this->federalProvince = $federalProvince;
    }
 
    /**
     * Creates a Municipality instance from an JSON array.
     *
     * @param array $data The data array
     * @return Municipality The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'],
            $data['name'],
            $data['code'],
            $data['postalCode'],
            $data['multiplePostalCodes'],
            $data['status'] ?? null,
            DistrictSummary::fromJson($data['district']),
            FederalProvinceSummary::fromJson($data['federalProvince'])
        );
    }
}
?>