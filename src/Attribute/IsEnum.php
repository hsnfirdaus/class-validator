<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

#[Attribute(Attribute::TARGET_PROPERTY)]
class IsEnum implements ValidationAttribute
{
    public function __construct(
        private string $enum,
    ) {
    }

    /** @param list<string, mixed> $config */
    public function validateProperty(ReflectionProperty $property, object $object, array $config): void
    {
        $value = $property->getValue($object);

        $match = $this->enum::tryFrom($value);
        if (! $match) {
            throw new PropertyError($property, 'ENUM_INVALID', $config);
        }
    }
}
