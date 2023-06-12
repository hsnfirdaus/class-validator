<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

use function is_int;

#[Attribute(Attribute::TARGET_PROPERTY)]
class IsInteger implements ValidationAttribute
{
    /** @param list<string, mixed> $config */
    public function validateProperty(ReflectionProperty $property, object $object, array $config): void
    {
        $value = $property->getValue($object);
        if (! is_int($value)) {
            throw new PropertyError($property, 'INTEGER_INVALID', $config);
        }
    }
}
