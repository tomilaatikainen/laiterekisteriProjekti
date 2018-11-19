<?php
	require_once("db.inc");
	require_once("getpost.inc");
	global $conn;
	
	$nimi = parsePost("nimi");
	$malli = parsePost("malli");
	$merkki = parsePost("merkki");
	$sijainti = parsePost("sijainti");
	$omistaja = parsePost("omistaja");
	$kategoria = parsePost("kategoria");
	
	$column = array("laite.laite_id","laite.laite_nimi","laite.merkki","kategoria.kategoria_nimi","omistaja.omistaja_nimi","laite.malli",
	"laite.kuvaus","laite.sijainti");
	
	$q = " SELECT * FROM laite 
 INNER JOIN kategoria 
 ON kategoria.KATEGORIA_ID = laite.KATEGORIA_ID";

	$q .= "WHERE";
	
	

	
	
?>