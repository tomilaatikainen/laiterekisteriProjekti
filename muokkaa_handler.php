<?php
	require_once("database_utils.inc");
	require_once("getpost.inc");
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
	
	$asiakas["tunnus"] = $_SESSION["tunnus"];
	$asiakas["salasana"] = $_SESSION["salasana"];
	
	$asiakas["uNimi"] = parsePost("uusiNimi");
	$asiakas["uSalasana"] = parsePost("uusiSalasana");
	$asiakas["uSalasana2"] = parsePost("uusiSalasana2");
	
	tuoNimi($asiakas);
	
	
	if ( isset($_POST["tallenna"])){
			muutaAsiakas($asiakas);
			//header("Location: kayttaja.php");
			}
			
?>