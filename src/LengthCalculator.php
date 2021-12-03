<?php

declare(strict_types=1);

namespace CBOR;

use Brick\Math\BigInteger;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Internal\Calculator;
use function chr;
use function count;
use InvalidArgumentException;
use const STR_PAD_LEFT;

final class LengthCalculator
{
	/**
	 * @return array{int, null|string}
	 */
	public static function getLengthOfString(string $data): array
	{
		$length = mb_strlen($data, '8bit');

		return self::computeLength($length);
	}

	/**
	 * @param array<int|string, mixed> $data
	 *
	 * @return array{int, null|string}
	 */
	public static function getLengthOfArray(array $data): array
	{
		$length = count($data);

		return self::computeLength($length);
	}

	/**
	 * @return array{int, null|string}
	 */
	private static function computeLength(int $length): array
	{
		switch ($length) {
			case $length <= 23:
				$return = [$length, null];
				break;
			case $length <= 0xFF:
				$return = [24, chr($length)];
				break;
			case $length <= 0xFFFF:
				$return = [25, self::hex2bin(dechex($length))];
				break;
			case $length <= 0xFFFFFFFF:
				$return = [26, self::hex2bin(dechex($length))];
				break;
			case BigInteger::of($length)->isLessThan(Decoder::fromBase('FFFFFFFFFFFFFFFF', 16)):
				$return = [
					27,
					self::hex2bin(dechex($length)),
				];
				break;
			default :
				$return = [31, null];
		}

		return $return;


//		return match (true) {
//			$length <= 23 => [$length, null],
//			$length <= 0xFF => [24, chr($length)],
//			$length <= 0xFFFF => [25, self::hex2bin(dechex($length))],
//			$length <= 0xFFFFFFFF => [26, self::hex2bin(dechex($length))],
//			BigInteger::of($length)->isLessThan(BigInteger::fromBase('FFFFFFFFFFFFFFFF', 16)) => [
//				27,
//				self::hex2bin(dechex($length)),
//			],
//			default => [31, null],
//		};
	}

	private static function hex2bin(string $data): string
	{
		$data = str_pad($data, (int)(2 ** ceil(log(mb_strlen($data, '8bit'), 2))), '0', STR_PAD_LEFT);
		$result = hex2bin($data);
		if ($result === false) {
			throw new InvalidArgumentException('Unable to convert the data');
		}

		return $result;
	}

	public static function fromBase(string $number, int $base) : BigInteger
	{
		if ($number === '') {
			throw new NumberFormatException('The number cannot be empty.');
		}

		if ($base < 2 || $base > 36) {
			throw new \InvalidArgumentException(\sprintf('Base %d is not in range 2 to 36.', $base));
		}

		if ($number[0] === '-') {
			$sign = '-';
			$number = \substr($number, 1);
		} elseif ($number[0] === '+') {
			$sign = '';
			$number = \substr($number, 1);
		} else {
			$sign = '';
		}

		if ($number === '') {
			throw new NumberFormatException('The number cannot be empty.');
		}

		$number = \ltrim($number, '0');

		if ($number === '') {
			// The result will be the same in any base, avoid further calculation.
			return BigInteger::zero();
		}

		if ($number === '1') {
			// The result will be the same in any base, avoid further calculation.
			return BigInteger::of($sign . '1');
		}

		$pattern = '/[^' . \substr(Calculator::ALPHABET, 0, $base) . ']/';

		if (\preg_match($pattern, \strtolower($number), $matches) === 1) {
			throw new NumberFormatException(\sprintf('"%s" is not a valid character in base %d.', $matches[0], $base));
		}

		if ($base === 10) {
			// The number is usable as is, avoid further calculation.
			return BigInteger::of($sign . $number);
		}

		$result = Calculator::get()->fromBase($number, $base);

		return BigInteger::of($sign . $result);
	}

}
