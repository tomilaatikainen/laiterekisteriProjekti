<?php
	require_once("database_utils.inc");
	require_once("getpost.inc");
	session_start();
	
	$asiakas["tunnus"] = $_SESSION["tunnus"];
	$asiakas["salasana"] = $_SESSION["salasana"];
	
	$asiakas["uNimi"] = parsePost("uusiNimi");
	$asiakas["uSalasana"] = parsePost("uusiSalasana");
	
	tuoNimi($asiakas);
	
	
	if ( isset($_POST["tallenna"])){
			muutaAsiakas($asiakas);
			//header("Location: kayttaja.php");
			}
			
?>