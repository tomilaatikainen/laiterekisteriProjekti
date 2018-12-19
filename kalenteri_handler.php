<?php
	require_once("database_utils.inc");
	require_once("getpost.inc");
	require_once("kirjaudu_utils.inc");
	check_session();
	//error_log("menee kalenteri_handleriin ja laiteID on ". $_POST["LAITE_ID"]);
	
	
	if (isset($_POST["hyvaksy"])){
		
		//error_log("menee postiin hyväksy napil ja laiteID on ". $_POST["LAITE_ID"]);
		$laite["laiteid"] = parsePost("LAITE_ID");
		$laite["alkupvm"] = parsePost("ALKUPVM");
		$laite["loppupvm"] = parsePost("LOPPUPVM");
		$laite["status"] = parsePost("STATUS");
		$laite["tunnus"] = parsePost("ASIAKAS_TUNNUS");
		
		luoVaraus($laite);
			//header("Location: kayttaja.php");
			}
?>