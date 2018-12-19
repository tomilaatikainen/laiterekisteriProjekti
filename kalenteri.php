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
        #parent {
            width: 100%;
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        #form {
            margin: 0 auto;
            border: 3px solid black;
			border-radius: 20px;
            width: 55%;
            height: 70%;
			max-width: 600px;
        }

        #div {
            margin-left: 20px;
			margin-right: 20px;
        }
		
		input[type=text] {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
		}
		
		input[type=button] {
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 100%;
		}
		
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
	
	
	
	$(document).on('click' ,'#hyvaksy', function () { //käyttäjä hyväksyy varauksen
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
				
				.done(function(data) {
					alert(data);
				});
	});
	
  });
  </script>
	
</head>
<body>	
	
	<div css="text-align:center" id="parent">
		<form id="form">
			<div id="div">
			
	<input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
	<input type="hidden" id="tunnus" name="tunnus" value="<?php echo $tunnus; ?>"/>
	
	<h1>Varaa laite</h1>
	<p>Laite: <?php echo "$nimi";?></p>
	<p>Sijainti: <?php echo "$sijainti";?></p>
	
	<p>Alkupvm: <input type="text" id="alkupvm" name="alkupvm" autocomplete="off"></p>
	<p>Loppupvm: <input type="text" id="loppupvm" name="loppupvm" autocomplete="off"></p>
	<input type="button" id="hyvaksy" name="hyvaksy" value="Hyväksy varaus"/></br>
	<a href="varaa.php" class="">Edelliselle sivulle</a></br>
	
			</div>
        </form>
    </div>
	
</body>
</html>