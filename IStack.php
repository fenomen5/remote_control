<?php


namespace Pult;


interface IStack
{
    public function push($command);
    public function pop();
}