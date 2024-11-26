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
     * Key (Kantonsnummer)
     * 
     * @var string
     */
    public string $key;

    /**
     * Name (Kantonsname)
     * 
     * @var string
     */
    public string $name;

    /**
     * Code (Kantonskürzel)
     * 
     * @var string
     */
    public string $code;

    /**
     * Initializes a new instance of the Canton class.
     *
     * @param string $key  Key (Kantonsnummer)
     * @param string $name  Name (Kantonsname)
     * @param string $code  Code (Kantonskürzel)
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
     * Creates a Canton instance from an JSON array.
     *
     * @param array $data  The data array
     * @return Canton  The new instance
     */
    public static function fromJson(array $data): self
    {
        return new self(
            $data['key'] ?? null,
            $data['name'] ?? null,
            $data['code'] ?? null
        );
    }
}
?>
