<?php
	require_once("db.inc");
	require_once("getpost.inc");
	session_start();
	
	global $conn;
	//error_log("edit.php ja laiteID on ". $_POST['LAITE_ID']);
	if(isset($_POST['LAITE_ID'])){
		   
			$laiteid = parsePost("LAITE_ID");
			$ln = parsePost("LAITE_NIMI");
			$merk = parsePost("MERKKI");
			$kat = parsePost("KATEGORIA_NIMI");
			$om = parsePost("OMISTAJA_NIMI");
			$mal = parsePost("MALLI");
			$ku = parsePost("KUVAUS");
			$si = parsePost("SIJAINTI");
			$st = parsePost("STATUS");
			
			try{
			$stmt = $conn->prepare
			("UPDATE ((laite 
			INNER JOIN kategoria ON laite.KATEGORIA_ID = kategoria.KATEGORIA_ID) 
			INNER JOIN omistaja ON laite.OMISTAJA_ID = omistaja.OMISTAJA_ID) SET LAITE_NIMI='$ln', MERKKI='$merk', KATEGORIA_NIMI='$kat', OMISTAJA_NIMI='$om', MALLI='$mal', KUVAUS='$ku', SIJAINTI='$si', STATUS='$st' 
			WHERE LAITE_ID='$laiteid'");
			
			$stmt->execute();
			}
			
			catch(PDOException $e) {
			error_log("Error uuden laitteen lisäämisessä: " . $e->getMessage());
	}
	}
?>