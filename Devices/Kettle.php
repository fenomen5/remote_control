<?php


namespace Pult\Devices;


class Kettle extends Device
{

    public function on() {
        print 'Kettle is on' . PHP_EOL;
    }

    public function off() {
        print 'Kettle is off' . PHP_EOL;
    }
}