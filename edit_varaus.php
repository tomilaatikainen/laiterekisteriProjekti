<?php
	require_once("db.inc");
	require_once("getpost.inc");
	session_start();
	
	global $conn;
	error_log("edit_varaus.php ja laiteid on ". $_POST['LAITE_ID']);
	if(isset($_POST['LAITE_ID'])){
		   
			$laiteid = parsePost("LAITE_ID");
			$ap = parsePost("ALKUPVM");
			$lp = parsePost("LOPPUPVM");
			
			try{
			$stmt = $conn->prepare
			("UPDATE varaus SET ALKUPVM='$ap', LOPPUPVM='$lp' WHERE LAITE_ID='$laiteid' AND STATUS='varattu'");
			
			$stmt->execute();
			}
			
			catch(PDOException $e) {
			error_log("Error asiakkaan luomisessa: " . $e->getMessage());
	}
	}
?>