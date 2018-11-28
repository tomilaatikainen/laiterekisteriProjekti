<?php
	session_start();
	require_once("database_utils.inc");
	require_once("getpost.inc");

	$laite["nimi"] = parsePost("nimi");
	$laite["malli"] = parsePost("malli");
	$laite["merkki"] = parsePost("merkki");
	$laite["sijainti"] = parsePost("sijainti");
	$laite["omistaja"] = parsePost("omistaja");
	$laite["kategoria"] = parsePost("kategoria");
	
	haeLaite($laite);
	
	header('Content-Type: application/json');
?>