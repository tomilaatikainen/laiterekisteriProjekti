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
							{"defaultContent": '<button id="delete" name="delete">Poista</button>'}
						]
					})

				})
			}
				
			/*function update_data(id, column_name, value) { //Muokkaa laitetta
            $.ajax({
                url: "adminlaite_handler.php",
                method: "GET",
                data: { id: id, column_name: column_name, value: value },
                success: function (data) {
                    $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function () {
                $('#alert_message').html('');
            }, 5000);
			}

			$(document).on('blur', '.update', function () {
            var id = $(this).data("id");
            var column_name = $(this).data("column");
            var value = $(this).text();
            update_data(id, column_name, value);
			});
*/
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
            
			/*if (confirm("Lisätäänkö varmasti?")){
				$.ajax({
					url: "lisaa.php",
					method: "POST"
				});
			}*/
			
			
            $.post("lisaa.php", //KORJAA TÄMÄ
                {
                    LAITE_NIMI: laitenimi,
                    MERKKI: merkki ,
                    KATEGORIA_ID: kategoria ,
                    OMISTAJA_ID: omistaja,
                    MALLI: malli,
                    KUVAUS: kuvaus,
					SIJAINTI: sijainti
                });
            $('#laitetaulu').DataTable().destroy();
            HaeData();
			
			 });
			
			/*$('#laitetaulu').on('click', '#delete', function () { //Laitteen poistaminen
            
            var LAITE_ID = $(this).closest('tr').find('td:eq(0)').text();
            if (confirm("Poistetaanko varmasti?")) {
                $.ajax({
                    url: "adminlaite_handler.php?LAITE_ID=" + LAITE_ID, //Muokkaa tätä(?)
                    method: "GET",
                    //data: { id: id },
                    success: function (data) {
                        $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                        $('#laitetaulu').DataTable().destroy();
                        HaeData();
                    }
                });
                setInterval(function () {
                    $('#alert_message').html('');
                }, 5000);
				}
			});*/
			
		});	
			</script>
</head>
<body>
    <h1>Lisää, muokkaa tai poista laite</h1>
	<input type="button" id="lisaa" name="Lisaa" value="Lisää uusi laite"/> 
	<form action="lisaa.php" method="post">
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
	</form>
	
</body>
</html>