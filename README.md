# Chemistry Library for PHP and ASP

A library for converting atomic numbers into element names, symbols, and electron configurations. In addition to all known elements at the time of this writing, all yet-to-be-discovered elements are also supported through the Latin naming convention for unknown elements.

## Project Status

No further development is planned.

## Installation

### PHP

Place chemistry.lib.php in any location on your web server. For additional security, you may wish to place it in a location that isn't directly accessible by users, though attempts to access the library directly will generate a 404 error.

The file chemistry.test.php is not required in order to use the library and does not need to be placed on the web server unless you want to run unit tests.

### ASP Classic

Place chemistry.lib.wsc in any location on your web server, or on another machine on the same network. For additional security, you may wish to place it in a location that isn't directly accessible by users.

Optionally, you may register the Windows Script Component by right-clicking on the file in Windows Explorer and choosing Register.

The file chemistry.test.asp is not required in order to use the library and does not need to be placed on the web server unless you want to run unit tests.

## Usage

### PHP

```PHP
// Change the path if you're storing the library in a different folder.
include 'chemistry.lib.php';

// Feel free to alias the namespace if you don't want to write my name every time you call one of my functions. 😉
use ScottVM\Chemistry as Chemistry;

// For this example, we will be using the eighth element in the periodic table.
$atomicNumber = 8;

// Get the name of the element.
$elementName = Chemistry\getElementName($atomicNumber);

// Get the symbol of the element.
$elementSymbol = Chemistry\getElementSymbol($atomicNumber);

// Get the electron configuration of the element.
$electronConfiguration = Chemistry\getElectronConfiguration($atomicNumber);
```

### ASP Classic

```vbscript
dim Chemistry

' Option 1: component not registered
' Change the path if the wsc file is stored in a different folder.
set Chemistry = GetObject("script:c:\inetpub\wwwroot\chemistry.lib.wsc")

' Option 2: component registered on local machine
'set Chemistry = CreateObject("ScottVM.Chemistry")

' Option 3: component registered on remote machine
'set Chemistry = CreateObject("ScottVM.Chemistry, "remote-machine-name")

' For this example, we will be using the eighth element in the periodic table.
dim atomicNumber
atomicNumber = 8

' Get the name of the element.
dim elementName
elementName = Chemistry.getElementName(atomicNumber)

' Get the symbol of the element.
dim elementSymbol
elementSymbol = Chemistry.getElementSymbol(atomicNumber)

' Get the electron configuration of the element.
dim electronConfiguration
electronConfiguration = Chemistry.getElectronConfiguration(atomicNumber)
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

See chemistry.test.php or chemistry.test.asp for unit tests.

## Authors

Version 1.0 written May 2009 by Scott Vander Molen

Version 2.0 written November 2023 by Scott Vander Molen

## License
This work is licensed under a [Creative Commons Attribution 4.0 International License](https://creativecommons.org/licenses/by/4.0/).