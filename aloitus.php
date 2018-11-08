<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Laiterekisteri</title>
    <style>
        #parent {
            width: 100%;
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        #form_login {
            margin: 0 auto;
            border: 3px solid black;
            width: 400px;
            height: 250px;
        }

        #div_login {
            margin-left: 20px;
        }
    </style>
</head>
<body>	
	
	<div css="text-align:center" id="parent">
        <form id="form_login" action="aloitus_handler.php" method="post">
            <div id="div_login">
                <h1>Kirjaudu</h1>

                Tunnus: <input type="text" name="tunnus" /><br />
                Salasana: <input type="text" name="salasana" /><br />

                <input type="submit" value="Kirjaudu" /><br />

                Uusi asiakas?
                <a href="http://localhost:8081/woproj/rekisteroidy.php">Luo uusi käyttäjä</a><br /><br />
            </div>
        </form>
    </div>

</body>
</html>