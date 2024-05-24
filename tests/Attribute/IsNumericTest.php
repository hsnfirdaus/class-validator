<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Attribute;

use Hsnfirdaus\ClassValidator\Attribute\IsNumeric;
use Hsnfirdaus\ClassValidator\Test\Contract\StringContract;
use Hsnfirdaus\ClassValidator\Test\Trait\ReflectProperty;
use PHPUnit\Framework\TestCase;

class IsNumericTest extends TestCase
{
    use ReflectProperty;

    public function testIsNumericValid(): void
    {
        $obj        = new StringContract();
        $obj->value = '2222';
        $this->assertValidProperty(new IsNumeric(), $obj);
    }

    public function testIsNumericInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'aaa';
        $this->assertInvalidProperty(new IsNumeric(), $obj);
    }

    public function testIsNumericLengthValid(): void
    {
        $obj        = new StringContract();
        $obj->value = '2222';
        $this->assertValidProperty(new IsNumeric(length: 4), $obj);
    }

    public function testIsNumericLengthInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = '1';
        $this->assertInvalidProperty(new IsNumeric(length:4), $obj);
    }

    public function testIsNumericMinLengthValid(): void
    {
        $obj        = new StringContract();
        $obj->value = '2222';
        $this->assertValidProperty(new IsNumeric(minLength: 2), $obj);
    }

    public function testIsNumericMinLengthInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = '1';
        $this->assertInvalidProperty(new IsNumeric(minLength: 2), $obj);
    }

    public function testIsNumericMaxLengthValid(): void
    {
        $obj        = new StringContract();
        $obj->value = '1';
        $this->assertValidProperty(new IsNumeric(maxLength: 1), $obj);
    }

    public function testIsNumericMaxLengthInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = '2221';
        $this->assertInvalidProperty(new IsNumeric(maxLength: 1), $obj);
    }
}
