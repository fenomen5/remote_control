<?php


namespace Pult\Devices;


class BathroomLight extends Device
{

    public function off() {
        print 'Bathroom light off' . PHP_EOL;
    }

    public function on() {
        print 'Bathroom light on' . PHP_EOL;
    }

    public function dim() {
        print 'Bathroom light dim' . PHP_EOL;
    }

}