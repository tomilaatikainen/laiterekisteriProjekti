<?php
	require_once("database_utils.inc");
	require_once("getpost.inc");

		$asiakas["tunnus"] = parsePost("tunnus");
		$asiakas["salasana"] = parsePost("salasana");
		$asiakas["salasana2"] = parsePost("salasana2");
		$asiakas["nimi"] = parsePost("nimi");

			if ( isset($_POST["rekisteroidy"])){
			tarkistaRekis($asiakas);
			}
			
	
		
?>