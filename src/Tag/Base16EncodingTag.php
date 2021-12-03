<?php

declare(strict_types=1);

namespace CBOR\Tag;

use CBOR\CBORObject;
use CBOR\Tag;

final class Base16EncodingTag extends Tag
{
    public static function getTagId(): int
    {
        return self::TAG_ENCODED_BASE16;
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
       list($ai, $data) = self::determineComponents(self::TAG_ENCODED_BASE16);

        return new self($ai, $data, $object);
    }
}
