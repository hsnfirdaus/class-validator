<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use ReflectionProperty;

interface ValidationAttribute
{
    public function validateProperty(ReflectionProperty $property, object $object): void;
}
