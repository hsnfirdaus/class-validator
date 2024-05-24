<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Attribute;

use Hsnfirdaus\ClassValidator\Attribute\IsEnum;
use Hsnfirdaus\ClassValidator\Test\Contract\MyType;
use Hsnfirdaus\ClassValidator\Test\Contract\StringContract;
use Hsnfirdaus\ClassValidator\Test\Trait\ReflectProperty;
use PHPUnit\Framework\TestCase;

class IsEnumTest extends TestCase
{
    use ReflectProperty;

    public IsEnum $instance;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->instance = new IsEnum(MyType::class);
    }

    public function testEnumValid(): void
    {
        $obj        = new StringContract();
        $obj->value = MyType::FIRST_VALUE->value;
        $this->assertValidProperty($this->instance, $obj);
    }

    public function testEnumInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'randomvalue';
        $this->assertInvalidProperty($this->instance, $obj);
    }
}
