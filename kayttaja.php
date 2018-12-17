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
		#varaus {
			width: 800px;
			position: fixed;
			top: 20%;
			left: 50%;
			transform: translate(-50%, -50%);
			border: 2px solid black;
			border-radius: 10px;
			padding: 10px;
		}
		
		#lainaus {
			width: 800px;
			position: fixed;
			top: 65%;
			left: 50%;
			transform: translate(-50%, -50%);
			border: 2px solid black;
			border-radius: 10px;
			padding: 10px;
		}
		
		h1 {
			display: inline-block;
		}
		
		#varaaUusi {
			float: right;
			font-weight: bold;
			font-size: 17px;
		}
		
		#logout {
			float: right;
			font-size: 20px;
		}
		
		b {
			font-size: 20px;
		}
    </style>
	<script type="text/javascript">
	
	
		$(document).ready(function(){

			HaeVarausData();				
				
			function HaeVarausData() { 
				
				
				$("#varaustaulu").DataTable({
					"language": {
						"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Finnish.json"
					},
					ajax:{
						url: 'kayttaja_handler.php',
						dataSrc: '',
						data : {STATUS: 'varattu'}
					},					
					"columns": [
						{"data": "ID"},
						{"data": "LAITE_ID"},
						{"data": "ALKUPVM"},
						{"data": "LOPPUPVM"},
						{"defaultContent": '<button id="peru" name="peru">Peru varaus</button>'}
					]
				});	

			}
			
			function HaeLainausData() { //Datan haku
						
				$("#lainaustaulu").DataTable({
					"language": {
						"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Finnish.json"
					},
					ajax:{
						url: 'kayttaja_handler.php',
						dataSrc: '',
						'data': {STATUS : 'lainattu'}
					},					
					"columns": [
						{"data": "ID"},
						{"data": "LAITE_ID"},
						{"data": "ALKUPVM"},
						{"data": "LOPPUPVM"}
					]
				});
			}
			
			
			$("#lainatCheckbox").change( function(){					
				if(this.checked) {
					// checkbox is checked -> do something
					HaeLainausData();
					$('#lainaus').show();
								
				} 
				else {
					// checkbox is not checked -> do something different
					$('#lainaustaulu').DataTable().destroy();
					$('#lainaus').hide();
				}
				});	
					
					
					
			$(document).on('click', '#peru', function () { //Varauksen peruminen
            
            var varausid = $(this).closest('tr').find('td:eq(0)').text();
            if (confirm("Perutaanko varmasti?")) {
                
				 $.post("peru_varaus.php", 
                {
                    ID: varausid,
					peru: ''
                });
            $('#varaustaulu').DataTable().destroy();
            HaeVarausData();
			}
			});
					
		});
				
				
			</script>
</head>
<body>	
	<div id="profile">
		<b><a href="muokkaa.php">Muokkaa omia tietoja</b>
		<b id="logout"><a href="logout.php">Kirjaudu ulos</a></b>
	</div>
	
	<div id="varaus">
	<h1>Varaukset</h1>
	</br>
	<a href="varaa.php" id="varaaUusi">Varaa uusi</a>
	
	<table id="varaustaulu" name="varaustaulu" class="table table-bordered">
                <thead>
					<tr>
                        <th>ID</th>
                        <th>Laite ID</th>
                        <th>ALKUPVM</th>
						<th>LOPPUPVM</th>  
						<th></th>
                    </tr>

                </thead>

            </table>

	<input type="checkbox" id="lainatCheckbox"<br>Näytä lainat <br>
	</div>
	</br>
	
	<div id="lainaus" style="display:none; ">
	</br>
	</br>
	<h2>Lainaukset</h2>
	<label for="vuosiCombobox">Vuosi</label>
	<select id="vuosiCombobox">
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
	</select>
	</br>
	</br>
	
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