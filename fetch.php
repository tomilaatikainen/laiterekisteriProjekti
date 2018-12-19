<?php
	require_once("db.inc");
	require_once("getpost.inc");
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
	
	global $conn;
	//error_log("fetch.php ". $_POST['hae_laite']);
	
	$nimi = parsePost("hae_laite");
	$malli = parsePost("hae_malli");
	$merkki = parsePost("hae_merkki");
	$sijainti = parsePost("hae_sijainti");
	$omistaja = parsePost("hae_omistaja");
	$kategoria = parsePost("hae_kategoria");
	
	$result = array();
	
	if(isset($_POST['hae_laite'])){
		
		try {
			
		$q = "SELECT * FROM laite WHERE 1=1";
		if ( !empty($nimi) ) $q .= " AND LAITE_NIMI like '%$nimi%'";
		if ( !empty($malli) ) $q .= " AND MALLI='$malli'";
		if ( !empty($merkki) ) $q .= " AND MERKKI='$merkki'";
		if ( !empty($sijainti) ) $q .= " AND SIJAINTI='$sijainti'";
		if ( !empty($omistaja) ) $q .= " AND OMISTAJA_ID=$omistaja";
		if ( !empty($kategoria) ) $q .= " AND KATEGORIA_ID=$kategoria";
		
		$stmt = $conn->prepare($q);
		$stmt->execute();
		
		while ($rivi = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$result[] = $rivi;
		}
	}
	
	catch(PDOException $e)
	{	
	$result = array("status" => "not ok", "error" => $e->getMessage());
	error_log("Error in haeLaite: " . $e->getMessage());
	}
	
	echo json_encode(utf8ize($result));
	}
	
?>