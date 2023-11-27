<?php
	/**
	* PHP Chemistry Library Unit Tests
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
		// Allow the display of errors during debugging.
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}
	
	echo "<pre>";
	echo "/***************************************************************************************\\\n";
	echo "| PHP Chemistry Library                                                                 |\n";
	echo "|                                                                                       |\n";
	echo "| Copyright (c) 2023, Scott Vander Molen; some rights reserved.                         |\n";
	echo "|                                                                                       |\n";
	echo "| This work is licensed under a Creative Commons Attribution 4.0 International License. |\n";
	echo "| To view a copy of this license, visit https://creativecommons.org/licenses/by/4.0/    |\n";
	echo "|                                                                                       |\n";
	echo "\***************************************************************************************/\n";
	echo "</pre>";

	include 'chemistry.lib.php';
	use ScottVM\Chemistry as Chemistry;
	
	/**
	* Converts an atomic number to an element name and compares to the expected result.
	* 
	* @param input The atomic number.
	* @param expected The expected chemical element name.
	* @return boolean Whether the result matched the expectation.
	*/
	function testElementName($input, $expected)
	{
		$actual = Chemistry\getElementName($input);
		$result = strtolower($actual) == strtolower($expected);

		echo "Unit Test: getElementName()\n";
		echo "Input:     " . $input . "\n";
		echo "Expected:  " . $expected . "\n";
		echo "Actual:    " . $actual . "\n";
		echo "Result:    Test " . ($result ? "successful" : "failed") . "!\n\n";
		
		return $result;
	}
	
	/**
	* Converts an atomic number to an element symbol and compares to the expected result.
	* 
	* @param input The atomic number.
	* @param expected The expected chemical element symbol.
	* @return boolean Whether the result matched the expectation.
	*/
	function testElementSymbol($input, $expected)
	{
		$actual = Chemistry\getElementSymbol($input);
		$result = strtolower($actual) == strtolower($expected);

		echo "Unit Test: getElementSymbol()\n";
		echo "Input:     " . $input . "\n";
		echo "Expected:  " . $expected . "\n";
		echo "Actual:    " . $actual . "\n";
		echo "Result:    Test " . ($result ? "successful" : "failed") . "!\n\n";
		
		return $result;
	}
	
	/**
	* Converts an atomic number to an electron configuration and compares to the expected result.
	* 
	* @param input The atomic number.
	* @param expected The expected electron configuration.
	* @return boolean Whether the result matched the expectation.
	*/
	function testElectronConfiguration($input, $expected)
	{
		$actual = Chemistry\getElectronConfiguration($input);
		$result = $actual == $expected;

		echo "Unit Test: getElectronConfiguration()\n";
		echo "Input:     " . $input . "\n";
		echo "Expected:  " . $expected . "\n";
		echo "Actual:    " . $actual . "\n";
		echo "Result:    Test " . ($result ? "successful" : "failed") . "!\n\n";
		
		return $result;
	}
	
	echo "<pre>";
	$test1 = testElementName(8, "Oxygen");
	$test2 = testElementSymbol(8, "O");
	$test3 = testElectronConfiguration(8, "1s^2 2s^2 2p^4");
	echo "</pre>";
?>