<?php

declare(strict_types=1);

namespace CBOR;

use function chr;
use Stringable;

abstract class AbstractCBORObject implements CBORObject, Stringable
{
	protected $additionalInformation;
	private $majorType;

	/**
	 * @param int $majorType
	 * @param int $additionalInformation
	 */
    public function __construct(
        int $majorType,
        int $additionalInformation
    ) {
	    $this->additionalInformation = $additionalInformation;
	    $this->majorType = $majorType;
    }

    public function __toString(): string
    {
        return chr($this->majorType << 5 | $this->additionalInformation);
    }

    public function getMajorType(): int
    {
        return $this->majorType;
    }

    public function getAdditionalInformation(): int
    {
        return $this->additionalInformation;
    }
}
