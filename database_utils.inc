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
		error_log("Error in createAsiakas: " . $e->getMessage());
	}
	return $result;
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
		error_log("Error in fetchAsiakas: " . $e->getMessage());
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
		error_log("Error in fetchAsiakas: " . $e->getMessage());
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
		else if(empty($tunnus) || empty($salasana) || empty($salasana) || empty($nimi)) //tyhjä kenttä
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
		error_log("Error in fetchAsiakas: " . $e->getMessage());
	}

}

function haeVaraukset($asiakas)
{
	global $conn;
	$tunnus = $asiakas["tunnus"];
	$result = array();
	try
	{
	
	$stmt = $conn->prepare
		("SELECT ID, LAITE_ID, ALKUPVM, LOPPUPVM FROM varaus WHERE STATUS = 'varattu' AND ASIAKAS_TUNNUS='$tunnus'");
		$stmt->execute();

			while ($rivi = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$id = $rivi["ID"];
			$laiteid = $rivi["LAITE_ID"];
			$alkupvm = $rivi["ALKUPVM"];
			$loppupvm = $rivi["LOPPUPVM"];
			
			$result[] = $rivi;
		}
	}

	catch(PDOException $e)
	{	
	$result = array("status" => "not ok", "error" => $e->getMessage());
	error_log("Error in fetchAsiakas: " . $e->getMessage());
	}
	
	echo json_encode(utf8ize($result));
	
	
	
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
	error_log("Error in fetchAsiakas: " . $e->getMessage());
	}
	
	echo json_encode(utf8ize($un));
}

function muutaAsiakas($asiakas) //asiakas muokkaa omia tietojaan
{
	$tunnus = $asiakas["tunnus"];
	$salasana = $asiakas["uSalasana"];
	$nimi = $asiakas["uNimi"];
	
	global $conn;
	$result = "OK";

	try
	{
		$stmt = $conn->prepare
		("UPDATE asiakas SET SALASANA='$salasana', NIMI='$nimi' WHERE TUNNUS='$tunnus'");
		$stmt->execute();
		
		echo"<script type='text/javascript'>alert('Muokatut tiedot tallennettu');
			location='muokkaa.php';
			</script>";
	}
	
	catch(PDOException $e) {		
		error_log("Error in fetchAsiakas: " . $e->getMessage());
		echo"<script type='text/javascript'>alert('catchiin meni :D');
			location='muokkaa.php';
			</script>";
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
	$result = "OK";
	
	try {
		$q = "SELECT LAITE_ID, LAITE_NIMI, MERKKI, KATEGORIA_ID, OMISTAJA_ID, MALLI FROM laite WHERE 1=1 ";
		if ( !empty($nimi) ) $q .= " AND LAITE_NIMI like '%$nimi%'";
		if ( !empty($malli) ) $q .= " AND MALLI like '%$malli%'";
		if ( !empty($merkki) ) $q .= " AND MERKKI like '%$merkki%'";
		if ( !empty($sijainti) ) $q .= " AND SIJAINTI like '%$sijainti%'";
		if ( !empty($omistaja) ) $q .= " AND OMISTAJA like '%$omistaja%'";
		if ( !empty($kategoria) ) $q .= " AND KATEGORIA like '%$kategoria%'";
		
		$stmt = $conn->prepare($q);
		$stmt->execute();
		
			while ($rivi = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$ni = $rivi["nimi"];
			$ma = $rivi["malli"];
			$me = $rivi["merkki"];
			$si = $rivi["sijainti"];
			$om = $rivi["omistaja"];
			$kat = $rivi["kategoria"];
			
			$result[] = $rivi;

	}
	catch(PDOException $e)
	{	
	$result = array("status" => "not ok", "error" => $e->getMessage());
	error_log("Error in haeLaite: " . $e->getMessage());
	}
	return $result;
}
?>