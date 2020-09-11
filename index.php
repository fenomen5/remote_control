<?php

use Pult\Commands\ICommandFactory;
use Pult\ICollection;
use Pult\IStack;

require 'loader.php';

$commandsConfig = new \Pult\Config\CommandsConfig();
$devicesClasses = $commandsConfig->getDevicesClasses();

$commandsFactory = new \Pult\Commands\SwitchCommandsFactory($commandsConfig);

$buttonsCount = 7;
$maxButtonsCount = $buttonsCount*2;
$buttons = new \Pult\RemoteControl\Buttons\ButtonsCollection($maxButtonsCount);

try {
    for ($i = 0; $i < $maxButtonsCount; $i++) {
        $buttons->addItem(new \Pult\RemoteControl\Buttons\SimpleButton());
    }
} catch (Throwable $e) {
    throw new Exception($e->getMessage());
}

$commandsHistory = new \Pult\Commands\CommandsHistory(8);

$pult = \Pult\RemoteControl\PultSingleton::getInstance();

$pult->setDevicesAvailable($devicesClasses);
$pult->setCommandFactory($commandsFactory);
$pult->setButtons($buttons);
$pult->setUndoStack($commandsHistory);

while (true) {
    echo PHP_EOL;
    echo "_________________________" . PHP_EOL;
    echo "Enter command" . PHP_EOL;
    echo "1 - Display the list of devices available" . PHP_EOL;
    echo "2 - Setup a remote control button" . PHP_EOL;
    echo "3 - Display the current settings for buttons of the remote control" . PHP_EOL;
    echo "4 - Push a button of the remote control" . PHP_EOL;
    echo "5 - Undo last action" . PHP_EOL;
    echo "6 - Exit" . PHP_EOL;

    $input = trim(fgets(STDIN, 64));

    switch ($input) {
        case 1:
            print_r($pult->getAvailableDevicesNames());
            break;
        case 2:
            echo "Input the button number form 1 to {$buttonsCount} and device name separated by comma" . PHP_EOL;
            $buttonActionInput = trim(fgets(STDIN, 128));
            list($number, $deviceClass) = explode(',', $buttonActionInput);
            $actionOn = $deviceClass. 'On';
            $actionOff = $deviceClass. 'Off';

            try {
                $pult->add($number, $actionOn, $actionOff);
            } catch (Exception $e) {
                print $e->getMessage() . PHP_EOL;
            }

            break;
        case 3:
            foreach ($pult->printCommands() as $command) {
                print $command . PHP_EOL;
            }
            break;
        case 4:
            echo "Input the button number form 1 to {$buttonsCount} and action type (on/off) " .
                "separated by comma" . PHP_EOL;
            $buttonActionInput = trim(fgets(STDIN, 128));
            list($number, $actionType) = explode(',', $buttonActionInput);

            $action = '';
            if ($actionType == 'on') {
                $action = 'performOn';
            } elseif ($actionType == 'off') {
                $action = 'performOff';
            }

            try {
                if (empty($action)) {
                    throw new Exception('Incorrect action type');
                }
                $pult->$action($number);
            } catch (Exception $e) {
                print $e->getMessage() . PHP_EOL;
            }
            break;
        case 5:
            $pult->undo();
            break;
        case 6:
            die(0);
    }
}