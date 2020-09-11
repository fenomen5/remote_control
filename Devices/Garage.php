<?php


namespace Pult\Devices;


class Garage extends Device
{

    public function open() {
        print 'Garage is opening' . PHP_EOL;
    }

    public function close() {
        print 'Garage is closing' . PHP_EOL;
    }
}