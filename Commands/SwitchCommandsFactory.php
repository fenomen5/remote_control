<?php


namespace Pult\Commands;

use Pult\Config\IConfig;

class SwitchCommandsFactory implements ICommandFactory
{
    private $commandsConfig;

    public function __construct(IConfig $commandsConfig)
    {
        $this->commandsConfig = $commandsConfig;
    }

    public function createCommand($commandName) : ICommand
    {
        $commandSettings = $this->getCommandSettings($commandName);
        if (!$commandSettings) {
            throw new \Exception('Command with the given name is not supported');
        }

        $device = new $commandSettings['device']();
        return new SwitchCommand($commandSettings['cmdName'], $device, $commandSettings['action']);
    }

    private function getCommandSettings($commandName)
    {
        foreach ($this->commandsConfig->getConfig() as $command) {
            if ($command['cmdName'] == $commandName) {
                return $command;
            }
        }

        return false;
    }
}