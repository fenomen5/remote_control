<?php


namespace Pult\Devices;

use Pult\ICollection;

class DevicesCollection implements ICollection
{
    private $devices;

    public function __construct()
    {
        $this->devices = [];
    }

    public function addItem($device, $key = null)
    {
        //todo add validation for command duplicates
        $this->devices[] = $device;
    }

    public function deleteItem($key)
    {
        //todo add key validation
        unset($this->devices[$key]);
    }

    public function getItem($key)
    {
        //todo add key validation
        return $this->devices[$key];
    }

    public function getCount(): int
    {
        return count($this->devices);
    }

}