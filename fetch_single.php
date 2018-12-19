<?php
	require_once("db.inc");
	require_once("getpost.inc");
	require_once("kirjaudu_utils.inc");
	check_session();
	global $conn;
	//error_log("fetch_single ja laiteID on ". $_POST["LAITE_ID"]);
	if(isset($_POST["LAITE_ID"]))
	{
		$laiteid = $_POST["LAITE_ID"];
		try
		{
			$stmt = $conn->prepare("SELECT laite.*, kategoria.KATEGORIA_NIMI, omistaja.OMISTAJA_NIMI FROM ((laite 
			INNER JOIN kategoria ON laite.KATEGORIA_ID = kategoria.KATEGORIA_ID) 
			INNER JOIN omistaja ON laite.OMISTAJA_ID = omistaja.OMISTAJA_ID) WHERE LAITE_ID ='$laiteid'");
			$stmt->execute();
			while($rivi = $stmt->fetch(PDO::FETCH_ASSOC)){
			$result = $rivi;
			}
			
		}
		catch(PDOException $e) {
		error_log("Error in fetch_single: " . $e->getMessage());
	}
	header('Content-Type: application/json');
	echo json_encode ($result);
	}
	
	

	
	
?>