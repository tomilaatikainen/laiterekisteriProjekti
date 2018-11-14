<?php
require_once("db.inc");


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
	$nimi = $asiakas["nimi"];

	global $conn;

	try
	{
		$stmt = $conn->prepare
		("SELECT TUNNUS FROM asiakas WHERE EXISTS (SELECT TUNNUS FROM asiakas WHERE TUNNUS='$tunnus')");
		$stmt->execute();
		$rivi = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!$rivi && !empty($tunnus) && !empty($salasana) && !empty($nimi))
		{
			luoAsiakas($asiakas);
			echo"<script type='text/javascript'>alert('Käyttäjätunnus luotu');
			location='kirjaudu.php';
			</script>";							

		}		
		else if(empty($tunnus) || empty($salasana) || empty($nimi))
		{
		echo"<script type='text/javascript'>alert('Jokin kentistä on tyhjä');
		location='rekisteroidy.php';
		</script>";
		}
		else
		{
		echo"<script type='text/javascript'>alert('Käyttäjätunnus jo olemassa');
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
	$nimi = $asiakas["nimi"];
	$result = array();
	try
	{
	
	$stmt = $conn->prepare
		("SELECT * FROM varaus WHERE STATUS = 'varattu' AND TUNNUS='$tunnus'");
		$stmt->execute();

			while ($rivi = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$id = $rivi["id"];
			$laiteid = $rivi["laiteid"];
			$alkupvm = $rivi["alkupvm"];
			$loppupvm = $rivi["loppupvm"];
			$result[] = $rivi;
			}
	}
	catch(PDOException $e)
	{	
	$result = array("status" => "not ok", "error" => $e->getMessage());
	error_log("Error in fetchAsiakas: " . $e->getMessage());
	}
	return $result;
}
?>