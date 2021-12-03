<?php

declare(strict_types=1);

namespace CBOR;

final class ByteStringObject extends AbstractCBORObject implements Normalizable
{
    const MAJOR_TYPE = self::MAJOR_TYPE_BYTE_STRING;

    private $value;

    private $length = null;

    public function __construct(string $data)
    {
        list($additionalInformation, $length) = LengthCalculator::getLengthOfString($data);

        parent::__construct(self::MAJOR_TYPE, $additionalInformation);
        $this->length = $length;
        $this->value = $data;
    }

    public function __toString(): string
    {
        $result = parent::__toString();
        if ($this->length !== null) {
            $result .= $this->length;
        }

        return $result . $this->value;
    }

    public static function create(string $data): self
    {
        return new self($data);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getLength(): int
    {
        return mb_strlen($this->value, '8bit');
    }

    public function normalize(): string
    {
        return $this->value;
    }
}
