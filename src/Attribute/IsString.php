<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

use function strlen;

/**
 * Validate string length
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class IsString implements ValidationAttribute
{
    /**
     * @param int|null $length    Fixed length
     * @param int|null $minLength Minimum string length
     * @param int|null $maxLength Maximum string length
     */
    public function __construct(
        private int|null $length = null,
        private int|null $minLength = null,
        private int|null $maxLength = null,
    ) {
    }

    public function validateProperty(ReflectionProperty $property, object $object): void
    {
        $value = $property->getValue($object);

        if (isset($this->length) && strlen((string) $value) !== $this->length) {
            throw new PropertyError($property, 'STRING_INVALID_LENGTH', $this->length);
        }

        if (isset($this->minLength) && strlen((string) $value) < $this->minLength) {
            throw new PropertyError($property, 'STRING_INVALID_MIN_LENGTH', $this->minLength);
        }

        if (isset($this->maxLength) && strlen((string) $value) > $this->maxLength) {
            throw new PropertyError($property, 'STRING_INVALID_MAX_LENGTH', $this->maxLength);
        }
    }
}
