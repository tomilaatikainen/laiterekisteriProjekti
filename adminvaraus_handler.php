<?php
	session_start();
	require_once("database_utils.inc");
	require_once("getpost.inc");

	
	$asiakas["status"] = "varattu";

	
	header('Content-Type: application/json');
	haeKaikkiVaraukset($asiakas);
	
?>