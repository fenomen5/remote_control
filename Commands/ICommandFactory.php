<?php


namespace Pult\Commands;


interface ICommandFactory
{
    public function createCommand($commandName);
}