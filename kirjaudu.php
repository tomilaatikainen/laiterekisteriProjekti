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
			border-radius: 20px;
            width: 55%;
            height: 60%;
			max-width: 600px;
        }

        #div_login {
            margin-left: 20px;
			margin-right: 20px;
        }
		
		input[type=text], input[type=password] {
		width: 100%;
		padding: 12px 20px;
		margin: 8px 0;
		display: inline-block;
		border: 1px solid #ccc;
		box-sizing: border-box;
		}
		
		input[type=submit] {
		background-color: #4CAF50;
		color: white;
		padding: 14px 20px;
		margin: 8px 0;
		border: none;
		cursor: pointer;
		width: 100%;
		}


    </style>
</head>
<body>	
	
	<div css="text-align:center" id="parent">
        <form id="form_login" action="kirjaudu_handler.php" method="post">
            <div id="div_login">
                <h1>Kirjaudu</h1>

                Tunnus: <input type="text" name="tunnus" /><br />
                Salasana: <input type="password" name="salasana" /><br />

                <input type="submit" value="Kirjaudu" /><br />

                Uusi asiakas?
                <a href="rekisteroidy.php">Luo uusi käyttäjä</a><br /><br />
            </div>
        </form>
    </div>

</body>
</html>