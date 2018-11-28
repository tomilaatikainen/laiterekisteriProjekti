<?php
	require_once("db.inc");
	require_once("getpost.inc");
	session_start();
	
	global $conn;
	//error_log("Meneoiasioaoghasgio h:". $_POST['LAITE_ID']);
	if(isset($_POST['LAITE_ID'])){
		   
			$laiteid = parsePost("LAITE_ID");
			$ln = parsePost("LAITE_NIMI");
			$merk = parsePost("MERKKI");
			$kat = parsePost("KATEGORIA_ID");
			$om = parsePost("OMISTAJA_ID");
			$mal = parsePost("MALLI");
			$ku = parsePost("KUVAUS");
			$si = parsePost("SIJAINTI");
			
			try{
			$stmt = $conn->prepare
			("UPDATE laite SET LAITE_NIMI='$ln', MERKKI='$merk', KATEGORIA_ID='$kat', OMISTAJA_ID='$om', MALLI='$mal', KUVAUS='$ku', SIJAINTI='$si' WHERE LAITE_ID='$laiteid'");
			
			$stmt->execute();
			}
			
			catch(PDOException $e) {
			error_log("Error asiakkaan luomisessa: " . $e->getMessage());
	}
	}
?>