<?php
	namespace ScottVM\Chemistry; 
	
	/**
	* PHP Chemistry Library
	* 
	* Copyright (c) 2023, Scott Vander Molen; some rights reserved.
	* 
	* This work is licensed under a Creative Commons Attribution 4.0 International License.
	* To view a copy of this license, visit https://creativecommons.org/licenses/by/4.0/
	* 
	* @author  Scott Vander Molen
	* @version 2.0
	* @since   2023-11-27
	*/
	
	// Change debugmode to true if you need to see error messages.
	$debugmode = false;
	if ($debugmode)
	{
		// Allow the display of error during debugging.
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}
	else
	{
		// Display a 404 error if the user attempts to access this file directly.
		if (__FILE__ == $_SERVER['SCRIPT_FILENAME'])
		{
			header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
			exit("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\r\n<html><head>\r\n<title>404 Not Found</title>\r\n</head><body>\r\n<h1>Not Found</h1>\r\n<p>The requested URL " . $_SERVER['SCRIPT_NAME'] . " was not found on this server.</p>\r\n</body></html>");
		}
	}

	// Elements by name
	$elementNames = array(null, 
		"Hydrogen", "Helium", "Lithium", "Beryllium", "Boron", "Carbon", "Nitrogen", "Oxygen", "Fluorine", "Neon",
		"Sodium", "Magnesium", "Aluminium", "Silicon", "Phosphorus", "Sulfur", "Chlorine", "Argon", "Potassium", "Calcium",
		"Scandium", "Titanium", "Vanadium", "Chromium", "Manganese", "Iron", "Cobalt", "Nickel", "Copper", "Zinc",
		"Gallium", "Germanium", "Arsenic", "Selenium", "Bromine", "Krypton", "Rubidium", "Strontium", "Yttrium", "Zirconium",
		"Niobium", "Molybdenum", "Technetium", "Ruthenium", "Rhodium", "Palladium", "Silver", "Cadmium", "Indium", "Tin",
		"Antimony", "Tellurium", "Iodine", "Xenon", "Caesium", "Barium", "Lanthanum", "Cerium", "Praseodymium", "Neodymium",
		"Promethium", "Samarium", "Europium", "Gadolinium", "Terbium", "Dysprosium", "Holmium", "Erbium", "Thulium", "Ytterbium",
		"Lutetium", "Hafnium", "Tantalum", "Tungsten", "Rhenium", "Osmium", "Iridium", "Platinum", "Gold", "Mercury",
		"Thallium", "Lead", "Bismuth", "Polonium", "Astatine", "Radon", "Francium", "Radium", "Actinium", "Thorium",
		"Protactinium", "Uranium", "Neptunium", "Plutonium", "Americium", "Curium", "Berkelium", "Californium", "Einsteinium", "Fermium",
		"Mendelevium", "Nobelium", "Lawrencium", "Rutherfordium", "Dubnium", "Seaborgium", "Bohrium", "Hassium", "Meitnerium", "Darmstadtium",
		"Roentgenium", "Copernicium", "Nihonium", "Flerovium", "Moscovium", "Livermorium", "Tennessine", "Oganesson"
	);
	
	// Elements by symbol
	$elementSymbols = array(null,
		"H", "He", "Li", "Be", "B", "C", "N", "O", "F", "Ne",
		"Na", "Mg", "Al", "Si", "P", "S", "Cl", "Ar", "K", "Ca",
		"Sc", "Ti", "V", "Cr", "Mn", "Fe", "Co", "Ni", "Cu", "Zn",
		"Ga", "Ge", "As", "Se", "Br", "Kr", "Rb", "Sr", "Y", "Zr", 
		"Nb", "Mo", "Tc", "Ru", "Rh", "Pd", "Ag", "Cd", "In", "Sn",
		"Sb", "Te", "I", "Xe", "Cs", "Ba", "La", "Ce", "Pr", "Nd",
		"Pm", "Sm", "Eu", "Gd", "Tb", "Dy", "Ho", "Er", "Tm", "Yb",
		"Lu", "Hf", "Ta", "W", "Re", "Os", "Ir", "Pt", "Au", "Hg", 
		"Tl", "Pb", "Bi", "Po", "At", "Rn", "Fr", "Ra", "Ac", "Th",
		"Pa", "U", "Np", "Pu", "Am", "Cm", "Bk", "Cf", "Es", "Fm",
		"Md", "No", "Lr", "Rf", "Db", "Sg", "Bh", "Hs", "Mt", "Ds",
		"Rg", "Cn", "Nh", "Fl", "Mc", "Lv", "Ts", "Og"
	);
	
	// List of subshell names in order of filling.
	$subshells = array("1s", "2s", "2p", "3s", "3p", "4s", "3d", "4p", "5s", "4d", "5p", "6s", "4f", "5d", "6p", "7s", "5f", "6d", "7p", "8s", "5g", "6f", "7d", "8p", "9s", "6g", "7f", "8d", "9p", "10s", "6h", "7g", "8f", "9d", "10p", "11s", "7h", "8g", "9f", "10d", "11p", "12s", "7i", "8h", "9g", "10f", "11d", "12p", "13s", "8i", "9h", "10g", "11f", "12d", "13p", "14s");
	
	/**
	* Format a string in proper case.
	* 
	* @param someString The string to convert.
	* @return string The string which has been converted to proper case.
	*/
	function strtoproper($someString)
	{
		return ucwords(strtolower($someString));
	}
	
	/**
	* Retrieve element name, with support for elements that don't have names yet.
	* 
	* @param atomicNumber The atomic number of the chemical element.
	* @return string The name of the chemical element.
	*/
	function getElementName($atomicNumber)
	{
		global $elementNames;
		
		$result = "";
		$roots = array("nil", "un", "bi", "tri", "quad", "pent", "hex", "sept", "oct", "enn");
		
		if ($atomicNumber <= count($elementNames) - 1)
		{
			$result = $elementNames[$atomicNumber];
		}
		else
		{
			for ($i = 1; $i <= strlen($atomicNumber); $i++)
			{
				$result .= $roots[substr($atomicNumber, $i, 1)];
			}
			
			$result = strtoproper(result) . "ium";
			
			// If bi or tri is followed by the ending ium (i.e. the last digit is 2 or 3), the result is '-bium' or -'trium', not '-biium' or '-triium'.
			$result = str_replace("ii", "i", $result);
			
			// If enn is followed by nil (i.e. the sequence -90- occurs), the result is '-ennil-', not '-ennnil-'.
			$result = str_replace("nnn", "nn", $result);
		}
		
		return $result;
	}
	
	/**
	* Retrieve element symbol, with support for elements that don't have symbols yet.
	* 
	* @param atomicNumber The atomic number of the chemical element.
	* @return string The symbol of the chemical element.
	*/
	function getElementSymbol($atomicNumber)
	{
		global $elementSymbols;
		
		$result = "";
		$symbols = array("n", "u", "b", "t", "q", "p", "h", "s", "o", "e");
		
		if ($atomicNumber <= count($elementSymbols) - 1)
		{
			$result = $elementSymbols[$atomicNumber];
		}
		else
		{
			for ($i = 1; $i <= strlen($atomicNumber); $i++)
			{
				$result .= $symbols[substr($atomicNumber, $i, 1)];
			}
			
			$result = strtoproper($result);
		}
		
		return $result;
	}

	/**
	* Returns the maximum number of electrons allowed in the specified subshell.
	* 
	* @param subshell The electron subshell.
	* @return integer The maximum number of electrons permitted in the subshell.
	*/
	function maxElectrons($subshell)
	{
		switch (strtolower(substr($subshell, -1)))
		{
			case "s":
				return 2;
				break;
			case "p":
				return 6;
				break;
			case "d":
				return 10;
				break;
			case "f":
				return 14;
				break;
			case "g":
				return 18;
				break;
			case "h":
				return 23;
				break;
			case "i":
				return 26;
				break;
		}
	}

	/**
	* Calculate the electron configuration for a given atom.
	* 
	* @param atomicNumber The atomic number of the chemical element.
	* @return string The electron configuration of the chemical element.
	*/
	function getElectronConfiguration($atomicNumber)
	{
		global $subshells;
		
		$electrons = $atomicNumber;
		$configuration = "";
		
		foreach ($subshells as $subshell)
		{
			if ($electrons > maxElectrons($subshell))
			{
				// A d subshell that is half-filled or full (ie 5 or 10 electrons) is more stable than the s subshell of the next shell.
				if (($subshell == "4s" && ($atomicNumber == 24 || $atomicNumber == 29)) 
				|| ($subshell == "5s" && ($atomicNumber == 41 || $atomicNumber == 42 || $atomicNumber == 44 || $atomicNumber == 45 || $atomicNumber == 47)) 
				|| ($subshell == "6s" && ($atomicNumber == 78 || $atomicNumber == 79)))
				{
					$configuration .= " $subshell^1";
					$electrons--;
				}
				// Special exception for palladium.
				elseif ($subshell == "5s" && $atomicNumber == 46)
				{
					// do nothing; this subshell gets no electrons
				}
				else
				{
					$configuration .= " $subshell^" . maxElectrons($subshell);
					$electrons -= maxElectrons($subshell);
				}
			}
			else
			{
				$configuration .= " $subshell^$electrons";
				$electrons = 0;
				break;
			}
		}
		
		return trim($configuration);
	}
?>