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

use const Hsnfirdaus\ClassValidator\Locale\ID;

final class PropertyError extends Exception
{
    /** @param list<string, mixed> $config */
    public function __construct(ReflectionProperty $property, string $langKey, array $config)
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

        $defaultLang = ID;

        parent::__construct(sprintf($config['language'][$langKey] ?? $defaultLang[$langKey], $name));
    }
}
