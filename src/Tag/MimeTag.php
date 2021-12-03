<?php

declare(strict_types=1);

namespace CBOR\Tag;

use CBOR\CBORObject;
use CBOR\IndefiniteLengthTextStringObject;
use CBOR\Normalizable;
use CBOR\Tag;
use CBOR\TextStringObject;
use InvalidArgumentException;

final class MimeTag extends Tag implements Normalizable
{
	/**
	 * @param int         $additionalInformation
	 * @param string|null $data
	 * @param CBORObject  $object
	 */
	public function __construct(int $additionalInformation, $data, CBORObject $object)
	{
		if (!$object instanceof TextStringObject && !$object instanceof IndefiniteLengthTextStringObject) {
			throw new InvalidArgumentException('This tag only accepts a Byte String object.');
		}

		parent::__construct($additionalInformation, $data, $object);
	}

	public static function getTagId(): int
	{
		return self::TAG_MIME;
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
		list($ai, $data) = self::determineComponents(self::TAG_MIME);

		return new self($ai, $data, $object);
	}

	public function normalize(): string
	{
		/** @var TextStringObject|IndefiniteLengthTextStringObject $object */
		$object = $this->object;

		return $object->normalize();
	}
}
