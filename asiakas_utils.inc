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
	result= array();

	if ( isset($_POST["rekisteroidy"]))
	{
		$stmt = $conn->prepare("SELECT COUNT FROM asiakas WHERE TUNNUS ='$tunnus'");
		$stmt->execute();
		if($stmt == 0)
		{
			luoAsiakas($asiakas);
			header("Location: aloitus.php");
			echo"<script type='text/javascript'>alert('Käyttäjätunnus luotu');</script>";

		}
		else()
		{
			echo"<script type='text/javascript'>alert('Käyttäjätunnus jo olemassa');</script>";
		}
	}


}

?>