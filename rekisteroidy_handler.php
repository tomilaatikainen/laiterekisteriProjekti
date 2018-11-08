<?php
	require_once("asiakas_utils.inc");
	require_once("getpost.inc");

		$asiakas["tunnus"] = parsePost("tunnus");
		$asiakas["salasana"] = parsePost("salasana");
		$asiakas["nimi"] = parsePost("nimi");

		tarkistaRekis($asiakas);
?>