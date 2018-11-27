<?php

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
            
            $.post("lisaa.php", 
                {
                    LAITE_NIMI: laitenimi,
                    MERKKI: merkki ,
                    KATEGORIA_ID: kategoria ,
                    OMISTAJA_ID: omistaja,
                    MALLI: malli,
                    KUVAUS: kuvaus,
					SIJAINTI: sijainti,
					insert: ''
                });
            $('#laitetaulu').DataTable().destroy();
            HaeData();
			
			 });
			
			$(document).on('click', '#delete', function () { //Laitteen poistaminen
            
            var laiteid = $(this).closest('tr').find('td:eq(0)').text();
            if (confirm("Poistetaanko varmasti?")) {
                
				 $.post("poista.php", 
                {
                    LAITE_ID: laiteid,
					poista: ''
                });
            $('#laitetaulu').DataTable().destroy();
            HaeData();
			}
			});
			
			//muokkaus alkaa
			
			$(document).on('click' ,'#edit', function () { //Käyttäjä painaa muokkaa-nappia
				//insert killer kode here
			var laiteid = $(this).closest('tr').find('td:eq(0)').text();
			$.ajax({ 
				url:"fetch_single.php",
				method: "POST",
				data:{LAITE_ID: laiteid},
				dataType: "json",
				success: function(data)
				{
					$('#myModal').modal('show');
					$('#laitenimi').val(data.laitenimi);
					$('#merkki').val(data.merkki);
					$('#kategoria').val(data.kategoria);
					$('#omistaja').val(data.omistaja);
					$('#malli').val(data.malli);
					$('#kuvaus').val(data.kuvaus);
					$('#sijainti').val(data.sijainti);
				}
			
			});
			});
			
			$(document).on('submit', function () { //Käyttäjä painaa tallenna-nappia
            

		});	
		
		//muokkaus loppuu
		
	});	
			</script>
</head>
<body>
    <h1>Lisää, muokkaa tai poista laite</h1>
	<input type="button" id="lisaa" name="Lisaa" value="Lisää uusi laite"/> 
	
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
	
	<div class="modal fade" id="myModal" role="dialog">
	  <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Muokkaa tietoja</h4>
        </div>
        <div class="modal-body">
		
		<form action="edit.php" method="post">
          <label for="laitenimi">Laitenimi:</label>
		  <input type="text" id="laitenimi"><br>
		  
		  <label for="merkki">Merkki:</label>
		  <input type="text" id="merkki"><br>
		  
		  <label for="kategoria">Kategoria:</label>
		  <input type="text" id="kategoria"><br>
		  
		  <label for="omistaja">Omistaja:</label>
		  <input type="text" id="omistaja"><br>
		  
		  <label for="malli">Malli:</label>
		  <input type="text" id="malli"><br>
		  
		  <label for="kuvaus">Kuvaus:</label>
		  <input type="text" id="kuvaus"><br>
		  
		  <label for="sijainti">Sijainti:</label>
		  <input type="text" id="sijainti"><br>
		  
        </div>
        <div class="modal-footer">
          <button type="submit" name="tallenna" id="tallenna" class="btn btn-default">Tallenna</button>
		  </form>
		  
        </div>
      </div>
      
	</div>
	
</body>
</html>