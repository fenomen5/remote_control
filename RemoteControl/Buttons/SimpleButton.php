<?php

namespace Pult\RemoteControl\Buttons;

class SimpleButton implements IButton
{
    private $command;

    public function getButtonCommand()
    {
        return $this->command;
    }

    public function setButtonCommand($command)
    {
        $this->command = $command;
    }

}