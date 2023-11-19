<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

use function filter_var;

use const FILTER_VALIDATE_EMAIL;

/**
 * Validate email value using `filter_var` php function
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class IsEmail implements ValidationAttribute
{
    public function validateProperty(ReflectionProperty $property, object $object): void
    {
        $value = $property->getValue($object);
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new PropertyError($property, 'EMAIL_INVALID');
        }
    }
}
