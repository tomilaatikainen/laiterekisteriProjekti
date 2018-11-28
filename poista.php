<?php
	require_once("db.inc");
	require_once("getpost.inc");
	
	global $conn;
	//error_log("Poitaoigaosgoaisgs:". $_POST["LAITE_ID"]);
	if(isset($_POST['poista']))
	{
		
		$laiteid = $_POST["LAITE_ID"];
		
		try{
		$stmt = $conn->prepare("DELETE FROM laite WHERE LAITE_ID='$laiteid'");
		$stmt->execute();
		}
		catch(PDOException $e)
		{	
			error_log("Error in poista: " . $e->getMessage());
		}
	}
		
?>