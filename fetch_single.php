<?php
	require_once("db.inc");
	require_once("getpost.inc");
	global $conn;
	
	if(isset($_POST["LAITE_ID"]))
	{
		$laiteid = $_POST["LAITE_ID"];
		try
		{
			$stmt = $conn->prepare("SELECT * FROM laite WHERE LAITE_ID ='$laiteid'");
			$stmt->execute();
			while($rivi = $stmt->fetch(PDO::FETCH_ASSOC)){
			$result = $rivi;
			}
			
		}
		catch(PDOException $e) {
		error_log("Error in fetch_single: " . $e->getMessage());
	}
	header('Content-Type: application/json');
	echo json_encode (utf8ize($result));
	}
	
	

	
	
?>