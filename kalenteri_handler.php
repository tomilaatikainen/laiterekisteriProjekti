<?php
	require_once("database_utils.inc");
	require_once("getpost.inc");
	
	if ( isset($_POST["hyvaksy"])){
		
		$laite["laiteid"] = parsePost("LAITE_ID");
		$laite["alkupvm"] = parsePost("ALKUPVM");
		$laite["loppupvm"] = parsePost("LOPPUPVM");
		$laite["status"] = parsePost("STATUS");
		$laite["tunnus"] = parsePost("ASIAKAS_TUNNUS");
		
		luoVaraus($laite);
			//header("Location: kayttaja.php");
			}
?>