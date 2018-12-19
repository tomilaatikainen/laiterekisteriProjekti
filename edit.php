<?php
	require_once("db.inc");
	require_once("getpost.inc");
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
	
	global $conn;
	//error_log("edit.php ja laiteID on ". $_POST['LAITE_ID']);
	if(isset($_POST['LAITE_ID'])){
		   
			$laiteid = parsePost("LAITE_ID");
			$ln = parsePost("LAITE_NIMI");
			$merk = parsePost("MERKKI");
			$mal = parsePost("MALLI");
			$ku = parsePost("KUVAUS");
			$si = parsePost("SIJAINTI");
			$st = parsePost("STATUS");
			
			if(strcasecmp(parsePost("KATEGORIA_NIMI"), "Puhelin") == 0)
			{
				$kat = 1;
			}
			if(strcasecmp(parsePost("KATEGORIA_NIMI"), "Tabletti") == 0)
			{
				$kat = 2;
			}
			if(strcasecmp(parsePost("KATEGORIA_NIMI"), "Kannettava tietokone") == 0)
			{
				$kat = 3;
			}
			
			if(mb_strtolower(parsePost("KATEGORIA_NIMI")) == mb_strtolower("älykello"))	
			{
				$kat = 4;
			}
			if(mb_strtolower(parsePost("KATEGORIA_NIMI")) == mb_strtolower("pöytäkone"))
			{
				$kat = 5;
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Virhe kategorian syötössä!")';
				echo '</script>';
			}
			
			if(strcasecmp(parsePost("OMISTAJA_NIMI"),"Gigantti") == 0)
			{
				$om = 1;
			}
			if(strcasecmp(parsePost("OMISTAJA_NIMI"), "Power") == 0)
			{
				$om = 2;
			}
			if(strcasecmp(parsePost("OMISTAJA_NIMI"),"DNA") == 0)
			{
				$om = 3;
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Virhe omistajan syötössä!")';
				echo '</script>';
			}
			
			
			try{
			$stmt = $conn->prepare
			("UPDATE laite SET LAITE_NIMI='$ln', MERKKI='$merk', KATEGORIA_ID='$kat', OMISTAJA_ID='$om', MALLI='$mal', KUVAUS='$ku', SIJAINTI='$si', STATUS='$st' 
			WHERE LAITE_ID='$laiteid'");
			
			$stmt->execute();
			}
			
			catch(PDOException $e) {
			error_log("Error uuden laitteen lisäämisessä: " . $e->getMessage());
	}
	}
?>