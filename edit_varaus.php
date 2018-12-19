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
			$alkupvm = parsePost("ALKUPVM");
			$loppupvm = parsePost("LOPPUPVM");
			$laiteid = parsePost("LAITE_ID");
			
			try{
				
			if ($alkupvm == "1970-01-01"|| $loppupvm == "1970-01-01")
		{
			$result = "tyhjä";
		error_log("Meni tänne kun oli oli tyhjää");
		echo"<script type='text/javascript'>alert('Syötä päivämäärät!');
		location='kayttaja.php';
		</script>";
		}
		else{
		$query= "SELECT LAITE_ID FROM varaus WHERE LAITE_ID='$laiteid' AND ID!='$varausid' AND (('$alkupvm' BETWEEN ALKUPVM AND LOPPUPVM) OR ('$loppupvm' BETWEEN ALKUPVM AND LOPPUPVM)
		OR ('$alkupvm'< ALKUPVM AND '$loppupvm'>LOPPUPVM) OR ('$loppupvm' < '$alkupvm')) ";
		
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		
		$rivi = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(!$rivi)
		{
			$stmt1 = $conn->prepare("UPDATE varaus SET ALKUPVM='$alkupvm', LOPPUPVM='$loppupvm' WHERE ID='$varausid' AND STATUS='varattu'");
			$stmt1->execute();
		}
		else{
		error_log("Meni tänne kun oli päällekkäisyys");
		$result = "päällekkäisyys";
		echo"<script type='text/javascript'>alert('Päällekkäisyys varauksessa!');
		location='kayttaja.php';
		</script>";
		}
		}
			}
			
			catch(PDOException $e) {
			error_log("Error varauksen muokkaamisessa: " . $e->getMessage());
	}
	}
?>