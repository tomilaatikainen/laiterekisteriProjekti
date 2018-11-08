<?php
	session_start();
	require_once("getpost.inc");
		$asiakas["tunnus"] = parsePost("tunnus");
		$asiakas["salasana"] = parsePost("ss");
		$asiakas["nimi"] = parsePost("nimi");

		$_SESSION["login"] = 1;
		
		header("Location: kayttaja.php");
		exit();
	
?>