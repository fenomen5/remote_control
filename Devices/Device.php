<?php

namespace Pult\Devices;

class Device implements IDevice
{
    public static function getName() {
        return (new \ReflectionClass(static::class))->getShortName();
    }
}