<?php
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
	
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Lisää, muokkaa tai poista laite</title>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	
    <style>
       #adminlaite{
		   	width: 80%;
			position: fixed;
			top: 40%;
			left: 50%;
			transform: translate(-50%, -50%);
			padding: 10px;
			display: block;
			height: 55%;
	   }
	   
	   		#logout {
			float: right;
			font-size: 20px;
		}
		h1{
			text-align: center;
			
		}
	   
    </style>
	<script type="text/javascript">
				
		$(document).ready(function () {	
				
			HaeData();
				
			var data;
				
			function HaeData() { //Datan haku
				$.ajax({
					'url': "adminlaite_handler.php",
					'method': 'GET'

				}).done(function (data) {
					$('#laitetaulu').DataTable({
						"language": {
						"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Finnish.json"
					},
					"autoWidth": false,
						"data": data,
						"columns": [
							{"data": "LAITE_ID"},
							{"data": "LAITE_NIMI"},
							{"data": "MERKKI"},
							{"data": "KATEGORIA_NIMI"},
							{"data": "OMISTAJA_NIMI"},
							{"data": "MALLI"},
							{"data": "KUVAUS"},
							{"data": "SIJAINTI"},
							{"data": "STATUS"},
							{"defaultContent": '<button id="delete" name="delete">Poista</button> <button id="edit" name="edit" data-toggle="modal" data-target="#myModal">Muokkaa</button>'}
						]
					})

				})
			}
				
			$('#lisaa').click(function () {
            var html = '<tr>';
            html += '<td><input type="submit" name="insert" id="insert" value="Lisää" class="btn btn-success btn-xs"></td>';
            html += '<td contenteditable id="data1"></td>';
            html += '<td contenteditable id="data2"></td>';
            html += '<td contenteditable id="data3"></td>';
            html += '<td contenteditable id="data4"></td>';
            html += '<td contenteditable id="data5"></td>';
            html += '<td contenteditable id="data6"></td>';
			html += '<td contenteditable id="data7"></td>';
			html += '<td contenteditable id="data8"></td>';

            html += '</tr>';
            $('#laitetaulu').prepend(html);
			});

			$(document).on('click', '#insert', function () {
            var laitenimi = $('#data1').text();
            var merkki = $('#data2').text();
            var kategoria = $('#data3').text();
            var omistaja = $('#data4').text();
            var malli = $('#data5').text();
            var kuvaus = $('#data6').text();
			var sijainti = $('#data7').text();
			var status = $('#data8').text();
            
            $.post("lisaa.php", 
                {
                    LAITE_NIMI: laitenimi,
                    MERKKI: merkki ,
                    KATEGORIA_NIMI: kategoria ,
                    OMISTAJA_NIMI: omistaja,
                    MALLI: malli,
                    KUVAUS: kuvaus,
					SIJAINTI: sijainti,
					STATUS: status,
					insert: ''
                })
				
				.done(function() {
					$('#laitetaulu').DataTable().destroy();
					HaeData();
				});
            
			
			 });
			
			$(document).on('click', '#delete', function () { //Laitteen poistaminen
            
            var laiteid = $(this).closest('tr').find('td:eq(0)').text();
            if (confirm("Poistetaanko varmasti?")) {
                
				 $.post("poista_laite.php", 
                {
                    LAITE_ID: laiteid,
					poista: ''
                })
				
				.done(function() {
					$('#laitetaulu').DataTable().destroy();
					HaeData();
				});
			}
			});
			
			
			$(document).on('click' ,'#edit', function () { //Käyttäjä painaa muokkaa-nappia

			var laiteid = $(this).closest('tr').find('td:eq(0)').text();
			$.ajax({ 
				url:"fetch_single.php",
				method: "POST",
				data:{LAITE_ID: laiteid},
				dataType: "json",
				success: function(data)
				{					
					$('#myModal').modal('show');
					$('#LAITE_ID').val(data.LAITE_ID);
					$('#LAITE_NIMI').val(data.LAITE_NIMI);
					$('#MERKKI').val(data.MERKKI);
					$('#KATEGORIA_ID').val(data.KATEGORIA_NIMI);
					$('#OMISTAJA_ID').val(data.OMISTAJA_NIMI);
					$('#MALLI').val(data.MALLI);
					$('#KUVAUS').val(data.KUVAUS);
					$('#SIJAINTI').val(data.SIJAINTI);
					$('#STATUS').val(data.STATUS);
				}
			
			});
			});
			
			$(document).on('submit', '#user_form',  function () { //Käyttäjä painaa tallenna-nappia
				
				
				var laitenimi = $('#LAITE_NIMI').val();
				var laiteid = $('#LAITE_ID').val();
				var merkki = $('#MERKKI').val();
				var kategoria = $('#KATEGORIA_ID').val();
				var omistaja = $('#OMISTAJA_ID').val();
				var malli = $('#MALLI').val();
				var kuvaus = $('#KUVAUS').val();
				var sijainti = $('#SIJAINTI').val();
				var status = $('#STATUS').val();
				
				
				if(laitenimi != '' && merkki != '' && kategoria != '' && omistaja != '' && malli != '' && kuvaus != '' && sijainti != '' && status != '')
				{
				
				$.post("edit.php", 
                {
					LAITE_ID: laiteid,
                    LAITE_NIMI: laitenimi,
                    MERKKI: merkki ,
                    KATEGORIA_NIMI: kategoria ,
                    OMISTAJA_NIMI: omistaja,
                    MALLI: malli,
                    KUVAUS: kuvaus,
					SIJAINTI: sijainti,
					STATUS: status
					
                })
				//.done(function() {
					$('#user_form')[0].reset(); //Tyhjennetään muokkaus dialogi
					$('#myModal').modal('hide');
					$('#laitetaulu').DataTable().destroy();
					HaeData();
				//});

						
				}
				else
				{
					alert("TARKISTA KENTÄT!");
				}
				});			
	});	
			</script>
</head>
<body>
<b id="logout"><a href="logout.php">Kirjaudu ulos</a></b>
<b id="varaukset"><a href="adminvaraus.php">Varaukset</a></b>

<h1>Lisää, muokkaa tai poista laite</h1>
	<div id="adminlaite">
    
	<input type="button" id="lisaa" name="Lisaa" value="Lisää uusi laite"/> 
	

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
						<th>Status</th>
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
          <label for="LAITE_NIMI">Laitenimi:</label>
		  <input type="text" id="LAITE_NIMI" name="laitenimi" class="form-control"></br>
		  
		  <label for="MERKKI">Merkki:</label>
		  <input type="text" id="MERKKI" name="merkki" class="form-control"></br>
		  
		  <label for="KATEGORIA_ID">Kategoria:</label>
		  <input type="text" id="KATEGORIA_ID" name="kategoria" class="form-control"></br>
		  
		  <label for="OMISTAJA_ID">Omistaja:</label>
		  <input type="text" id="OMISTAJA_ID" name="omistaja" class="form-control"></br>
		  
		  <label for="MALLI">Malli:</label>
		  <input type="text" id="MALLI" name="malli" class="form-control"></br>
		  
		  <label for="KUVAUS">Kuvaus:</label>
		  <input type="text" id="KUVAUS" name="kuvaus" class="form-control"></br>
		  
		  <label for="SIJAINTI">Sijainti:</label>
		  <input type="text" id="SIJAINTI" name="sijainti" class="form-control"></br>
		  
		  <label for="STATUS">Status:</label>
		  <input type="text" id="STATUS" name="status" class="form-control"></br>
		  
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