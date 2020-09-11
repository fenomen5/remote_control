<?php


namespace Pult\Devices;


class Door extends Device
{

    public function open() {
        print 'Door is opening' . PHP_EOL;
    }

    public function close() {
        print 'Door is closing' . PHP_EOL;
    }
}