<?php


namespace Pult\Config;

use Pult\Devices\CommandsCollection;
use Pult\Devices\DevicesCollection;
use Pult\ICollection;

class CommandsConfig implements IConfig
{
    private $commandNames;
    private $devicesClasses;

    public function __construct()
    {
        $this->initCommandsNames($this->getConfig());
        $this->initDevicesNames($this->getConfig());
    }

    public function getConfig() : array
    {
        $config = [
            ['cmdName' => 'BathroomLightOn', 'device' => \Pult\Devices\BathroomLight::class, 'action' => 'on'],
            ['cmdName' => 'BathroomLightOff', 'device' => \Pult\Devices\BathroomLight::class, 'action' => 'off'],
            ['cmdName' => 'JacuzziOn', 'device' => \Pult\Devices\Jacuzzi::class, 'action' => 'turnOn'],
            ['cmdName' => 'JacuzziOff', 'device' => \Pult\Devices\Jacuzzi::class, 'action' => 'turnOff'],
            ['cmdName' => 'HeatingOn', 'device' => \Pult\Devices\Heating::class, 'action' => 'warmUp'],
            ['cmdName' => 'HeatingOff', 'device' => \Pult\Devices\Heating::class, 'action' => 'off'],
            ['cmdName' => 'GarageOn', 'device' => \Pult\Devices\Garage::class, 'action' => 'open'],
            ['cmdName' => 'GarageOff', 'device' => \Pult\Devices\Garage::class, 'action' => 'close'],
            ['cmdName' => 'DoorOn', 'device' => \Pult\Devices\Door::class, 'action' => 'open'],
            ['cmdName' => 'DoorOff', 'device' => \Pult\Devices\Door::class, 'action' => 'close'],
            ['cmdName' => 'JalousieOn', 'device' => \Pult\Devices\Jalousie::class, 'action' => 'up'],
            ['cmdName' => 'JalousieOff', 'device' => \Pult\Devices\Jalousie::class, 'action' => 'down'],
            ['cmdName' => 'KettleOn', 'device' => \Pult\Devices\Kettle::class, 'action' => 'on'],
            ['cmdName' => 'KettleOff', 'device' => \Pult\Devices\Kettle::class, 'action' => 'off'],
        ];

        return $config;
    }

    public function getCommandsNames()
    {
        return $this->commandNames;
    }

    public function getDevicesClasses()
    {
        return $this->devicesClasses;
    }

    private function initCommandsNames($config)
    {
        $this->commandNames = array_column($config, 'cmdName');
    }

    private function initDevicesNames($config)
    {
        $this->devicesClasses = array_unique(array_column($config, 'device'));
    }
}