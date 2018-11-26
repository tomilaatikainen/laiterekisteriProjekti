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
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <style>
       
    </style>
	
		<script type="text/javascript">
				$(document).ready(function(){
				
			HaeData();
				
			var data;
				
			function HaeData() { //Datan haku
				$.ajax({
					'url': "varaa_handler.php",
					'method': 'GET'

				}).done(function (data) {
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

				})
			}
			 /*function load_data(is_category){
	
				  var dataTable = $('#laitetaulu').DataTable({
				   "processing":true,
				   "serverSide":true,
				   "order":[],
				   "ajax":{
					url:"fetch.php",
					type:"POST",
					data:{is_category:is_category}
					},
				   "columnDefs":[
					{
					 "targets":[2],
					 "orderable":false,
					},
				   ],
				  });
				 }*/
					
					
					
					
					/*$("#laitetaulu").DataTable({
						ajax:{
							url: 'varaa_handler.php',
							dataSrc: ''
						},					
						"columns": [
							{"data": "LAITE_ID"},
							{"data": "LAITE_NIMI"},
							{"data": "MERKKI"},
							{"data": "KATEGORIA_ID"},
							{"data": "OMISTAJA_ID"},
							{"data": "MALLI"},
							{"data": "KUVAUS"},
							{"data": "SIJAINTI"}
						]
					});*/
				});
				
				
			</script>
</head>
<body>
<form id="form_varaa" action="varaa_handler.php" method="post">
    <div>
		<h1>Varaa laite</h1>
		
		Nimi <input type="text" name="nimi" /><br />
    </div>
	</form>
	<div>
		<table id="laitetaulu" name="laitetaulu" class="table table-bordered">
                <thead>
					<tr>
                        <th>ID</th>
                        <th>Nimi</th>
                        <th>
							<select name="merkki">
								<option value="">Merkki</option>
							<?php
							$value = 0;
								while($rivi = $merkki->fetch(PDO::FETCH_ASSOC)){
									echo utf8ize('<option value ="'.$value.'">'.$rivi["MERKKI"].'</option>');
									$value++;
								}
							?>								
							</select>
						</th>
						<th>
						<select name="kategoria" id="kategoria">
							<option value="">Kategoria</option>
							<?php
								while($rivi = $kategoria->fetch(PDO::FETCH_ASSOC)){
									echo utf8ize('<option value ="'.$rivi["KATEGORIA_ID"].'">'.$rivi["KATEGORIA_NIMI"].'</option>');
								}
							?>
						</select>
						</th>  
						<th>
							<select name="omistaja">
							<option value="">Omistaja</option>
							<?php
								while($rivi = $omistaja->fetch(PDO::FETCH_ASSOC)){
									echo utf8ize('<option value ="'.$rivi["OMISTAJA_ID"].'">'.$rivi["OMISTAJA_NIMI"].'</option>');
								}
							?>
							</select>
						</th>
						<th>
							<select name="malli">
								<option value="">Malli</option>
							<?php
							$value = 0;
								while($rivi = $malli->fetch(PDO::FETCH_ASSOC)){
									echo utf8ize('<option value ="'.$value.'">'.$rivi["MALLI"].'</option>');
									$value++;
								}
							?>								
							</select>
						</th>  
						<th>Kuvaus</th>  
						<th>
							<select name="sijainti">
								<option value="">Sijainti</option>
							<?php
								$value = 0;
								while($rivi = $sijainti->fetch(PDO::FETCH_ASSOC)){
									echo utf8ize('<option value ="'.$value.'">'.$rivi["SIJAINTI"].'</option>');
									$value++;
								}
							?>								
							</select>
						</th> 
						<th></th> 
                    </tr>

                </thead>

            </table>
	</div>
	
</body>
</html>