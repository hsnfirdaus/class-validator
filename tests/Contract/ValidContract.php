<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Contract;

use Hsnfirdaus\ClassValidator\Attribute\IsEmail;
use Hsnfirdaus\ClassValidator\Attribute\IsEnum;
use Hsnfirdaus\ClassValidator\Attribute\IsInteger;
use Hsnfirdaus\ClassValidator\Attribute\IsNotEmpty;
use Hsnfirdaus\ClassValidator\Attribute\IsNumeric;
use Hsnfirdaus\ClassValidator\Attribute\IsOptional;
use Hsnfirdaus\ClassValidator\Attribute\IsString;
use Hsnfirdaus\ClassValidator\Attribute\Name;
use Hsnfirdaus\ClassValidator\Attribute\ValidateArrayClass;
use Hsnfirdaus\ClassValidator\Attribute\ValidateClass;

final class ValidContract
{
    #[IsNotEmpty]
    public string $notEmpty = 'Example Value';

    #[IsEmail]
    public string $email = 'hasanteam008@gmail.com';

    #[IsEnum(enum: MyType::class)]
    public string $enum = 'FIRST_VALUE';

    #[IsInteger]
    public int $integer = 3;

    #[Name('Example Label')]
    #[IsNumeric(length: 10)]
    public int $numeric = 1234567890;

    #[IsOptional]
    public string $willSkipped;

    #[IsString(length: 6)]
    public string $string = 'STRING';

    /** @var NestedContract[] $parentOfNested */
    #[ValidateArrayClass(type: NestedContract::class)]
    public array $parentOfNested;

    #[ValidateClass(type: NestedContract::class)]
    public mixed $parentOfNestedClass;

    public function __construct()
    {
        $item1                  = new NestedContract();
        $item1->exampleProperty = 'So valid';

        $this->parentOfNested = [$item1];

        $nestedClass                  = new NestedContract();
        $nestedClass->exampleProperty = 'So valid';
        $this->parentOfNestedClass    = $nestedClass;
    }
}
