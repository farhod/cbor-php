<?php

declare(strict_types=1);

namespace CBOR\OtherObject;

use CBOR\OtherObject;

interface OtherObjectManagerInterface
{
	/**
	 * @param int         $value
	 * @param string|null $data
	 * @return OtherObject
	 */
	public function createObjectForValue(int $value, $data): OtherObject;
}
