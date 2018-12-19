<?php
	require_once("db.inc");
	require_once("getpost.inc");
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
	
	global $conn;
	//error_log("edit_varaus.php ja laiteid on ". $_POST['LAITE_ID']);
	if(isset($_POST['ID'])){
		   
			$varausid = parsePost("ID");
			$ap = parsePost("ALKUPVM");
			$lp = parsePost("LOPPUPVM");
			
			try{
			$stmt = $conn->prepare
			("UPDATE varaus SET ALKUPVM='$ap', LOPPUPVM='$lp' WHERE ID='$varausid' AND STATUS='varattu'");
			
			$stmt->execute();
			}
			
			catch(PDOException $e) {
			error_log("Error asiakkaan luomisessa: " . $e->getMessage());
	}
	}
?>