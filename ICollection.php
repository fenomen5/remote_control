<?php


namespace Pult;


interface ICollection
{
    public function addItem($obj, $key = null);

    public function deleteItem($key);

    public function getItem($key);

    public function getCount() : int;
}