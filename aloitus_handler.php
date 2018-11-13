<?php
	session_start();
	require_once("asiakas_utils.inc");
	require_once("getpost.inc");
		$asiakas["tunnus"] = parsePost("tunnus");
		$asiakas["salasana"] = parsePost("salasana");
		$asiakas["nimi"] = parsePost("nimi");


		if(tarkistaAsiakas($asiakas) == 1)
		{		
		$_SESSION["login"] = 1;
		header("Location: kayttaja.php");
		exit();
		}

		else
		{
		header("Location: aloitus.php?virhe=1");
		exit();
		}
		
?>