<?php

namespace Pult\Commands;

interface ICommand
{
    public function run();
    public function getInfo();
}

