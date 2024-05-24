<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test\Attribute;

use Hsnfirdaus\ClassValidator\Attribute\IsNotEmpty;
use Hsnfirdaus\ClassValidator\Test\Contract\StringContract;
use Hsnfirdaus\ClassValidator\Test\Trait\ReflectProperty;
use PHPUnit\Framework\TestCase;

class IsNotEmptyTest extends TestCase
{
    use ReflectProperty;

    public IsNotEmpty $instance;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->instance = new IsNotEmpty();
    }

    public function testIsNotEmptyValid(): void
    {
        $obj        = new StringContract();
        $obj->value = 'value';
        $this->assertValidProperty($this->instance, $obj);
    }

    public function testIsNotEmptyInvalid(): void
    {
        $obj        = new StringContract();
        $obj->value = '';
        $this->assertInvalidProperty($this->instance, $obj);
    }
}
