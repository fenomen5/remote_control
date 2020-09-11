<?php


namespace Pult\Commands;


class SwitchCommand implements ICommand
{
    private $commandName;
    private $managedDevice;
    private $deviceFunction;

    public function __construct($commandName, $device, $functionName)
    {
        //todo add parameters validation

        $this->commandName = $commandName;
        $this->managedDevice = $device;
        $this->deviceFunction = $functionName;
    }

    public function run()
    {
        $function = $this->deviceFunction;
        $this->managedDevice->$function();
    }

    public function getInfo()
    {
        return [
            'command' => $this->commandName,
            'device' => $this->managedDevice->getName()
        ];
    }
}