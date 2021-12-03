<?php

declare(strict_types=1);

namespace CBOR\Tag;

use CBOR\CBORObject;
use CBOR\Normalizable;
use CBOR\Tag;

final class CBORTag extends Tag implements Normalizable
{
    public static function getTagId(): int
    {
        return self::TAG_CBOR;
    }

	/**
	 * @param int         $additionalInformation
	 * @param string|null $data
	 * @param CBORObject  $object
	 * @return Tag
	 */
    public static function createFromLoadedData(int $additionalInformation, $data, CBORObject $object): Tag
    {
        return new self($additionalInformation, $data, $object);
    }

    public static function create(CBORObject $object): Tag
    {
        list($ai, $data) = self::determineComponents(self::TAG_CBOR);

        return new self($ai, $data, $object);
    }

    /**
     * @return mixed|CBORObject|null
     */
    public function normalize()
    {
        return $this->object instanceof Normalizable ? $this->object->normalize() : $this->object;
    }
}
