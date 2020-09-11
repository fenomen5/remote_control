<?php


namespace Pult\Devices;


class Heating extends Device
{

    public function warmUp() {
        print 'Heating is warming up' . PHP_EOL;
    }

    public function warmDown() {
        print 'Heating is warming down' . PHP_EOL;
    }

    public function warmMax() {
        print 'Heating is warming max' . PHP_EOL;
    }

    public function off() {
        print 'Heating off' . PHP_EOL;
    }
}