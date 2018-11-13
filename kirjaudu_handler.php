<?php
	session_start();
	require_once("database_utils.inc");
	require_once("getpost.inc");
		$asiakas["tunnus"] = parsePost("tunnus");
		$asiakas["salasana"] = parsePost("salasana");
		$asiakas["nimi"] = parsePost("nimi");


		if(tarkistaAsiakas($asiakas) == 1)
		{		
		$_SESSION["login"] = 1;
		$_SESSION["tunnus"] = $asiakas["tunnus"];
		$_SESSION["nimi"] = $asiakas["nimi"];
		header("Location: kayttaja.php");
		exit();
		}

		else
		{
		header("Location: kirjaudu.php?virhe=1");
		exit();
		}
		
?>