<?php
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Varaukset (admin)</title>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
    <style>
		#main {
			width: 60%;
			position: fixed;
			top: 25%;
			left: 50%;
			transform: translate(-50%, -50%);
			border: 2px solid black;
			border-radius: 10px;
			padding: 10px;
			display: block;
			height: 40%;
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
		#varaaUusi {
			float: right;
			font-weight: bold;
			font-size: 17px;
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
					"autoWidth": false,
					ajax:{
						url: 'adminvaraus_handler.php',
						dataSrc: ''
						//data : {STATUS: 'varattu'}
					},					
					"columns": [
						{"data": "ID"},
						{"data": "LAITE_ID"},
						{"data": "ALKUPVM"},
						{"data": "LOPPUPVM"},
						{"data": "ASIAKAS_TUNNUS"},
						{"defaultContent": '<button id="peru" name="peru">Peru varaus</button><button id="edit" name="edit" data-toggle="modal" data-target="#myModal">Muokkaa</button>'}
					]
				});	

			}
			
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
				
			//////////////////// VARAUKSEN MUOKKAUS ///////////////////////
			
			$( function() {
	  
			$.datepicker.setDefaults($.datepicker.regional['fi'] = {
                    closeText: "Sulje",
                    prevText: "&#xAB;Edellinen",
                    nextText: "Seuraava&#xBB;",
                    currentText: "Tänään",
                    monthNames: ["Tammikuu", "Helmikuu", "Maaliskuu", "Huhtikuu", "Toukokuu", "Kesäkuu",
                        "Heinäkuu", "Elokuu", "Syyskuu", "Lokakuu", "Marraskuu", "Joulukuu"],
                    monthNamesShort: ["Tammi", "Helmi", "Maalis", "Huhti", "Touko", "Kesä",
                        "Heinä", "Elo", "Syys", "Loka", "Marras", "Joulu"],
                    dayNamesShort: ["Su", "Ma", "Ti", "Ke", "To", "Pe", "La"],
                    dayNames: ["Sunnuntai", "Maanantai", "Tiistai", "Keskiviikko", "Torstai", "Perjantai", "Lauantai"],
                    dayNamesMin: ["Su", "Ma", "Ti", "Ke", "To", "Pe", "La"],
                    weekHeader: "Vk",
                    dateFormat: "yy-m-d",
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ""
                });
				
			$( "#ALKUPVM" ).datepicker({
				minDate: 0,
			});
				
			$( "#LOPPUPVM" ).datepicker({
				minDate: 0,
			});
			
			});
			
			$(document).on('click' ,'#edit', function () { //Muokkaa-nappia painetaan

			var laiteid = $(this).closest('tr').find('td:eq(1)').text();
			$.ajax({ 
				url:"fetch_muokkaavaraus.php",
				method: "POST",
				data:{LAITE_ID: laiteid},
				dataType: "json",
				success: function(data)
				{					
					$('#myModal').modal('show');
					$('#LAITE_ID').val(data.LAITE_ID);
					$('#ALKUPVM').val(data.ALKUPVM);
					$('#LOPPUPVM').val(data.LOPPUPVM);
				}
			
			});
			});
			
			//tähän asti toimii
			
			$(document).on('submit', '#user_form',  function () { //Käyttäjä painaa tallenna-nappia
				
				var laiteid = $('#LAITE_ID').val();
				var alkupvm = $('#ALKUPVM').val();
				var loppupvm = $('#LOPPUPVM').val();
				
				
				if(alkupvm != '' && loppupvm != '')
				{
				
				$.post("edit_varaus.php", 
                {
					LAITE_ID: laiteid,
                    ALKUPVM: alkupvm,
					LOPPUPVM: loppupvm
                })
				.done(function() {
					$('#user_form')[0].reset(); //Tyhjennetään muokkaus dialogi
					$('#myModal').modal('hide');
					$('#varaustaulu').DataTable().destroy();
					HaeVarausData();
				});

						
				}
				else
				{
					alert("TARKISTA KENTÄT!");
				}
				});			
				//////////////////// VARAUKSEN MUOKKAUS LOPPUU///////////////////////

				
		});
				
				
			</script>
</head>
<body>	
	<div id="profile">
		<b id="logout"><a href="logout.php">Kirjaudu ulos</a></b>
		<b><a href='adminlaite.php'>Edelliselle sivulle</a></b></br>
	</div>
	
	<div id="main">
	
	
	<h1>Varaukset</h1>
	<a href="varaa.php" id="varaaUusi">Varaa uusi</a>
	
	<table id="varaustaulu" name="varaustaulu" class="table table-bordered">
                <thead>
					<tr>
                        <th>ID</th>
                        <th>Laite ID</th>
                        <th>ALKUPVM</th>
						<th>LOPPUPVM</th> 
						<th>VARAAJA</th> 
						<th></th>
                    </tr>

                </thead>

            </table>

	</div>
	
	<div class="modal fade" id="myModal" name="myModal" role="dialog">
	  <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Muokkaa tietoja</h4>
        </div>
        <div class="modal-body">
		
		<form method="post" enctype="multipart/form-data" id="user_form">
          <label for="ALKUPVM">Alkupvm:</label>
		  <input type="text" id="ALKUPVM" name="alkupvm" class="form-control"></br>
		  
		  <label for="LOPPUPVM">Loppupvm:</label>
		  <input type="text" id="LOPPUPVM" name="loppupvm" class="form-control"></br>
		  
        </div>
        <div class="modal-footer">
			<input type="hidden" name="LAITE_ID" id="LAITE_ID" />
          <input type="submit" name="tallenna" id="tallenna" class="btn btn-default" value="Tallenna"/ >
		  </form>
		  
        </div>
      </div>
      
	</div>
	
</body>
</html>