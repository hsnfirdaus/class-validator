<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Attribute;

use Hsnfirdaus\ClassValidator\Attribute\IsString;
use Hsnfirdaus\ClassValidator\Test\Contract\StringContract;
use Hsnfirdaus\ClassValidator\Test\Trait\ReflectProperty;
use PHPUnit\Framework\TestCase;

class IsStringTest extends TestCase
{
    use ReflectProperty;

    public function testIsStringValid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'aaaa';
        $this->assertValidProperty(new IsString(), $obj);
    }

    public function testIsStringLengthValid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'aaaa';
        $this->assertValidProperty(new IsString(length: 4), $obj);
    }

    public function testIsStringLengthInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'a';
        $this->assertInvalidProperty(new IsString(length:4), $obj);
    }

    public function testIsStringMinLengthValid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'zzzz';
        $this->assertValidProperty(new IsString(minLength: 2), $obj);
    }

    public function testIsStringMinLengthInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'z';
        $this->assertInvalidProperty(new IsString(minLength: 2), $obj);
    }

    public function testIsStringMaxLengthValid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'z';
        $this->assertValidProperty(new IsString(maxLength: 1), $obj);
    }

    public function testIsStringMaxLengthInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'qqqq';
        $this->assertInvalidProperty(new IsString(maxLength: 1), $obj);
    }
}
