<?php
	session_start();
	require_once("database_utils.inc");
	require_once("getpost.inc");

	$asiakas["tunnus"] = $_SESSION["tunnus"];
	$asiakas["nimi"] = $_SESSION["nimi"];
	$asiakas["salasana"] = $_SESSION["salasana"];
	

	
	header('Content-Type: application/json');
	haeVaraukset($asiakas);
	parseget($result['STATUS']);
	
	
?>