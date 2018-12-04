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
        
        #form_login {
            border: 3px solid black;
			border-radius: 20px;
            width: 500px;
            height: 500px;
        }

        #div_login {
            margin-left: 20px;
			margin-right: 20px;
        }
		
		input[type=text], input[type=password] {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
		}
		
		input[type=submit] {
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 100%;
		}
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
	<div id="div_login">
        <h1>Muokkaa tietoja</h1>

        Uusi salasana: <input type="password" name="uusiSalasana" value="<?php echo $us; ?>" /><br />
		Vahvista salasana: <input type="password" name="uusiSalasana2" value="<?php echo $us; ?>" /><br />
        Nimi: <input type="text" id="uusiNimi" name="uusiNimi"/><br/>

        <input type="submit" value="Tallenna muutokset" name="tallenna"/><br />
		<a href="http://localhost:8081/woproj/kayttaja.php">Takaisin</a>
    </div>
	</form>
</body>
</html>