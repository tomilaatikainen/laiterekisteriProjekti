<?php
	session_start();
	require_once("db.inc");
	require_once("getpost.inc");
	require_once("database_utils.inc");
	
	if(isset($_GET["LAITE_ID"]))
	{
		$laite["laiteid"] = $_GET["LAITE_ID"];
		poistaLaite($laite);
		//header('Location: adminlaite.php');
	}
	/*if(isset($_POST["LAITE_ID"]))
	{
	$laiteid = $_POST["LAITE_ID"];
	global $conn;
	try
	{
		$stmt = $conn->prepare("DELETE FROM laite WHERE LAITE_ID='$laiteid'");
		$stmt->execute();
	}
	catch(PDOException $e)
	{	
	echo"<script type='text/javascript'>alert('catchiin meni :D');
	</script>";
	error_log("Error in poistaLaite: " . $e->getMessage());
	}
	}*/
?>