<?php
	require_once("db.inc");
	require_once("getpost.inc");
	global $conn;
	//error_log("Meneoiasioaoghasgio h:". $_POST["LAITE_NIMI"]);
	if(isset($_POST['insert'])){
		   
			try{
			$stmt = $conn->prepare("INSERT INTO laite ".
			"(LAITE_NIMI, MERKKI, KATEGORIA_ID, OMISTAJA_ID, MALLI, KUVAUS, SIJAINTI) ".
			"VALUES (:ln, :merk, :kat, :om, :mal, :ku, :si)");
			
			$stmt->bindParam(":ln",$ln);
			$stmt->bindParam(":merk",$merk);
			$stmt->bindParam(":kat",$kat);
			$stmt->bindParam(":om",$om);
			$stmt->bindParam(":mal",$mal);
			$stmt->bindParam(":ku",$ku);
			$stmt->bindParam(":si",$si);
			
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