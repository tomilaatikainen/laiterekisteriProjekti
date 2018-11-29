<?php
	session_start();
	require_once("database_utils.inc");
	require_once("getpost.inc");
	
	error_log("Ei tule tanne lolololol laite:". $_POST['hae_laite']);
	$laite["nimi"] = parsePost("hae_laite");
	$laite["malli"] = parsePost("hae_malli");
	$laite["merkki"] = parsePost("hae_merkki");
	$laite["sijainti"] = parsePost("hae_sijainti");
	$laite["omistaja"] = parsePost("hae_omistaja");
	$laite["kategoria"] = parsePost("hae_kategoria");
	
	haeLaite($laite);
	
	header('Content-Type: application/json');
	//header('Location: varaa.php');
?>