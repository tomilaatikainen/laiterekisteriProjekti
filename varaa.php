<?php
	session_start();
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
</head>
<body>
    <div>
		<h1>Varaa laite</h1>
		Nimi <input type="text" name="nimi" /><br />
		Kategoria <select name="sijainti">
				<option value="tyhja">- valitse kategoria -</option>
				<option value="puhelin">puhelin</option>
				<option value="tabletti">tabletti</option>
				<option value="kannettava tietokone">kannettava tietokone</option>
				<option value="alykello">älykello</option>
				<option value="poytakone">pöytäkone</option>
			</select><br />
		Merkki <select name="merkki">
				<option value="tyhja">- valitse merkki -</option>
			</select><br />
		Malli <select name="malli">
				<option value="tyhja">- valitse malli -</option>
			</select><br />
		Sijainti <select name="sijainti">
				<option value="tyhja">- valitse sijainti -</option>
			</select><br />
		Omistaja <select name="sijainti">
				<option value="tyhja">- valitse omistaja -</option>
				<option value="gigantti">Gigantti</option>
				<option value="power">Power</option>
				<option value="dna">DNA</option>
			</select><br />
    </div>
	<div>
		<table id="laitetaulu" name="laitetaulu" class="table table-bordered">
                <thead>
					<tr>
                        <th>NIMI</th>
                        <th>KATEGORIA</th>
                        <th>MERKKI</th>
						<th>MALLI</th>  
						<th>SIJAINTI</th>
						<th>OMISTAJA</th>  
						<th></th>
                    </tr>

                </thead>

            </table>
	</div>
	
</body>
</html>