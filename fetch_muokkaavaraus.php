<?php
	require_once("db.inc");
	require_once("getpost.inc");
	global $conn;
	require_once("kirjaudu_utils.inc");
	check_session();
	//error_log("fetch_muokkaavaraus.php ja laiteid on ". $_POST["ID"]);
	if(isset($_POST["ID"]))
	{
		$varausid = $_POST["ID"];
		try
		{
			$stmt = $conn->prepare("SELECT ALKUPVM, LOPPUPVM, ID FROM varaus WHERE ID ='$varausid' AND STATUS='varattu'");
			$stmt->execute();
			while($rivi = $stmt->fetch(PDO::FETCH_ASSOC)){
			$result = $rivi;
			}
			
		}
		catch(PDOException $e) {
		error_log("Error in fetch_muokkaavaraus: " . $e->getMessage());
	}
	header('Content-Type: application/json');
	echo json_encode (utf8ize($result));
	}
?>