<?php

	function check_session()
	{
		if ( !isset($_SESSION["login"]))
		{
			header("Location: aloitus.php?virhe=2");
			exit();
		}
	}
?>