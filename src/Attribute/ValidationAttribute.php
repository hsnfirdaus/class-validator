<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use ReflectionProperty;

interface ValidationAttribute
{
    /** @param list<string, mixed> $config */
    public function validateProperty(ReflectionProperty $property, object $object, array $config): void;
}
