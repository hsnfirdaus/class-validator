<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Trait;

use Hsnfirdaus\ClassValidator\Attribute\ValidationAttribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionClass;

trait ReflectProperty
{
    public function assertValidProperty(ValidationAttribute $instance, object $object): void
    {
        $reflection = new ReflectionClass($object);
        $prop       = $reflection->getProperty('value');
        $this->assertNull($instance->validateProperty($prop, $object));
    }

    public function assertInvalidProperty(ValidationAttribute $instance, object $object): void
    {
        $reflection = new ReflectionClass($object);
        $prop       = $reflection->getProperty('value');
        $this->expectException(PropertyError::class);
        $instance->validateProperty($prop, $object);
    }
}
