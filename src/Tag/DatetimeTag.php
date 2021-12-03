<?php

declare(strict_types=1);

namespace CBOR\Tag;

use CBOR\CBORObject;
use CBOR\IndefiniteLengthTextStringObject;
use CBOR\Normalizable;
use CBOR\Tag;
use CBOR\TextStringObject;
use const DATE_RFC3339;
use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;

final class DatetimeTag extends Tag implements Normalizable
{
	/**
	 * @param int         $additionalInformation
	 * @param string|null $data
	 * @param CBORObject  $object
	 */
    public function __construct(int $additionalInformation, $data, CBORObject $object)
    {
        if (! $object instanceof TextStringObject && ! $object instanceof IndefiniteLengthTextStringObject) {
            throw new InvalidArgumentException('This tag only accepts a Byte String object.');
        }
        parent::__construct($additionalInformation, $data, $object);
    }

    public static function getTagId(): int
    {
        return self::TAG_STANDARD_DATETIME;
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
        list($ai, $data) = self::determineComponents(self::TAG_STANDARD_DATETIME);

        return new self($ai, $data, $object);
    }

    public function normalize(): DateTimeInterface
    {
        /** @var TextStringObject|IndefiniteLengthTextStringObject $object */
        $object = $this->object;
        $result = DateTimeImmutable::createFromFormat(DATE_RFC3339, $object->normalize());
        if ($result !== false) {
            return $result;
        }

        $formatted = DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s.uP', $object->normalize());
        if ($formatted === false) {
            throw new InvalidArgumentException('Invalid data. Cannot be converted into a datetime object');
        }

        return $formatted;
    }
}
