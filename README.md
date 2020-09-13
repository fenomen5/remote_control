# remote_control
Code challenge of using design patterns from https://weblab.technology/

## Task Definition

There is a remote control given that communicates with house devices by radio channel. Every device has its own unique set of methods.
Device Examples

Turn on/off the light in a bathroom.   
Class representing the device is the follwoing:
```
class BathroomLight {
  off()
  on()
  dim()
}
```

Turn on/off a jacuzzi  
Representing class:
```
class Jacuzzi {
  turnOn()
  turnOff()
  playMusic()
}
```

Turn on/off a heating system  
Representing class:
```
class Heating {
  warmUp()
  warmDown()
  warmMax()
  off()
}
```

Open/close a garage  
Representing class:
```
class Garage {
  open()
  close()
}
```
Open/close an entrance door  
Representing class:
```
class Garage {
  open()
  close()
}
```

Raise/lower blinds  
Representing class:
```
class jalousie {
  up()
  down()
}
```
Turn on/off a kettle  
Representing class:
```
class Kettle {
  on()
  off()
}
```
The remote control has the following interface
```
Control {
  add(position, actionOn, actionOff)
  printCommands() // чтобы показать, какие значения в каких ячейках пульта
  undo()
  performOn(position)
  performOff(position)
}
```
There is the Undo operation button as well, which allows canceling the last eight operations.
The validation of the button pressed should be implemented. If the pressed button does not exist there an exception with the appropriate message should be thrown.

### Implement the following:
1. Create bootstrap classes for each type of available device. Every method has to indicate that it has been called by printing a suitable message.
Example:
```
class Light {
  on() {
    print(‘Light on’)
  }
}
```
2. Implement remote control classes based on the singleton pattern
3. Provide an opportunity for the future adding actions conveniently (without rewriting much code)  

The result has to be represented with a CLI program that allows performing the following operations:
* Display the list of all available devices 
* Setup a certain button for an operation (by providing button number and device class name)
* Perform on/off operation of pressing a button with an appropriate message indicating that the button has been pressed
* Undo the last action
