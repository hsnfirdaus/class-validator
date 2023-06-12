<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionProperty;

use function trim;

#[Attribute(Attribute::TARGET_PROPERTY)]
class IsNotEmpty implements ValidationAttribute
{
    /** @param list<string, mixed> $config */
    public function validateProperty(ReflectionProperty $property, object $object, array $config): void
    {
        $value = $property->getValue($object);
        if ($value === null || trim((string) $value) === '') {
            throw new PropertyError($property, 'NOT_EMPTY', $config);
        }
    }
}
