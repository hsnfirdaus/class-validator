<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Attribute;

use Attribute;

/**
 * Declare property as optional (can be uninitialized)
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class IsOptional
{
}
