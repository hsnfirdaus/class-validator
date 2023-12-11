<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;
use Hsnfirdaus\ClassValidator\Error\PropertyError;
use Hsnfirdaus\ClassValidator\Validator;
use ReflectionProperty;
use Throwable;

use function is_array;

/**
 * Validate nested array of class
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class ValidateArrayClass implements ValidationAttribute
{
    /** @param string|null $type Class type namespace (example: MyClass::class) **/
    public function __construct(
        private string|null $type = null,
    ) {
    }

    public function validateProperty(ReflectionProperty $property, object $object): void
    {
        $value = $property->getValue($object);
        if (! is_array($value)) {
            throw new PropertyError($property, 'VALIDATE_ARRAY_CLASS_INVALID');
        }

        $idx = 0;
        foreach ($value as $item) {
            if (isset($this->type)) {
                if (! $item instanceof $this->type) {
                    throw new PropertyError($property, 'VALIDATE_ARRAY_CLASS_INVALID');
                }
            }

            try {
                Validator::validate($item);
            } catch (Throwable $th) {
                $msg = $th->getMessage();

                throw new PropertyError($property, 'VALIDATE_ARRAY_CLASS_INDEX_INVALID', $idx, $msg);
            }

            $idx++;
        }
    }
}
