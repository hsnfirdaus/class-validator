<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

/**
 * Validate value as member of enum value.
 * This will using `tryFrom` enum function.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class IsEnum implements ValidationAttribute
{
    /** @param string $enum Enum namespace (example: MyEnum::class) **/
    public function __construct(
        private string $enum,
    ) {
    }

    public function validateProperty(ReflectionProperty $property, object $object): void
    {
        $value = $property->getValue($object);

        $match = $this->enum::tryFrom($value);
        if (! $match) {
            throw new PropertyError($property, 'ENUM_INVALID');
        }
    }
}
