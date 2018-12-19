<?php
	session_start();
	require_once("database_utils.inc");
	require_once("getpost.inc");
	require_once("kirjaudu_utils.inc");
	check_session();

	
	$asiakas["status"] = "varattu";

	
	header('Content-Type: application/json');
	haeKaikkiVaraukset($asiakas);
	
?>