<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

/**
 * Validate the value is not empty using php function
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class IsNotEmpty implements ValidationAttribute
{
    public function validateProperty(ReflectionProperty $property, object $object): void
    {
        $value = $property->getValue($object);
        if (empty($value)) {
            throw new PropertyError($property, 'NOT_EMPTY');
        }
    }
}
