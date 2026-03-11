<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

/**
 * Reduced representation of a German municipality (Gemeinde)
 */
class MunicipalitySummary
{
    /**
     * Regional key (Regionalschlüssel)
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
     * Type (Kennzeichen)
     * 
     * @var string
     */
    public ?string $type;

    /**
     * Initializes a new instance of the MunicipalitySummary class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
     * @param string $name  Name (Gemeindename)
     * @param ?string $type  Type (Kennzeichen)
     */
    public function __construct(
        string $key, 
        string $name,
        ?string $type)
    {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
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
            $data['key'],
            $data['name'],
            $data['type'] ?? null
        );
    }
}
?>
