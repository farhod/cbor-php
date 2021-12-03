<?php

declare(strict_types=1);

namespace CBOR\Tag;

use CBOR\CBORObject;
use CBOR\Tag;

final class GenericTag extends Tag
{
    public static function getTagId(): int
    {
        return -1;
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
}
