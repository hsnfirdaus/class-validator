<?php

declare(strict_types=1);

require __DIR__ . '/ExampleEnum.php';

use Hsnfirdaus\ClassValidator\Attribute\IsEmail;
use Hsnfirdaus\ClassValidator\Attribute\IsEnum;
use Hsnfirdaus\ClassValidator\Attribute\IsInteger;
use Hsnfirdaus\ClassValidator\Attribute\IsNotEmpty;
use Hsnfirdaus\ClassValidator\Attribute\IsNumeric;
use Hsnfirdaus\ClassValidator\Attribute\IsOptional;
use Hsnfirdaus\ClassValidator\Attribute\IsString;
use Hsnfirdaus\ClassValidator\Attribute\Name;

final class ValidContract
{
    #[IsNotEmpty]
    public string $notEmpty = 'Example Value';

    #[IsEmail]
    public string $email = 'hasanteam008@gmail.com';

    #[IsEnum(enum: ExampleEnum::class)]
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
}
