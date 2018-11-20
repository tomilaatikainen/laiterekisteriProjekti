<? php
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Päänäyttö</title>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <style>
		#main {
			width: 700px;
			border: 1px dotted black;
		}
		
		h1 {
			display: inline-block;
		}
		
		#varaaUusi {
			float: right;
		}
		
		#logout {
			float: right;
		}
		
		b {
			font-size: 20px;
		}
    </style>
	<script type="text/javascript">
	
	
				$(document).ready(function(){
					
				HaeVarausData();				
				var data;
				
				function HaeVarausData() { //Datan haku
				$.ajax({
					'url': "kayttaja_handler.php?STATUS=varattu",
					'method': 'GET'

				}).done(function (data) {
					$('#varaustaulu').DataTable({
						"data": data,
						"columns": [
							{"data": "ID"},
							{"data": "LAITE_ID"},
							{"data": "ALKUPVM"},
							{"data": "LOPPUPVM"}
						]
					})

				})
			}
			
						function HaeLainausData(id) { //Datan haku
						$.ajax({
							'url': "kayttaja_handler.php?STATUS=lainattu",
							'method': 'GET',
							data: {'id' : id}

						}).done(function (data) {
							$('#lainaustaulu').DataTable({
								"data": data,
								"columns": [
									{"data": "ID"},
									{"data": "LAITE_ID"},
									{"data": "ALKUPVM"},
									{"data": "LOPPUPVM"}
								]
							})

						})
					}
			
			
					$("#lainatCheckbox").live("click", function(){					
					var id = parseInt($(this).val(),10);
					if($(this).is(":checked")) {
						// checkbox is checked -> do something
						HaeLainausData(id);
						$('#lainaus').style.display = 'block';
								
					} 
					else {
						// checkbox is not checked -> do something different
						$('#lainaus').style.display= 'none';
					}
					});	
					
					
					
					
					/*$("#varaustaulu").DataTable({
						ajax:{
							url: 'kayttaja_handler.php',
							dataSrc: ''
						},					
						"columns": [
							{"data": "ID"},
							{"data": "LAITE_ID"},
							{"data": "ALKUPVM"},
							{"data": "LOPPUPVM"}
						]
					});*/
				});
				
				
			</script>
</head>
<body>	
	<div id="profile">
		<b><a href="http://localhost:8081/woproj/muokkaa.php">Muokkaa omia tietoja</b>
		<b id="logout"><a href="logout.php">Kirjaudu ulos</a></b>
	</div>
	
	<div id="main">
	<h1>Varaukset</h1>
	<a href="http://localhost:8081/woproj/varaa.php" id="varaaUusi">Varaa uusi</a>
	
	<p>Varaukset tähän</p>
	<table id="varaustaulu" name="varaustaulu" class="table table-bordered">
                <thead>
					<tr>
                        <th>ID</th>
                        <th>Laite ID</th>
                        <th>ALKUPVM</th>
						<th>LOPPUPVM</th>  
                    </tr>

                </thead>

            </table>

	<input type="checkbox" name="lainatCheckbox"<br>Näytä lainat <br>
	</div>
	<div id="lainaus" style="display:none;">
	<h2>Lainaukset</h2>
	
	Vuosi
	<select id="vuosiCombobox">
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
	</select>
	
	<table id="lainaustaulu" name="lainaustaulu" class="table table-bordered">
                <thead>
                    <tr>
						<th>ID</th>
                        <th>Laite ID</th>
                        <th>ALKUPVM</th>
						<th>LOPPUPVM</th>  
                        
                    </tr>

                </thead>


            </table>
	
	</div>
</body>
</html>