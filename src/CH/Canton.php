<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi\CH;

/**
 * Representation of a Swiss canton (Kanton)
 */
class Canton
{
    /**
     * Key (Bfs-Nummer des Kantons)
     * 
     * @var string
     */
    public string $key;

    /**
     * Historical code (Historisierte Nummer des Kantons)
     * 
     * @var string
     */
    public string $historicalCode;

    /**
     * Name (Kantonsname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Short name (Kantonskürzel)
     * 
     * @var string
     */
    public string $shortName;

    /**
     * Initializes a new instance of the Canton class.
     *
     * @param string $key  Key (Bfs-Nummer des Kantons)
     * @param string $historicalCode  Historical code (Historisierte Nummer des Kantons)
     * @param string $name  Name (Kantonsname)
     * @param string $shortName  Short name (Kantonskürzel)
     */
    public function __construct(
        string $key, 
        string $historicalCode,
        string $name, 
        string $shortName)
    {
        $this->key = $key;
        $this->historicalCode = $historicalCode;
        $this->name = $name;
        $this->shortName = $shortName;
    }

    /**
     * Creates a Canton instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Canton  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['historicalCode'] ?? null,
            $data['name'] ?? null,
            $data['shortName'] ?? null
        );
    }
}
?>
