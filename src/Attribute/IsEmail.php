<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

use function filter_var;

use const FILTER_VALIDATE_EMAIL;

#[Attribute(Attribute::TARGET_PROPERTY)]
class IsEmail implements ValidationAttribute
{
    /** @param list<string, mixed> $config */
    public function validateProperty(ReflectionProperty $property, object $object, array $config): void
    {
        $value = $property->getValue($object);
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new PropertyError($property, 'EMAIL_INVALID', $config);
        }
    }
}
