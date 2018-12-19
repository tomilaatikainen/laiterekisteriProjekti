<?php
	require_once("database_utils.inc");
	require_once("getpost.inc");
	require_once("kirjaudu_utils.inc");
	//check_session(); <---- rikkoo
	//error_log("menee kalenteri_handleriin ja laiteID on ". $_POST["LAITE_ID"]);
	
	
	if (isset($_POST["hyvaksy"])){
		
		//error_log("ollaan kalenteri_handlerin issetissä ja laiteID on ". $_POST["LAITE_ID"]);
		$laite["laiteid"] = parsePost("LAITE_ID");
		$laite["alkupvm"] = parsePost("ALKUPVM");
		$laite["loppupvm"] = parsePost("LOPPUPVM");
		$laite["status"] = parsePost("STATUS");
		$laite["tunnus"] = parsePost("ASIAKAS_TUNNUS");
		
		luoVaraus($laite);
		/*switch(luoVaraus($laite))
		{
			case "OK":
				echo"<script type='text/javascript'>alert('Varaus onnistui!');
				</script>";
				break;
				
			case "tyhjä":
				echo"<script type='text/javascript'>alert('Jokin kentistä tyhjä!');
				</script>";
				break;
				
			case "päällekkäisyys":
				echo"<script type='text/javascript'>alert('Päällekkäisyys varauksessa!');
				</script>";
				break;
			case "muu":
				echo"<script type='text/javascript'>alert('Catchiin meni');
				</script>";
				break;
				
			default:
				echo"<script type='text/javascript'>alert('Virhe ohjelmoinnissa');
				</script>";
				break;				
				
		}	*/
			
			
	}
?>