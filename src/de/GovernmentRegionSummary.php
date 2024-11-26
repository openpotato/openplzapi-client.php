<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

/**
 * Reduced representation of a German government region (Regierungsbezirk)
 */
class GovernmentRegionSummary
{
    /**
     * Regional key (Regionalschlüssel)
     * 
     * @var string
     */
    public $key;

    /**
     * Name (Bundeslandname)
     * 
     * @var string
     */
    public $name;

    /**
     * Initializes a new instance of the GovernmentRegionSummary class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
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
     * Creates a GovernmentRegionSummary instance from an JSON array.
     *
     * @param array $data  The data array
     * @return GovernmentRegionSummary  The new instance
     */
    public static function fromJson(?array $data): ?self
    {
        if (empty($data)) {
            return null;
        }
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null
        );
    }
}
?>
