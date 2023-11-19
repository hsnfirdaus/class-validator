<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;

/**
 * Customized error message label
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Name
{
    /** @param string $name Label of field */
    public function __construct(string $name)
    {
    }
}
