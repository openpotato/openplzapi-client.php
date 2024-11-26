<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

/**
 * Reduced representation of a German municipal association (Gemeindeverband)
 */
class MunicipalAssociationSummary
{
    /**
     * Regional key (Regionalschlüssel)
     * 
     * @var string
     */
    public $key;

    /**
     * Name (Name des Gemeindeverbandes)
     * 
     * @var string
     */
    public $name;

    /**
     * Type (Kennzeichen des Gemeindeverbandes)
     * 
     * @var string
     */
    public $type;

    /**
     * Initializes a new instance of the MunicipalAssociationSummary class.
     *
     * @param string $key  Regional key (Regionalschlüssel)
     * @param string $name  Name (Name des Gemeindeverbandes)
     * @param string $type  Type (Kennzeichen des Gemeindeverbandes)
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
     * Creates a MunicipalAssociationSummary instance from an JSON array.
     *
     * @param array $data  The data array
     * @return MunicipalAssociationSummary  The new instance
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
