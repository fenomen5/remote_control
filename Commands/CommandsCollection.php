<?php


namespace Pult\Commands;

use Pult\ICollection;

class CommandsCollection implements ICollection
{
    private $commands;

    public function __construct()
    {
        $this->commands = [];
    }

    public function addItem($command, $key = null)
    {
        //todo add validation for command duplicates
        $this->commands[] = $command;
    }

    public function deleteItem($key)
    {
        //todo add key validation
        unset($this->commands[$key]);
    }

    public function getItem($key)
    {
        //todo add key validation
        return $this->commands[$key];
    }

    public function getCount(): int
    {
        return count($this->commands);
    }
}