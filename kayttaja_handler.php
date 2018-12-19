<?php
	session_start();
	require_once("database_utils.inc");
	require_once("getpost.inc");
	require_once("kirjaudu_utils.inc");
	check_session();

	$asiakas["tunnus"] = $_SESSION["tunnus"];
	$asiakas["nimi"] = $_SESSION["nimi"];
	$asiakas["salasana"] = $_SESSION["salasana"];
	$asiakas["status"] = $_GET["STATUS"];

	
	header('Content-Type: application/json');
	haeVaraukset($asiakas);
	
	
	
	
?>