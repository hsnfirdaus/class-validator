# Class Validator

PHP Class Validator using php 8.0 attributes.

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
