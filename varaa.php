<?php
	session_start();
	require_once("kirjaudu_utils.inc");
	require_once("db.inc");
	require_once("getpost.inc");
	require 'filterLaite.php';
	require 'laiteConn.php';
	check_session();
	global $conn;
	
	$query = "SELECT DISTINCT MERKKI FROM laite ORDER BY MERKKI ASC";
	$merkki= $conn->prepare($query);
	$merkki->execute();
	
	$query = "SELECT DISTINCT KATEGORIA_ID, KATEGORIA_NIMI FROM kategoria ORDER BY KATEGORIA_NIMI ASC";
	$kategoria = $conn->prepare($query);
	$kategoria->execute();
	
	$query = "SELECT DISTINCT OMISTAJA_ID, OMISTAJA_NIMI FROM omistaja ORDER BY OMISTAJA_NIMI ASC";
	$omistaja= $conn->prepare($query);
	$omistaja->execute();
	
	$query = "SELECT DISTINCT MALLI FROM laite ORDER BY MALLI ASC";
	$malli= $conn->prepare($query);
	$malli->execute();
	
	$query = "SELECT DISTINCT SIJAINTI FROM laite ORDER BY SIJAINTI ASC";
	$sijainti= $conn->prepare($query);
	$sijainti->execute();
	
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Varaa laite</title>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <style>
		#laitetaulu {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	#laitetaulu td, #laitetaulu th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	#laitetaulu tr:nth-child(even){background-color: #f2f2f2;}

	#laitetaulu th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
	
	#logout {
			float: right;
			font-size: 20px;
		}
		
		b {
			font-size: 20px;
		}
		
		nav [type=submit]{
			display:inline-block;
			width: 100px;
			height: 23px;
			margin-left: 10px;
		}
		nav select,[type=text]{
			margin-right: 7px;
		}
    </style>
	<script type="text/javascript">
	
			$(document).on('click' ,'#varaa', function () { //Käyttäjä painaa varaa-nappia           
            var laiteid = $(this).closest('tr').find('td:eq(0)').text();
                
				 $.post("fetch_varaus.php", 
                {
                    LAITE_ID: laiteid,
					varaa: ''
                })
				.done(function() {
					document.location = 'kalenteri.php';
				});
				
				
			});
	</script>
</head>

<body>
<form action="" method="GET" id="hae_form">

<div>

<b><a href="kayttaja.php" >Edelliselle sivulle</a></b>
<b id="logout"><a href="logout.php">Kirjaudu ulos</a></b>

<h1>Varaa laite</h1>
<nav>
		<label for="nimi">Laitenimi:</label>
		<input type="text" name="nimi" id="nimi"/>
		
		<label for="merkki">Merkki:</label>
		<select name="merkki" id="merkki">
				<option value="">Merkki</option>
					<?php
						$value = 0;
						while($rivi = $merkki->fetch(PDO::FETCH_ASSOC)){
							echo utf8ize('<option value ="'.$rivi["MERKKI"].'">'.$rivi["MERKKI"].'</option>');
							$value++;
							}
					?>								
			 </select>
			 
		<label for="kategoria">Kategoria:</label>
		<select name="kategoria" id="kategoria">
					<option value="">Kategoria</option>
						<?php
							while($rivi = $kategoria->fetch(PDO::FETCH_ASSOC)){
								echo utf8ize('<option value ="'.$rivi["KATEGORIA_ID"].'">'.$rivi["KATEGORIA_NIMI"].'</option>');
								}
						?>
				</select>	

				<label for="omistaja">Omistaja:</label>
				<select name="omistaja" id="omistaja">
					<option value="">Omistaja</option>
						<?php
							while($rivi = $omistaja->fetch(PDO::FETCH_ASSOC)){
								echo utf8ize('<option value ="'.$rivi["OMISTAJA_ID"].'">'.$rivi["OMISTAJA_NIMI"].'</option>');
								}
						?>
				</select>
				
				<label for="malli">Malli:</label>
				<select name="malli" id="malli">
					<option value="">Malli</option>
						<?php
							$value = 0;
							while($rivi = $malli->fetch(PDO::FETCH_ASSOC)){
								echo utf8ize('<option value ="'.$rivi["MALLI"].'">'.$rivi["MALLI"].'</option>');
								$value++;
								}
						?>								
				</select>
				
				<label for="sijainti">Sijainti:</label>
				<select name="sijainti" id="sijainti">
					<option value="">Sijainti</option>
						<?php
							$value = 0;
							while($rivi = $sijainti->fetch(PDO::FETCH_ASSOC)){
							echo utf8ize('<option value ="'.$rivi["SIJAINTI"].'">'.$rivi["SIJAINTI"].'</option>');
							$value++;
							}
						?>								
				</select>
				
				<input type="submit" name="search" value="Hae"></br>
				</nav>
</div>


</form>


        <table id="laitetaulu" border=1 cellpadding="5">
        <tr>
        <th>ID</th>
        <th>Nimi</th>
        <th>Merkki</th>
        <th>Kategoria</th>
        <th>Omistaja</th>
        <th>Malli</th>
        <th>Kuvaus</th>
		<th>Sijainti</th>
        </tr>
		
		<?php
if (isset($_GET['search'])) { // jos Hae- nappia painettu
    $nimi = $_GET['nimi'];
    $merkki = $_GET['merkki'];
    $kategoria = $_GET['kategoria'];
    $omistaja = $_GET['omistaja'];
    $malli = $_GET['malli'];
    $sijainti = $_GET['sijainti'];
    // sijoitetaan muuttujat sessioon
    $_SESSION['n'] = $nimi;
    $_SESSION['me'] = $merkki;
    $_SESSION['ka'] = $kategoria;
    $_SESSION['o'] = $omistaja;
    $_SESSION['ma'] = $malli;
    $_SESSION['s'] = $sijainti;
    // kutsutaan funktiota, joka hakee hakuehtojen mukaiset laitteet
    getLaite($_SESSION['n'], $_SESSION['me'], $_SESSION['ka'], $_SESSION['o'], $_SESSION['ma'], $_SESSION['s'],$con);
	 
	
}

?>

		</table>
</body>
</html>