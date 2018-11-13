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
			width: 500px;
			border: 1px dotted black;
		}
		
		h1 {
			display: inline-block;
		}
		
		#varaaButton {
			float: right;
		}
    </style>
</head>
<body>	
	<div id="main">
	<h1>Varaukset</h1>
	<input type="button" id="varaaButton" value="Varaa uusi">
	
	<p>Varaukset tähän</p>
	<table id="varaustaulu" name="varaustaulu" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Asd</th>
                        <th>Asd</th>
                        <th>Asd</th>
                        
                    </tr>

                </thead>

                <tbody>
                    <tr></tr>

                </tbody>

            </table>
	
	<input type="checkbox" name="lainatCheckbox"<br>Näytä lainat <br>
	
	<h2>Lainaukset</h2>
	
	Vuosi
	<select id="vuosiCombobox">
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
	</select>
	
	<table id="varaustaulu" name="varaustaulu" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Asd</th>
                        <th>Asd</th>
                        <th>Asd</th>
                        
                    </tr>

                </thead>

                <tbody>
                    <tr></tr>

                </tbody>

            </table>
	
	</div>
</body>
</html>