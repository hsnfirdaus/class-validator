<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Contract;

use Hsnfirdaus\ClassValidator\Attribute\IsNotEmpty;

final class NestedContract
{
    #[IsNotEmpty]
    public string $exampleProperty;
}
