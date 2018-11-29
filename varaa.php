<?php
	session_start();
	require_once("kirjaudu_utils.inc");
	require_once("db.inc");
	require_once("getpost.inc");
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
       
    </style>
	
		<script type="text/javascript">
		$(document).ready(function(){
				
			HaeData();
				
			//var data;
				
			function HaeData(hae_laite = '', hae_merkki = '' ,hae_kategoria = '', hae_omistaja= '', hae_malli = '', hae_sijainti = '') {
				$('#laitetaulu').DataTable({
					"processing" : true,
					"serverSide" : true,
					"order" : [],
					"searching" : false,
				$.ajax({

					url: "fetch.php",
					type: 'POST',
					data:{
						hae_laite:hae_laite,
						hae_merkki:hae_merkki,
						hae_kategoria:hae_kategoria,
						hae_omistaja:hae_omistaja,
						hae_malli:hae_malli,
						hae_sijainti:hae_sijainti
					}

				});					
			});
			}	

				
				
				/*.done(function (data) {
					$('#laitetaulu').DataTable({

						"data": data,
						"columns": [
							{"data": "LAITE_ID"},
							{"data": "LAITE_NIMI"},
							{"data": "MERKKI"},
							{"data": "KATEGORIA_ID"},
							{"data": "OMISTAJA_ID"},
							{"data": "MALLI"},
							{"data": "KUVAUS"},
							{"data": "SIJAINTI"},
							{"defaultContent": '<button id="varaa">Varaa</button>'}
						],
						  "columnDefs": [ {
						  "targets": [ 0,1,2,3,4,5,6,7 ],
						  "orderable": false
						} ]

					})

				})*/
			}
			
			$('#hae').click(function(){
				var hae_laite = $('#nimi').val();
				var hae_merkki = $('#merkki').val();
				var hae_kategoria = $('#kategoria').val();
				var hae_omistaja = $('#omistaja').val();
				var hae_malli = $('#malli').val();
				var hae_sijainti = $('#sijainti').val();
				
				$('#laitetaulu').DataTable().destroy();
				haeData(hae_laite,hae_merkki,hae_kategoria,hae_omistaja,hae_malli,hae_sijainti);
				
			})
		});
				
				
			</script>
</head>
<body>
    <div>
		<h1>Varaa laite</h1>
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
				
				<label for="nalli">Malli:</label>
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

			<button id="hae" name="hae" class="btn btn-info" type="button">Hae</button>	
    </div>
	<div>
		<table id="laitetaulu" name="laitetaulu" class="table table-bordered">
                <thead>
					<tr>
                        <th>ID</th>
                        <th>Nimi</th>
                        <th>Merkki</th>
						<th>Kategoria</th>  
						<th>Omistaja</th>
						<th>Malli</th>  
						<th>Kuvaus</th>  
						<th>Sijainti</th> 
						<th></th> 
                    </tr>

                </thead>

            </table>
	</div>
	
</body>
</html>