<?php

declare(strict_types=1);

namespace CBOR;

abstract class OtherObject extends AbstractCBORObject
{
    const MAJOR_TYPE = self::MAJOR_TYPE_OTHER_TYPE;
	protected $data;

	/**
	 * @param int    $additionalInformation
	 * @param string|null $data
	 */
	public function __construct(
        int $additionalInformation,
        $data
    ) {
		$this->data = $data;
		parent::__construct(self::MAJOR_TYPE, $additionalInformation);
    }

    public function __toString(): string
    {
        $result = parent::__toString();
        if ($this->data !== null) {
            $result .= $this->data;
        }

        return $result;
    }

	/**
	 * @return string|null
	 */
    public function getContent()
    {
        return $this->data;
    }

    /**
     * @return int[]
     */
    abstract public static function supportedAdditionalInformation(): array;

	/**
	 * @param int         $additionalInformation
	 * @param string|null $data
	 * @return static
	 */
    abstract public static function createFromLoadedData(int $additionalInformation, $data): self;
}
