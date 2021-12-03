<?php

declare(strict_types=1);

namespace CBOR\OtherObject;

use CBOR\Normalizable;
use CBOR\OtherObject as Base;

final class NullObject extends Base implements Normalizable
{
	public function __construct()
	{
		parent::__construct(self::OBJECT_NULL, null);
	}

	public static function create(): self
	{
		return new self();
	}

	public static function supportedAdditionalInformation(): array
	{
		return [self::OBJECT_NULL];
	}

	/**
	 * @param int         $additionalInformation
	 * @param string|null $data
	 * @return Base
	 */
	public static function createFromLoadedData(int $additionalInformation, $data): Base
	{
		return new self();
	}

	/**
	 * @return string|null
	 */
	public function normalize()
	{
		return null;
	}
}
