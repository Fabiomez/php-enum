<?php

namespace Fabiomez\Enum;

use InvalidArgumentException;
use ReflectionClass;

abstract class Enum
{
    private string $key;
    private $value;
    private static array $enums = [];

    private final function __construct(string $key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Gets the constant key name
     *
     * @return string
     */
    public final function key(): string
    {
        return $this->key;
    }

    /**
     * Gets the enum instance constant value
     *
     * @return mixed
     */
    public final function get()
    {
        return $this->value;
    }

    /**
     * Allows to transform Enum instance into string
     *
     * @return string
     */
    public final function __toString(): string
    {
        return (string) $this->value;
    }

    /**
     * Compare the instance constant value with the given value
     *
     * @param $value
     * @return bool
     */
    public final function eq($value): bool
    {
        return $this->value === $value;
    }

    /**
     * Compare if itself is the same as the given Enum instance
     *
     * @param Enum $enum
     * @return bool
     */
    public final function is(Enum $enum): bool
    {
        return $this === $enum;
    }

    /**
     * Tries to create or get the Enum if the value is in one of its constants.
     * Throws InvalidArgumentException otherwise.
     *
     * @param $value
     * @return static
     * @throws InvalidArgumentException
     */
    public final static function from($value): self
    {
        $instance = static::tryFrom($value);

        if (!$instance) {
            throw new InvalidArgumentException(sprintf(
                '%s is not a valid value to create enum of type %s',
                $value,
                get_called_class()
            ), 0);
        }

        return $instance;
    }

    /**
     * Tries to create or get the Enum if the value is in one of its constants.
     * Returns null otherwise.
     *
     * @param $value
     * @return static
     */
    public final static function tryFrom($value): ?self
    {
        $key = self::keyOf($value);

        if (!$key) {
            return null;
        }

        $cacheKey = get_called_class() . '::' . $key;

        if (!isset(static::$enums[$cacheKey])) {
            static::$enums[$cacheKey] = new static($key, $value);
        }

        return static::$enums[$cacheKey];
    }

    /**
     * Allows to create or get the Enum if the called method name is one of its constants.
     *
     * @param $name
     * @param $arguments
     * @return static
     */
    public final static function __callStatic($name, $arguments): self
    {
        $value = static::options()[$name] ?? null;
        if ($value === null) {
            throw new InvalidArgumentException(sprintf(
                '%s is not a valid constant name to create enum of type %s',
                $name,
                __CLASS__
            ), 1);
        }

        return static::from($value);
    }

    /**
     * Get an array of all options
     *
     * @return array
     */
    public final static function options(): array
    {
        return (new ReflectionClass(get_called_class()))->getConstants();
    }

    private static function keyOf($value): ?string
    {
        return array_search($value, static::options(), true) ?: null;
    }
}
