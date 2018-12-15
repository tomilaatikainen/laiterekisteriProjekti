<?php
	session_start();
	require_once("kirjaudu_utils.inc");
	check_session();
	
	$id = $_SESSION['id'];
	$nimi = $_SESSION['nimi']; 
	$merkki = $_SESSION['merkki']; 
	$kategoria = $_SESSION['kategoria']; 
	$omistaja = $_SESSION['omistaja'];  
	$malli = $_SESSION['malli'];
	$kuvaus = $_SESSION['kuvaus'];
	$sijainti = $_SESSION['sijainti'];
	$tunnus = $_SESSION['tunnus'];
	//echo "<label>$nimi</label></br>";
	//echo "<label>$kategoria</label></br>";
	//echo "<label>$omistaja</label></br>";
	//echo "<label>$sijainti</label>";
?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Uusi varaus</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        
    </style>
	
	  <script type="text/javascript">
  $(document).ready(function () {
  
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
				
    $( "#alkupvm" ).datepicker({
		minDate: 0,
	});
	
	$( "#loppupvm" ).datepicker({
		minDate: 0,
	});
	} );
	
	
	
	$(document).on('click' ,'#hyvaksy', function () {
	//("#hyvaksy").click(function () {
		 
		var laiteid = $('#id').val();
		var pvmalku1 = $("#alkupvm").datepicker('getDate');
		var pvmloppu1 = $("#loppupvm").datepicker('getDate');
		var tunnus = $('#tunnus').val();
		
		
		function formatDate(date) {
			var d = new Date(date),
				month = '' + (d.getMonth() + 1),
				day = '' + d.getDate(),
				year = d.getFullYear();

			if (month.length < 2) month = '0' + month;
			if (day.length < 2) day = '0' + day;

			return [year, month, day].join('-');
		}
		
		var pvmalku = formatDate(pvmalku1);
		var pvmloppu = formatDate(pvmloppu1);
		
		
		 $.post("kalenteri_handler.php", 
                {
                    LAITE_ID: laiteid,
					ALKUPVM: pvmalku,
					LOPPUPVM: pvmloppu,
					STATUS: 'varattu',
					ASIAKAS_TUNNUS: tunnus,
					hyvaksy: ''
                })
				
				.done(function() {
					document.location = 'kayttaja.php';
				});
				
	});
	
  });
  </script>
	
</head>
<body>	
	<label for="id">LaiteID:</label>
	<input type="text" id="id" name="id" value="<?php echo $id; ?>"/>
	<label for="tunnus">Tunnus:</label>
	<input type="text" id="tunnus" name="tunnus" value="<?php echo $tunnus; ?>"/>
	
	<p>Alkupvm: <input type="text" id="alkupvm" name="alkupvm"></p>
	<p>Loppupvm: <input type="text" id="loppupvm" name="loppupvm"></p>
	<input type="button" id="hyvaksy" name="hyvaksy" value="Hyväksy varaus"/></br>
	<a href="http://localhost:8081/woproj/varaa.php">Edelliselle sivulle</a>
	
</body>
</html>