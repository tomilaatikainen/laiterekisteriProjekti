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
			$Nimi = $rivi["Nimi"];
			$result[] = $rivi;
		}
	}

		catch(PDOException $e) {
		$result = array("status" => "not ok", "error" => $e->getMessage());
		error_log("Error in fetchAsiakas: " . $e->getMessage());
	}

	return $result;	

}

?>