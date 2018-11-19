<?php
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
	
	
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
						]
					})

				})
			}
			 function load_data(is_category){
	
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
				 }
					
					
					
					
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
							</select>
						</th>
						<th>
						<select name="kategoria" id="kategoria">
							<option value="">Kategoria</option>
							<option value="1">puhelin</option>
							<option value="2">tabletti</option>
							<option value="3">kannettava tietokone</option>
							<option value="4">älykello</option>
							<option value="5">pöytäkone</option>
						</select>
						</th>  
						<th>
							<select name="omistaja">
								<option value="">Omistaja</option>
								<option value="1">Gigantti</option>
								<option value="2">Power</option>
								<option value="3">DNA</option>
							</select>
						</th>
						<th>
							<select name="malli">
								<option value="">Malli</option>
							</select>
						</th>  
						<th>Kuvaus</th>  
						<th>
							<select name="sijainti">
								<option value="">Sijainti</option>
								<option value="Kuopio">Kuopio</option>
							</select>
						</th> 
						<th></th> 
                    </tr>

                </thead>

            </table>
	</div>
	
</body>
</html>