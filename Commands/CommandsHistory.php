<?php


namespace Pult\Commands;

use Pult\IStack;

class CommandsHistory implements IStack
{
    private $commands;
    private $maxDepth;

    public function __construct($maxDepth)
    {
        $this->commands = [];
        $this->maxDepth = $maxDepth;
    }

    public function push($command)
    {
        if (count($this->commands) > $this->maxDepth) {
            array_shift($this->commands);
        }

        $this->commands[] = $command;
    }

    public function pop()
    {
        if (count($this->commands) > 0) {
            return array_pop($this->commands);
        }
    }

}