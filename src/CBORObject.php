<?php

declare(strict_types=1);

namespace CBOR;

interface CBORObject
{
	const MAJOR_TYPE_UNSIGNED_INTEGER = 0b000;

	const MAJOR_TYPE_NEGATIVE_INTEGER = 0b001;

	const MAJOR_TYPE_BYTE_STRING = 0b010;

	const MAJOR_TYPE_TEXT_STRING = 0b011;

	const MAJOR_TYPE_LIST = 0b100;

	const MAJOR_TYPE_MAP = 0b101;

	const MAJOR_TYPE_TAG = 0b110;

	const MAJOR_TYPE_OTHER_TYPE = 0b111;

	const LENGTH_1_BYTE = 0b00011000;

	const LENGTH_2_BYTES = 0b00011001;

	const LENGTH_4_BYTES = 0b00011010;

	const LENGTH_8_BYTES = 0b00011011;

	const LENGTH_INDEFINITE = 0b00011111;

	const FUTURE_USE_1 = 0b00011100;

	const FUTURE_USE_2 = 0b00011101;

	const FUTURE_USE_3 = 0b00011110;

	const OBJECT_FALSE = 20;

	const OBJECT_TRUE = 21;

	const OBJECT_NULL = 22;

	const OBJECT_UNDEFINED = 23;

	const OBJECT_SIMPLE_VALUE = 24;

	const OBJECT_HALF_PRECISION_FLOAT = 25;

	const OBJECT_SINGLE_PRECISION_FLOAT = 26;

	const OBJECT_DOUBLE_PRECISION_FLOAT = 27;

	const OBJECT_BREAK = 0b00011111;

	const TAG_STANDARD_DATETIME = 0;

	const TAG_EPOCH_DATETIME = 1;

	const TAG_UNSIGNED_BIG_NUM = 2;

	const TAG_NEGATIVE_BIG_NUM = 3;

	const TAG_DECIMAL_FRACTION = 4;

	const TAG_BIG_FLOAT = 5;

	const TAG_ENCODED_BASE64_URL = 21;

	const TAG_ENCODED_BASE64 = 22;

	const TAG_ENCODED_BASE16 = 23;

	const TAG_ENCODED_CBOR = 24;

	const TAG_URI = 32;

	const TAG_BASE64_URL = 33;

	const TAG_BASE64 = 34;

	const TAG_MIME = 36;

	const TAG_CBOR = 55799;

	function __toString(): string;

	function getMajorType(): int;

	function getAdditionalInformation(): int;
}
