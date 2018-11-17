<?php
	require_once("database_utils.inc");
	session_start();
	
	$asiakas["tunnus"] = $_SESSION["tunnus"];
	$asiakas["salasana"] = $_SESSION["salasana"];
	
	tuoNimi($asiakas);
	
	
	if ( isset($_POST["tallenna"])){
			muutaAsiakas($asiakas);
			//header("Location: kayttaja.php");
			}
			
?>