<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\DE;

/**
 * Reduced representation of a German federal state (Bundesland)
 */
class FederalStateSummary
{
    /**
     * Regional key (Regionalschlüssel)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Bundeslandname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Initializes a new instance of the FederalState class.
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
     * Creates a FederalStateSummary instance from an JSON array.
     *
     * @param array $data The data array
     * @return FederalStateSummary The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null
        );
    }
}
?>
