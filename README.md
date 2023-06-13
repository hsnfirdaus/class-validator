# Class Validator

PHP Class Validator using php 8.0 attributes.

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
use Hsnfirdaus\ClassValidator\Validator;
use MyApp\Entity\Enum\UserRole;
use MyApp\Entity\Enum\UserType;

class AddUserContract
{
    #[Name(name: 'User Type')]
    #[IsNotEmpty]
    #[IsEnum(enum: UserType::class)]
    public string $type;

    #[IsNotEmpty]
    #[IsEnum(enum: UserRole::class)]
    public string $role;

    #[IsNotEmpty]
    public string $identifier;

    public function validate()
    {
        Validator::validate($this);
    }
}
```

Then call validate method, it will throw exception if found an error. Currently this package only support property attribute, not support nested validation yet.

## Available Attributes

Available attributes:

- `IsEmail()` : Email validation (using php `filter_var` function).
- `IsEnum(enum: ExampleEnum::class)` : Enum validation from string value.
- `IsInteger()` : Integer validation (using php `is_int` function).
- `IsNotEmpty()` : Validate trimmed value is not empty string or null.
- `IsNumeric(length?: number, minLength?: number, maxLength?: number)` : Validate numeric string (using php `is_numeric` function).
- `IsOptional()` : Attribute to mark the property is optional, allow to be not defined.
- `IsString(length?: number, minLength?: number, maxLength?: number)` : Validate string length.
- `Name(name: string)` : Set error message field name (optional, default will be the property name).

## Error Message

Currently only Indonesian error message will thrown (see [ID.php](src/Locale/ID.php)). This can be changed to custom error message in `Validator::validate` method in second argument. Add array with language key in that param. Example:

```php
Validator::validate($object, [
    'language' => [
        'NOT_EMPTY' => '%s can\'t be empty!'
    ]
]);
```
