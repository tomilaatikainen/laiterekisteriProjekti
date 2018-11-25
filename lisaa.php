<?php
	require_once("db.inc");
	require_once("getpost.inc");
	global $conn;
	if(isset($_POST['insert'])){
		    $ln = parsePost("LAITE_NIMI");
			$merk = parsePost("MERKKI");
			$kat = parsePost("KATEGORIA_ID");
			$om = parsePost("OMISTAJA_ID");
			$mal = parsePost("MALLI");
			$ku = parsePost("KUVAUS");
			$si = parsePost("SIJAINTI");
			
			try{
			$query = "INSERT INTO laite ".
			"(LAITE_NIMI, MERKKI, KATEGORIA_ID, OMISTAJA_ID, MALLI, KUVAUS, SIJAINTI) ".
			"VALUES (:ln,:merk,:kat,:om,:mal,:ku,:si)";
			
			$query->bindParam(":ln",$ln);
			$query->bindParam(":merk",$merk);
			$query->bindParam(":kat",$kat);
			$query->bindParam(":om",$om);
			$query->bindParam(":mal",$mal);
			$query->bindParam(":ku",$ku);
			$query->bindParam(":si",$si);
			
			$stmt = $conn->prepare($query);
			$stmt->execute();
			}
			
			catch(PDOException $e) {
			error_log("Error in createAsiakas: " . $e->getMessage());
	}
	}
?>