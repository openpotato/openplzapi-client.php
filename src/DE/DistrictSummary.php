<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

/**
 * Reduced representation of a German district (Kreis)
 */
class DistrictSummary
{
    /**
     * Regional key (Regionalschlüssel)
     * 
     * @var string
     */
    public $key;

    /**
     * Name (Kreisname)
     * 
     * @var string
     */
    public $name;

    /**
     * Type (Kennzeichen)
     * 
     * @var string
     */
    public $type;

    /**
     * Initializes a new instance of the DistrictSummary class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
     * @param string $name Name (Kreisname)
     * @param string $type   Type (Kennzeichen)
     */
    public function __construct(
        string $key, 
        string $name,
        string $type)
    {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
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
            $data['type'] ?? null
        );
    }
}
?>
