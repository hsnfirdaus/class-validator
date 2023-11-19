<?php

declare(strict_types=1);

namespace Hsnfirdaus\ClassValidator\Error;

use Exception;
use Hsnfirdaus\ClassValidator\Attribute\Name;
use ReflectionProperty;

use function implode;
use function preg_split;
use function sprintf;
use function ucwords;

final class PropertyError extends Exception
{
    /** @var array<string, string> $messageList */
    protected static array $messageList;

    public function __construct(ReflectionProperty $property, string $langKey, mixed ...$additionalSprint)
    {
        $nameAttributes = $property->getAttributes(Name::class);
        if (@$nameAttributes[0]) {
            $nameAttribute = $nameAttributes[0];
            $args          = $nameAttribute->getArguments();
            $name          = @$args[0] ? $args[0] : @$args['name'];
        }

        if (! @$name) {
            $name = $property->getName();
            $name = ucwords(implode(' ', preg_split('/(?=[A-Z])/', $name)));
        }

        $defaultMsg = '%s is invalid!';

        $fmt = sprintf(static::$messageList[$langKey] ?? $defaultMsg, $name, ...$additionalSprint);

        parent::__construct($fmt);
    }

    /** @param array<string, string> $messageList */
    public static function setMessageList(array $messageList): void
    {
        static::$messageList = $messageList;
    }
}
