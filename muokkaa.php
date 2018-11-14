<?php
	require_once("db.inc");
	session_start();
	
	$tunnus = $_SESSION["tunnus"];
	
	$us = $_SESSION["salasana"];
	
	global $conn;
	
	$stmt = $conn->prepare
	("SELECT * FROM asiakas WHERE TUNNUS='$tunnus'");
	$stmt->execute();
	
	while($rivi = $stmt->fetch(PDO::FETCH_ASSOC)){
			$un = $rivi["NIMI"];
		}
	
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Muokkaa käyttäjätietoja</title>
    <style>
        
    </style>
</head>
<body>	
	<div>
        <h1>Muokkaa tietoja</h1>

        Uusi salasana: <input type="password" name="uusiSalasana" value="<?php echo $us; ?>" /><br />
		Vahvista salasana: <input type="password" name="uusiSalasana2" value="<?php echo $us; ?>" /><br />
        Nimi: <input type="text" name="uusiNimi" value="<?php echo $un; ?>" /><br/>

        <input type="submit" value="Tallenna muutokset" name="muuta"/><br />
    </div>
</body>
</html>