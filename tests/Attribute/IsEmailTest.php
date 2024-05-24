<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Attribute;

use Hsnfirdaus\ClassValidator\Attribute\IsEmail;
use Hsnfirdaus\ClassValidator\Test\Contract\StringContract;
use Hsnfirdaus\ClassValidator\Test\Trait\ReflectProperty;
use PHPUnit\Framework\TestCase;

class IsEmailTest extends TestCase
{
    use ReflectProperty;

    public IsEmail $instance;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->instance = new IsEmail();
    }

    public function testEmailValid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'email@valid.com';
        $this->assertValidProperty($this->instance, $obj);
    }

    public function testEmailInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'email@invalid';
        $this->assertInvalidProperty($this->instance, $obj);
    }
}
