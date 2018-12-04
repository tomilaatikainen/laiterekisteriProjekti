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
	echo "<label>$nimi</label></br>";
	echo "<label>$kategoria</label></br>";
	echo "<label>$omistaja</label></br>";
	echo "<label>$sijainti</label>";
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
	
	  <script>
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
                    dateFormat: "d.m.yy",
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
	
	
	
	
  });
  </script>
	
</head>
<body>	
	<p value="$nimi"></p>
	
	<p>Alkupvm: <input type="text" id="alkupvm"></p>
	<p>Loppupvm: <input type="text" id="loppupvm"></p>
</body>
</html>