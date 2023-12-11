<?php

declare(strict_types=1);

use Hsnfirdaus\ClassValidator\Attribute\IsNotEmpty;

final class NestedContract
{
    #[IsNotEmpty]
    public string $exampleProperty;
}
