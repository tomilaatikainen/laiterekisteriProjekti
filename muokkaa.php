<?php
	require_once("db.inc");
	session_start();
	
	$us = $_SESSION["salasana"]; //salasana sessiosta
	
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Muokkaa käyttäjätietoja</title>
    <style>
        
    </style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script type="text/javascript">
				$(document).ready(function(){
					$.ajax({
						url: "muokkaa_handler.php",
						type: "GET",
						
						success: function (result) {
							$("#uusiNimi").val(result.replace(/['"]+/g, ''));
						},
						error: function (xhr, status, err) {
							alert(err);
						}
					});
				});
				
			</script>
</head>
<body>	
	<form id="form_login" action="muokkaa_handler.php" method="post">
	<div>
        <h1>Muokkaa tietoja</h1>

        Uusi salasana: <input type="password" name="uusiSalasana" value="<?php echo $us; ?>" /><br />
		Vahvista salasana: <input type="password" name="uusiSalasana2" value="<?php echo $us; ?>" /><br />
        Nimi: <input type="text" id="uusiNimi"/><br/>

        <input type="submit" value="Tallenna muutokset" name="tallenna"/><br />
    </div>
	</form>
</body>
</html>