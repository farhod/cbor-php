<?php

declare(strict_types=1);

namespace CBOR\Tag;

use CBOR\CBORObject;
use CBOR\Tag;

interface TagManagerInterface
{
	/**
	 * @param int         $additionalInformation
	 * @param string|null $data
	 * @param CBORObject  $object
	 * @return Tag
	 */
    public function createObjectForValue(int $additionalInformation, $data, CBORObject $object): Tag;
}
