<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator;

use Hsnfirdaus\ClassValidator\Attribute\IsOptional;
use Hsnfirdaus\ClassValidator\Attribute\ValidationAttribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;

use const Hsnfirdaus\ClassValidator\Locale\ID;

class Validator
{
    /** @param list<string, mixed> $config */
    public static function validate(object $object, array $config = ['language' => ID]): bool
    {
        $reflection = new ReflectionClass($object);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            self::validateProperty($property, $object, $config);
        }

        return true;
    }

    /** @param list<string, mixed> $config */
    private static function validateProperty(ReflectionProperty $property, object $object, array $config): void
    {
        if (! $property->isInitialized($object) || $property->getValue($object) === '' || $property->getValue($object) === null) {
            if (! $property->getAttributes(IsOptional::class)) {
                throw new PropertyError($property, 'NOT_EMPTY', $config);
            }

            return;
        }

        $attributes = $property->getAttributes(ValidationAttribute::class, ReflectionAttribute::IS_INSTANCEOF);
        foreach ($attributes as $attribute) {
            $instance = $attribute->newInstance();
            $instance->validateProperty($property, $object, $config);
        }
    }
}
