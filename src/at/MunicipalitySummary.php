<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\AT;
 
/**
 * Reduced representation of an Austrian municipality (Gemeinde)
 */
class MunicipalitySummary
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
     * Status (Gemeindestatus)
     * 
     * @var string
     */
    public string $status;
 
    /**
     * Initializes a new instance of the MunicipalitySummary class.
     *
     * @param string $key  Key (Gemeindekennziffer)
     * @param string $name  Name (Gemeindename)
     * @param string $code  Code (Gemeindecode)
     * @param string $status  Status (Gemeindestatus)
     */
    public function __construct(
        string $key, 
        string $name, 
        string $code, 
        string $status)
    {
        $this->key = $key;
        $this->name = $name;
        $this->code = $code;
        $this->status = $status;
    }
 
    /**
     * Creates a MunicipalitySummary instance from an JSON array.
     *
     * @param array $data  The data array
     * @return MunicipalitySummary  The new instance
     */
    public static function fromJson(?array $data): ?self
    {
        if (empty($data)) {
            return null;
        }
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['code'] ?? null,
            $data['status'] ?? null
        );
    }
}
?>