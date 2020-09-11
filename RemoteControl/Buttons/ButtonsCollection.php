<?php

namespace Pult\RemoteControl\Buttons;

class ButtonsCollection implements \Pult\ICollection
{
    private $maxButtonsCount;
    private $buttons;

    public function __construct($buttonsCount)
    {
        $this->maxButtonsCount = $buttonsCount;
        $this->buttons = [];
    }

    public function addItem($button, $key = null)
    {
        if (count($this->buttons) == $this->maxButtonsCount) {
            throw new \Exception("Maximum number of buttons is reached");
        }
        $index = count($this->buttons) + 1;
        $this->buttons[$index] = $button;
    }

    public function deleteItem($key)
    {
        //todo add key validation
        unset($this->buttons[$key]);
    }

    public function getItem($key)
    {

        if ($key > $this->maxButtonsCount) {
                throw new \Exception('Incorrect button number, the maximum button number is ' . $this->maxButtonsCount/2);
        }

        return $this->buttons[$key];
    }

    public function getCount(): int
    {
        return count($this->buttons);
    }


}