<?php
	require_once("db.inc");
	require_once("getpost.inc");
	session_start();
	
	global $conn;
	//error_log("Meneoiasioaoghasgio h:". $_SESSION["tunnus"];);
	if(isset($_POST['tallenna'])){
		   
			//$laiteid = $_POST["LAITE_ID"];
			
			try{
			$stmt = $conn->prepare
			("UPDATE laite SET LAITE_NIMI='$ln', MERKKI='$merk', KATEGORIA_ID='$kat', OMISTAJA_ID='$om', MALLI='$mal', KUVAUS='$ku', SIJAINTI='$si' WHERE LAITE_ID='$laiteid'");
			
			/*$stmt->bindParam(":ln",$ln);
			$stmt->bindParam(":merk",$merk);
			$stmt->bindParam(":kat",$kat);
			$stmt->bindParam(":om",$om);
			$stmt->bindParam(":mal",$mal);
			$stmt->bindParam(":ku",$ku);
			$stmt->bindParam(":si",$si);*/
			
			$ln = parsePost("LAITE_NIMI");
			$merk = parsePost("MERKKI");
			$kat = parsePost("KATEGORIA_ID");
			$om = parsePost("OMISTAJA_ID");
			$mal = parsePost("MALLI");
			$ku = parsePost("KUVAUS");
			$si = parsePost("SIJAINTI");
			
			$stmt->execute();
			}
			
			catch(PDOException $e) {
			error_log("Error in createAsiakas: " . $e->getMessage());
	}
	}
?>