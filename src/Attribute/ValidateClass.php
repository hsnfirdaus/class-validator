<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use Hsnfirdaus\ClassValidator\Validator;
use ReflectionProperty;
use Throwable;

/**
 * Validate the value is instance of object and execute validation
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class ValidateClass implements ValidationAttribute
{
    /** @param string|null $type Class type namespace (example: MyClass::class) **/
    public function __construct(
        private string|null $type = null,
    ) {
    }

    public function validateProperty(ReflectionProperty $property, object $object): void
    {
        $value = $property->getValue($object);
        if (isset($this->type)) {
            if (! $value instanceof $this->type) {
                throw new PropertyError($property, 'VALIDATE_CLASS_INVALID');
            }
        }

        try {
            Validator::validate($value);
        } catch (Throwable $th) {
            $msg = $th->getMessage();

            throw new PropertyError($property, 'VALIDATE_CLASS_INVALID_NESTED', $msg);
        }
    }
}
