<?php
	require_once("getpost.inc");
	
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

        Uusi salasana: <input type="passoword" name="uusiSalasana" /><br />
		Vahvista salasana: <input type="password" name="uusiSalasana2" /><br />
        Nimi: <input type="text" name="uusiNimi" /><br />

        <input type="submit" value="Tallenna muutokset" name="muuta"/><br />
    </div>
</body>
</html>