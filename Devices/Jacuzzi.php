<?php


namespace Pult\Devices;


class Jacuzzi extends Device
{
    public function turnOn() {
        print 'Jacuzzi turn on' . PHP_EOL;
    }

    public function turnOff() {
        print 'Jacuzzi turn off' . PHP_EOL;
    }

    public function playMusic() {
        print 'Jacuzzi play music' . PHP_EOL;
    }

}