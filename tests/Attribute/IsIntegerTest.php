<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Attribute;

use Hsnfirdaus\ClassValidator\Attribute\IsInteger;
use Hsnfirdaus\ClassValidator\Test\Contract\IntContract;
use Hsnfirdaus\ClassValidator\Test\Contract\StringContract;
use Hsnfirdaus\ClassValidator\Test\Trait\ReflectProperty;
use PHPUnit\Framework\TestCase;

class IsIntegerTest extends TestCase
{
    use ReflectProperty;

    public IsInteger $instance;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->instance = new IsInteger();
    }

    public function testIntegerInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = '22';
        $this->assertInvalidProperty($this->instance, $obj);
    }

    public function testIntegerValid(): void
    {
        $obj        = new IntContract();
        $obj->value = 2147483647;
        $this->assertValidProperty($this->instance, $obj);
    }
}
