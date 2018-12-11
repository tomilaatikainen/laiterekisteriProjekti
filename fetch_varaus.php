<?php
ob_start();
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
	require_once("db.inc");
	require_once("getpost.inc");
	global $conn;
	//error_log("asdasdasdads:". $_POST["LAITE_ID"]);
	if(isset($_POST["varaa"]))
	{
		$laiteid = $_POST["LAITE_ID"];
		try
		{
			$stmt = $conn->prepare("SELECT * FROM laite WHERE LAITE_ID ='$laiteid'");
			$stmt->execute();
			while($rivi = $stmt->fetch(PDO::FETCH_ASSOC)){
			$_SESSION['id'] = $rivi["LAITE_ID"];
			$_SESSION['nimi']=$rivi["LAITE_NIMI"]; 
			$_SESSION['merkki']=$rivi["MERKKI"]; 
			$_SESSION['kategoria']=$rivi["KATEGORIA_ID"];
			$_SESSION['omistaja']=$rivi["OMISTAJA_ID"]; 
			$_SESSION['malli']=$rivi["MALLI"];
			$_SESSION['kuvaus']=$rivi["KUVAUS"];
			$_SESSION['sijainti']=$rivi["SIJAINTI"]; 
			}
			
		}
		catch(PDOException $e) {
		error_log("Error in fetchvaraus: " . $e->getMessage());
		}
		
	}
	


	
	
?>