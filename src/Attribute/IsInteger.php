<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

use function is_int;

/**
 * Validate value is integer using php `is_int` function
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class IsInteger implements ValidationAttribute
{
    public function validateProperty(ReflectionProperty $property, object $object): void
    {
        $value = $property->getValue($object);
        if (! is_int($value)) {
            throw new PropertyError($property, 'INTEGER_INVALID');
        }
    }
}
