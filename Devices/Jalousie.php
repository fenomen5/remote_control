<?php


namespace Pult\Devices;


class Jalousie extends Device
{
    public function up() {
        print 'Jalousie is up' . PHP_EOL;
    }

    public function down() {
        print 'Jalousie is down' . PHP_EOL;
    }
}