<?php

declare(strict_types=1);

namespace CBOR;

class MapItem
{
	private $key;
	private $value;

	/**
	 * @param CBORObject $key
	 * @param CBORObject $value
	 */
    public function __construct(
        CBORObject $key,
        CBORObject $value
    ) {
	    $this->value = $value;
	    $this->key = $key;
    }

    public static function create(CBORObject $key, CBORObject $value): self
    {
        return new self($key, $value);
    }

    public function getKey(): CBORObject
    {
        return $this->key;
    }

    public function getValue(): CBORObject
    {
        return $this->value;
    }
}
