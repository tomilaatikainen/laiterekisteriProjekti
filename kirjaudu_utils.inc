<?php

	function check_session()
	{
		if ( !isset($_SESSION["login"]))
		{
			header("Location: kirjaudu.php");
			exit();
		}
	}
?>