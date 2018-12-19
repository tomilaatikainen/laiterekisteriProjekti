<?php
require_once("db.inc");
require_once("getpost.inc");

function luoAsiakas($asiakas){
	global $conn;
	$result = "OK";

	try
	{
		$stmt = $conn->prepare("INSERT INTO asiakas(TUNNUS,SALASANA,NIMI)VALUES(:t,:ss,:n)");

		$stmt->bindParam(":t",$t);
		$stmt->bindParam(":ss",$ss);
		$stmt->bindParam(":n",$n);

		$t = $asiakas["tunnus"];
		$ss = $asiakas["salasana"];
		$n = $asiakas["nimi"];

		$stmt->execute();
	}
	catch(PDOException $e) {
		$result = array("status" => "not ok", "error" => $e->getMessage());
		// Kirjoittaa virheviestin PHP:n error lokiin (löytyy WAMP:n ikonin alta PHP -> PHP error log)
		error_log("Error in luoAsiakas: " . $e->getMessage());
	}
	return $result;
}

function luoVaraus($laite){
	
	global $conn;
	$result = "Varauksen luonti onnistui";
	
	$laiteid = $laite["laiteid"];
	$alkupvm = $laite["alkupvm"];
	$loppupvm = $laite["loppupvm"];
	$status = $laite["status"];
	$tunnus = $laite["tunnus"];
	
	try
	{
		if ($alkupvm == "1970-01-01"|| $loppupvm == "1970-01-01")
		{
			$result = "Jokin kentistä oli tyhjä";
		//error_log("Meni tänne kun oli oli tyhjää");
		}
		else{
		$query= "SELECT LAITE_ID FROM varaus WHERE LAITE_ID='$laiteid' AND (('$alkupvm' BETWEEN ALKUPVM AND LOPPUPVM) OR ('$loppupvm' BETWEEN ALKUPVM AND LOPPUPVM)
		OR ('$alkupvm'< ALKUPVM AND '$loppupvm'>LOPPUPVM))"; // OR ('$loppupvm' > '$alkupvm')
		
		//$stmt = $conn->prepare("INSERT INTO varaus(LAITE_ID,ALKUPVM,LOPPUPVM,STATUS,ASIAKAS_TUNNUS)VALUES('$laiteid','$alkupvm','$loppupvm','$status','$tunnus')");
		$stmt = $conn->prepare($query);
		$stmt->execute();
		
		
		$rivi = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(!$rivi)
		{
			$stmt1 = $conn->prepare("INSERT INTO varaus(LAITE_ID,ALKUPVM,LOPPUPVM,STATUS,ASIAKAS_TUNNUS)VALUES('$laiteid','$alkupvm','$loppupvm','$status','$tunnus')");
			$stmt1->execute();
		}
		else{
		//error_log("Meni tänne kun oli päällekkäisyys");
		$result = "Päällekkäisyys varausta tehdessä";
		}
		}
	}
	catch(PDOException $e) {
		$result = "Muu virhe";
		//error_log("Error in luoVaraus: " . $e->getMessage());
		

	}
	echo json_encode ($result,JSON_UNESCAPED_UNICODE);
	
}

function tarkistaAsiakas($asiakas)
{
	global $conn;
	$tunnus = $asiakas["tunnus"];
	$salasana = $asiakas["salasana"];
	$result = 1;
	try
	{
		if (empty($tunnus) || empty($salasana))
		{
		$result = 0;
		}
		
		else 
		{
		$q = "SELECT TUNNUS FROM asiakas WHERE EXISTS 
		(SELECT TUNNUS FROM asiakas WHERE TUNNUS='$tunnus' AND SALASANA='$salasana')";
		
		$stmt = $conn->prepare($q);
		$stmt->execute();

		$rivi = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(!$rivi)
		{
			$result = 0;	
		}
		}
		
	}
	catch(PDOException $e) {		
		error_log("Error in tarkistaAsiakas: " . $e->getMessage());
		$result = 0;
	}
	
	return $result;
}

function haeAsiakas($asiakas)
{
	global $conn;
	$result = array();
	$t = $asiakas["tunnus"];
	$ss = $asiakas["salasana"];
	$t = $asiakas["nimi"];
	


	try
	{
		$q = "SELECT TUNNUS,SALASANA,NIMI from asiakas WHERE 1=1";

		if(!empty($t)) $q.= " AND TUNNUS like '%$t%'";
		if(!empty($ss)) $q.= " AND SALASANA like '%$ss%'";

		$stmt = $conn->prepare($q);
		$stmt->execute();

		while($rivi = $stmt->fetch(PDO::FETCH_ASSOC)){
			$tunnus = $rivi["Tunnus"];
			$salasana = $rivi["Salasana"];
			$nimi = $rivi["Nimi"];
			$result[] = $rivi;
		}
	}

		catch(PDOException $e) {
		$result = array("status" => "not ok", "error" => $e->getMessage());
		error_log("Error in haeAsiakas: " . $e->getMessage());
	}

	return $result;	

}
function tarkistaRekis($asiakas)
{
	$tunnus = $asiakas["tunnus"];
	$salasana = $asiakas["salasana"];
	$salasana2 = $asiakas["salasana2"];
	$nimi = $asiakas["nimi"];

	global $conn;

	try
	{
		$stmt = $conn->prepare
		("SELECT TUNNUS FROM asiakas WHERE EXISTS (SELECT TUNNUS FROM asiakas WHERE TUNNUS='$tunnus')");
		$stmt->execute();
		$rivi = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!$rivi && !empty($tunnus) && !empty($salasana) && !empty($nimi) && $salasana == $salasana2)//tiedot kelpaa
		{
			
			luoAsiakas($asiakas);
			echo"<script type='text/javascript'>alert('Käyttäjätunnus luotu');
			location='kirjaudu.php';
			</script>";							

		}		
		else if(empty($tunnus) || empty($salasana) || empty($salasana2) || empty($nimi)) //tyhjä kenttä
		{
		echo"<script type='text/javascript'>alert('Jokin kentistä on tyhjä');
		location='rekisteroidy.php';
		</script>";
		}
		
		else if ($salasana != $salasana2) //salasanat ei mätsää
		{
			echo"<script type='text/javascript'>alert('Salasanat eivät täsmää');
		location='rekisteroidy.php';
		</script>";
		}
		
		else //tunnus jo käytössä
		{
		echo"<script type='text/javascript'>alert('Käyttäjätunnus on jo käytössä');
		location='rekisteroidy.php';
		</script>";

		}

	}
	catch(PDOException $e) {		
		error_log("Error in tarkistaRekis: " . $e->getMessage());
	}

}

function haeVaraukset($asiakas)
{
	global $conn;
	$tunnus = $asiakas["tunnus"];
	$status = $asiakas["status"];
	$result = array();
	try
	{
	
	$stmt = $conn->prepare
		("SELECT varaus.*, laite.LAITE_NIMI FROM (varaus 
		INNER JOIN laite ON varaus.LAITE_ID = laite.LAITE_ID)
		WHERE ASIAKAS_TUNNUS='$tunnus' AND varaus.STATUS='$status' ");
		$stmt->execute();

			while ($rivi = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			/*$id = $rivi["ID"];
			$laiteid = $rivi["LAITE_ID"];
			$alkupvm = $rivi["ALKUPVM"];
			$loppupvm = $rivi["LOPPUPVM"];*/
			
			$result[] = $rivi;
		}
	}

	catch(PDOException $e)
	{	
	$result = array("status" => "not ok", "error" => $e->getMessage());
	error_log("Error in haeVaraukset: " . $e->getMessage());
	}
	
	echo json_encode(utf8ize($result));
	
	
	
}

function haeKaikkiVaraukset($asiakas)
{
	global $conn;
	$status = $asiakas["status"];
	$result = array();
	try
	{
	
	$stmt = $conn->prepare
		("SELECT * FROM varaus WHERE STATUS='$status'");
		$stmt->execute();

			while ($rivi = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			/*$id = $rivi["ID"];
			$laiteid = $rivi["LAITE_ID"];
			$alkupvm = $rivi["ALKUPVM"];
			$loppupvm = $rivi["LOPPUPVM"];*/
			
			$result[] = $rivi;
		}
	}

	catch(PDOException $e)
	{	
	$result = array("status" => "not ok", "error" => $e->getMessage());
	error_log("Error in haeKaikkiVaraukset: " . $e->getMessage());
	}
	
	echo json_encode($result);
	
}



function tuoNimi($asiakas) //tuo nimen "Muokkaa tietoja" -sivulle
{
	$tunnus = $asiakas["tunnus"];
	$un = array();
	
	global $conn;
	
	try{
		$stmt = $conn->prepare
	("SELECT NIMI FROM asiakas WHERE TUNNUS='$tunnus'");
	$stmt->execute();
	
	while($rivi = $stmt->fetch(PDO::FETCH_ASSOC)){
			$un = $rivi["NIMI"]; //nimi tietokannasta
		}
		
	}
	
	catch(PDOException $e)
	{	
	$result = array("status" => "not ok", "error" => $e->getMessage());
	error_log("Error in tuoNimi: " . $e->getMessage());
	}
	
	echo json_encode($un,JSON_UNESCAPED_UNICODE);
}

function muutaAsiakas($asiakas) //asiakas muokkaa omia tietojaan
{
	$tunnus = $asiakas["tunnus"];
	$salasana = $asiakas["uSalasana"];
	$salasana2 = $asiakas["uSalasana2"];
	$nimi = $asiakas["uNimi"];
	
	global $conn;
	$result = "OK";

	try
	{
		$stmt = $conn->prepare
		("UPDATE asiakas SET SALASANA='$salasana', NIMI='$nimi' WHERE TUNNUS='$tunnus'");
		
		if(!empty($tunnus) && !empty($salasana) && !empty($nimi) && $salasana == $salasana2)//tiedot kelpaa
		{
			$stmt->execute();
		
			echo"<script type='text/javascript'>alert('Muokatut tiedot tallennettu');
				location='muokkaa.php';
				</script>";
			
		$_SESSION["salasana"] = $salasana;	
		}
		
		else if(empty($salasana) || empty($salasana2) || empty($nimi)) //tyhjä kenttä
		{
		echo"<script type='text/javascript'>alert('Jokin kentistä on tyhjä');
		location='muokkaa.php';
		</script>";
		}
		
		else if ($salasana != $salasana2) //salasanat ei mätsää
		{
			echo"<script type='text/javascript'>alert('Salasanat eivät täsmää');
		location='muokkaa.php';
		</script>";
		}
		
		else
		{
			echo"<script type='text/javascript'>alert('Tarkista kentät');
		location='muokkaa.php';
		</script>";
		}
		
		
	}
	
	catch(PDOException $e) {		
		error_log("Error in muutaAsiakas: " . $e->getMessage());
	}
	return $result;
}

function haeLaite($laite){
	$nimi = $laite["nimi"];
	$malli = $laite["malli"];
	$merkki = $laite["merkki"];
	$sijainti = $laite["sijainti"];
	$omistaja = $laite["omistaja"];
	$kategoria = $laite["kategoria"];
	
	global $conn;
	$result = array();
	
	try {
		$q = "SELECT laite.*, kategoria.KATEGORIA_NIMI, omistaja.OMISTAJA_NIMI FROM ((laite 
		INNER JOIN kategoria ON laite.KATEGORIA_ID = kategoria.KATEGORIA_ID) 
		INNER JOIN omistaja ON laite.OMISTAJA_ID = omistaja.OMISTAJA_ID)";
		
		/*if ( !empty($nimi) ) $q .= " AND LAITE_NIMI like '%$nimi%'";
		if ( !empty($malli) ) $q .= " AND MALLI='$malli'";
		if ( !empty($merkki) ) $q .= " AND MERKKI='$merkki'";
		if ( !empty($sijainti) ) $q .= " AND SIJAINTI='$sijainti'";
		if ( !empty($omistaja) ) $q .= " AND OMISTAJA_NIMI= $omistaja";
		if ( !empty($kategoria) ) $q .= " AND KATEGORIA_NIMI=$kategoria";
		*/
		
		$stmt = $conn->prepare($q);
		$stmt->execute();
		
		while ($rivi = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$result[] = $rivi;
		}
	}
	catch(PDOException $e)
	{	
	$result = array("status" => "not ok", "error" => $e->getMessage());
	error_log("Error in haeLaite: " . $e->getMessage());
	}
	echo json_encode ($result);
}



?>