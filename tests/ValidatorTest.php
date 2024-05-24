<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Test;

use Hsnfirdaus\ClassValidator\Test\Contract\ValidContract;
use Hsnfirdaus\ClassValidator\Validator;
use PHPUnit\Framework\TestCase;

final class ValidatorTest extends TestCase
{
    public function testValid(): void
    {
        require __DIR__ . '/Contract/ValidContract.php';

        Validator::setLang('id');
        $object = new ValidContract();

        $isSuccess = Validator::validate($object);
        $this->assertTrue($isSuccess);
    }
}
