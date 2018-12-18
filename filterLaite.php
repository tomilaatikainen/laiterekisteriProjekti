<?php
function getLaite($nimi, $merkki, $kategoria, $omistaja, $malli, $sijainti, $con)
{
    // oletuksena sql-kysely hakee kaikkien asiakkaiden tiedot
    $query = "SELECT laite.*, kategoria.KATEGORIA_NIMI, omistaja.OMISTAJA_NIMI FROM ((laite 
	INNER JOIN kategoria ON laite.KATEGORIA_ID = kategoria.KATEGORIA_ID) 
	INNER JOIN omistaja ON laite.OMISTAJA_ID = omistaja.OMISTAJA_ID) 
	WHERE (STATUS='varattu' OR STATUS='lainattu') ";
    if (!empty($nimi)) { // jos nimi-kenttään on syötetty jotain, lisätään kyselyyn hakuehto
        $query .= "AND LAITE_NIMI like '%$nimi%'";
    }
    if (!empty($merkki)) { 
        $query .= "AND MERKKI = '" . $merkki . "'";
    }
    if (!empty($kategoria)) { 
        $query .= "AND KATEGORIA_NIMI = '" . $kategoria . "'";
    }
	if (!empty($omistaja)) { 
        $query .= "AND OMISTAJA_NIMI = '" . $omistaja . "'";
    }
	if (!empty($malli)) { 
        $query .= "AND MALLI = '" . $malli . "'";
    }
	if (!empty($sijainti)) { 
        $query .= "AND SIJAINTI = '" . $sijainti . "'";
    }
	
    $response = @mysqli_query($con, $query);

    if ($response) { // jos kysely onnistui
        while ($row = mysqli_fetch_array($response)) {
            echo '<tr><td>' .
                $row['LAITE_ID'] . '</td><td>' .
                $row['LAITE_NIMI'] . '</td><td>' .
                $row['MERKKI'] . '</td><td>' .
                $row['KATEGORIA_NIMI'] . '</td><td>' .
                $row['OMISTAJA_NIMI'] . '</td><td>' .
                $row['MALLI'] . '</td><td>' .
                $row['KUVAUS'] . '</td><td>' .
                $row['SIJAINTI'] . '</td><td><input type="button" id="varaa" name="varaa" value="Varaa"/></td>';
            echo '</tr>';
        }
    } else { // virheen sattuessa
        echo "<p style='color:red'>Virhe haettaessa dataa tietokannasta. Viesti: " . mysqli_error($con) . "</p>";
    }
}
?>