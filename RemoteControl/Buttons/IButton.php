<?php

namespace Pult\RemoteControl\Buttons;

interface IButton
{
    public function getButtonCommand();
    public function setButtonCommand($command);

}