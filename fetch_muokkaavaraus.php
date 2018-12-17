<?php
	require_once("db.inc");
	require_once("getpost.inc");
	global $conn;
	error_log("fetch_muokkaavaraus.php ja laiteid on ". $_POST["LAITE_ID"]);
	if(isset($_POST["LAITE_ID"]))
	{
		$laiteid = $_POST["LAITE_ID"];
		try
		{
			$stmt = $conn->prepare("SELECT ALKUPVM, LOPPUPVM, LAITE_ID FROM varaus WHERE LAITE_ID ='$laiteid' AND STATUS='varattu'");
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