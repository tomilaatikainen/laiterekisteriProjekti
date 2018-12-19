<?php
	require_once("db.inc");
	require_once("getpost.inc");
	require_once("kirjaudu_utils.inc");
	//check_session(); <--- rikkoo
	
	global $conn;
	//error_log("peru_varaus.php ollaan ja varaus id on ". $_POST["ID"]);
	if(isset($_POST['peru']))
	{
		
		$varausid = $_POST["ID"];
		
		try{
		$stmt = $conn->prepare("DELETE FROM varaus WHERE ID='$varausid'");
		$stmt->execute();
		
		}
		catch(PDOException $e)
		{	
			error_log("Error in peru: " . $e->getMessage());
		}
	}
		
?>