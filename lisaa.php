<?php
	require_once("db.inc");
	require_once("getpost.inc");
	global $conn;
	//error_log("lisaa.php ja LAITE_NIMI on:". $_POST["LAITE_NIMI"]);
	if(isset($_POST['insert'])){
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
		   
		   	$ln = parsePost("LAITE_NIMI");
			$merk = parsePost("MERKKI");
			$mal = parsePost("MALLI");
			$ku = parsePost("KUVAUS");
			$si = parsePost("SIJAINTI");
			$st = parsePost("STATUS");
		   
			try{
			
			$stmt = $conn->prepare("INSERT INTO laite (LAITE_NIMI, MERKKI, KATEGORIA_ID, OMISTAJA_ID, MALLI, KUVAUS, SIJAINTI, STATUS) VALUES ('$ln','$merk','$kat','$om','$mal','$ku','$si','$st')");			
			
			$stmt->execute();
			}
			
			catch(PDOException $e) {
			error_log("Virhe laitetta lisätessä: " . $e->getMessage());
	}
	}
?>