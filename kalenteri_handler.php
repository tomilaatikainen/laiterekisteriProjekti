<?php
	require_once("database_utils.inc");
	require_once("getpost.inc");
	error_log("menee kalenteri_handleriin". $_POST["LAITE_ID"]);
	
	
	if (isset($_POST["hyvaksy"])){
		
		error_log("menee postiin hyväksy napil". $_POST["LAITE_ID"]);
		$laite["laiteid"] = parsePost("LAITE_ID");
		$laite["alkupvm"] = parsePost("ALKUPVM");
		$laite["loppupvm"] = parsePost("LOPPUPVM");
		$laite["status"] = parsePost("STATUS");
		$laite["tunnus"] = parsePost("ASIAKAS_TUNNUS");
		
		luoVaraus($laite);
			//header("Location: kayttaja.php");
			}
?>