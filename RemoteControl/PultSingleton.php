<?php

namespace Pult\RemoteControl;

use Pult\Commands\ICommand;
use Pult\Commands\ICommandFactory;
use Pult\ICollection;
use Pult\IStack;

class PultSingleton implements IControl
{
    /** @var array All possible devices to manage */
    private $devicesAvailable;

    /** @var ICommandFactory command factory */
    private $commandFactory;

    /** @var ICollection pult buttons collection */
    private $buttons;

    /** @var IStack commands history */
    private $undoStack;

    private static $instance;

    protected function __construct() {}

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): PultSingleton
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param ICollection $devicesAvailable
     */
    public function setDevicesAvailable(array $devicesAvailable): void
    {
        $this->devicesAvailable = $devicesAvailable;
    }

    /**
     * @param ICommandFactory $commandFactory
     */
    public function setCommandFactory(ICommandFactory $commandFactory): void
    {
        $this->commandFactory = $commandFactory;
    }

    /**
     * @param ICollection $buttons
     */
    public function setButtons(ICollection $buttons): void
    {
        $this->buttons = $buttons;
    }

    /**
     * @param IStack $undoStack
     */
    public function setUndoStack(IStack $undoStack): void
    {
        $this->undoStack = $undoStack;
    }


    public function add($position, $actionOn, $actionOff)
    {
        /** @var \IButton $button */
        $buttonOn = $this->buttons->getItem($position);
        /** @var \IButton $button */
        $buttonOff = $this->buttons->getItem($position + ($this->buttons->getCount()/2));

        $buttonOn->setButtonCommand($this->commandFactory->createCommand($actionOn));
        $buttonOff->setButtonCommand($this->commandFactory->createCommand($actionOff));
    }

    public function printCommands()
    {
        $commandsInfo = [];

        for ($i = 1; $i <= $this->buttons->getCount()/2; $i++) {

            $button = $this->buttons->getItem($i);

            /** @var ICommand $command */
            $command = $button->getButtonCommand();
            if (!$command) {
                continue;
            }

            $commandInfo = $command->getInfo();
            $commandsInfo[] = "button number {$i} device {$commandInfo['device']}";
        }

        return $commandsInfo;
    }

    public function undo()
    {
        /** @var ICommand $command */
        $command = $this->undoStack->pop();
        if ($command) {
            $command->run();
        }
    }

    public function performOn($position)
    {
        /** @var \IButton $buttonOn */
        $buttonOn = $this->buttons->getItem($position);

        /** @var \IButton $buttonOff */
        $buttonOff = $this->buttons->getItem($position + $this->buttons->getCount()/2);
        try {
            $this->perfomAction($buttonOn, $buttonOff);
        } catch (\Exception $e) {
            throw new \Exception('Cannot perform the action:' . $e->getMessage());
        }
    }

    public function performOff($position)
    {
        /** @var \IButton $buttonOff */
        $buttonOff = $this->buttons->getItem($position + $this->buttons->getCount()/2 );

        /** @var \IButton $buttonOn */
        $buttonOn = $this->buttons->getItem($position);

        $this->perfomAction($buttonOff, $buttonOn);
    }

    private function perfomAction($buttonOn, $buttonOff)
    {
        /** @var ICommand $command */
        $command = $buttonOn->getButtonCommand();

        if (!$command) {
            throw new \Exception("Command is not defined for the specified button");
        }

        $command->run();

        $this->undoStack->push($buttonOff->getButtonCommand());
    }

    public function getAvailableDevicesNames()
    {
        foreach ($this->devicesAvailable as $device) {
            print $device::getName() . PHP_EOL;
        }
    }
}