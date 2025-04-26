# Class Validator (DEPRECATED)

PHP Class Validator using php 8.0 attributes.

> [!CAUTION]
> This package no longer maintained, use [symfony/validator](https://github.com/symfony/validator) instead.


## Installation

Using Composer:

```bash
composer require "hsnfirdaus/class-validator"
```

## Usage

Example Usage:

```php
<?php

declare(strict_types=1);

namespace MyApp\Contract\User;

use Hsnfirdaus\ClassValidator\Attribute\IsEnum;
use Hsnfirdaus\ClassValidator\Attribute\IsNotEmpty;
use Hsnfirdaus\ClassValidator\Attribute\IsOptional;
use Hsnfirdaus\ClassValidator\Validator;
use MyApp\Entity\Enum\UserRole;
use MyApp\Entity\Enum\UserType;

class AddUserContract
{
    #[Name(name: 'User Type')]
    #[IsNotEmpty]
    #[IsEnum(enum: UserType::class)]
    public string $type = 'Can\'t be empty';

    #[IsNotEmpty]
    #[IsEnum(enum: UserRole::class)]
    public string $role = 'ValidEnumValue';

    #[IsOptional]
    public string $identifier;

    public function validate()
    {
        Validator::validate($this);
    }
}
```

Then call validate method, it will throw exception if found an error. Currently this package only support property attribute.

## Available Attributes

Available attributes (see [src/Attribute](src/Attribute/) folder):

- `IsEmail()` : Email validation (using php `filter_var` function).
- `IsEnum(enum: ExampleEnum::class)` : Enum validation from string value.
- `IsInteger()` : Integer validation (using php `is_int` function).
- `IsNotEmpty()` : Validate trimmed value is not empty string or null.
- `IsNumeric(length?: number, minLength?: number, maxLength?: number)` : Validate numeric string (using php `is_numeric` function).
- `IsOptional()` : Attribute to mark the property is optional, allow to be not defined.
- `IsString(length?: number, minLength?: number, maxLength?: number)` : Validate string length.
- `Name(name: string)` : Set error message field name (optional, default will be the property name).
- `ValidateArrayClass(type: string)` : Nested validate array of class.
- `ValidateClass()` : Nested validate class.

## Error Message

Currently only English and Indonesian error message will thrown (see [locale](locale)). Default will be English.

To change locale you can use and `setLang` method in your root or boot project:

```php
<?php

declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use Hsnfirdaus\ClassValidator\Validator;

Validator::setLang('id');

// Then you can call  Validator::validate method
```

Or, you can use your own locale with `setLangDir` method. For example, create your locale file in `__DIR__.'/locale/kr.php`, then you can use:

```php
Validator::setLangDir(__DIR__.'/locale');
Validator::setLang('kr');
```
