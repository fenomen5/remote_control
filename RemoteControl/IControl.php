<?php

namespace Pult\RemoteControl;

interface IControl
{
    public function add($position, $actionOn, $actionOff);
    public function printCommands();
    public function undo();
    public function performOn($position);
    public function performOff($position);
}