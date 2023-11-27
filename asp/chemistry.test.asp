<%@ CodePage=65001 Language="VBScript"%>
<%
	Option Explicit
	
	' Ensure that UTF-8 encoding is used instead of Windows-1252
	Session.CodePage = 65001
	Response.CodePage = 65001
	Response.CharSet = "UTF-8"
	Response.ContentType = "text/html"
	
	dim Chemistry
	
	' Option 1: component not registered
	' Change the path if the wsc file is stored in a different folder.
	set Chemistry = GetObject("script:c:\inetpub\wwwroot\chemistry.lib.wsc")
	
	' Option 2: component registered on local machine
	'set Chemistry = CreateObject("ScottVM.Chemistry")
	
	' Option 3: component registered on remote machine
	'set Chemistry = CreateObject("ScottVM.Chemistry, "remote-machine-name")
	
	' Converts an atomic number to an element name and compares to the expected result.
	' 
	' @param input The atomic number.
	' @param expected The expected chemical element name.
	' @return boolean Whether the result matched the expectation.
	function testElementName(input, expected)
		dim actual
		actual = Chemistry.getElementName(input)
		
		dim result
		dim resultText
		if lcase(actual) = lcase(expected) then
			result = true
			resultText = "successful"
		else
			result = false
			resultText = "failed"
		end if

		Response.Write "Unit Test: getElementName()" & vbCrLf
		Response.Write "Input:     " & input & vbCrLf
		Response.Write "Expected:  " & expected & vbCrLf
		Response.Write "Actual:    " & actual & vbCrLf
		Response.Write "Result:    Test " & resultText &  "!" & vbCrLf & vbCrLf
		
		testElementName = result
	end function
	
	' Converts an atomic number to an element symbol and compares to the expected result.
	' 
	' @param input The atomic number.
	' @param expected The expected chemical element symbol.
	' @return boolean Whether the result matched the expectation.
	function testElementSymbol(input, expected)
		dim actual
		actual = Chemistry.getElementSymbol(input)
		
		dim result
		dim resultText
		if lcase(actual) = lcase(expected) then
			result = true
			resultText = "successful"
		else
			result = false
			resultText = "failed"
		end if

		Response.Write "Unit Test: getElementSymbol()" & vbCrLf
		Response.Write "Input:     " & input & vbCrLf
		Response.Write "Expected:  " & expected & vbCrLf
		Response.Write "Actual:    " & actual & vbCrLf
		Response.Write "Result:    Test " & resultText &  "!" & vbCrLf & vbCrLf
		
		testElementSymbol = result
	end function
	
	' Converts an atomic number to an electron configuration and compares to the expected result.
	' 
	' @param input The atomic number.
	' @param expected The expected electron configuration.
	' @return boolean Whether the result matched the expectation.
	function testElectronConfiguration(input, expected)
		dim actual
		actual = Chemistry.getElectronConfiguration(input)
		
		dim result
		dim resultText
		if actual = expected then
			result = true
			resultText = "successful"
		else
			result = false
			resultText = "failed"
		end if

		Response.Write "Unit Test: getElectronConfiguration()" & vbCrLf
		Response.Write "Input:     " & input & vbCrLf
		Response.Write "Expected:  " & expected & vbCrLf
		Response.Write "Actual:    " & actual & vbCrLf
		Response.Write "Result:    Test " & resultText &  "!" & vbCrLf & vbCrLf
		
		testElectronConfiguration = result
	end function
	
	' Create an HTML container for our output.
	Response.Write "<!DOCTYPE html>" & vbCrLf
	Response.Write "<html lang=""en"">" & vbCrLf
	Response.Write "<meta http-equiv=""Content-Type"" content=""text/html;charset=UTF-8"" />" & vbCrLf
	Response.Write "<body>" & vbCrLf
	
	' Display code header
	Response.Write "<pre>"
	Response.Write "/***************************************************************************************\" & vbCrLf
	Response.Write "| ASP Chemistry Library                                                                 |" & vbCrLf
	Response.Write "|                                                                                       |" & vbCrLf
	Response.Write "| Copyright (c) 2023, Scott Vander Molen; some rights reserved.                         |" & vbCrLf
	Response.Write "|                                                                                       |" & vbCrLf
	Response.Write "| This work is licensed under a Creative Commons Attribution 4.0 International License. |" & vbCrLf
	Response.Write "| To view a copy of this license, visit https://creativecommons.org/licenses/by/4.0/    |" & vbCrLf
	Response.Write "|                                                                                       |" & vbCrLf
	Response.Write "\***************************************************************************************/" & vbCrLf
	Response.Write "</pre>"
	
	' Run unit tests
	Response.Write "<pre>"
	
	dim test1
	test1 = testElementName(8, "Oxygen")
	
	dim test2
	test2 = testElementSymbol(8, "O")
	
	dim test3
	test3 = testElectronConfiguration(8, "1s^2 2s^2 2p^4")
	
	Response.Write "</pre>" & vbCrLf
	
	' Close the HTML container.
	Response.Write "</body>" & vbCrLf
	Response.Write "</html>"
	
	set Chemistry = nothing
%>