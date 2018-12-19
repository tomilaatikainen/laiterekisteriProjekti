<?php
session_start();
require_once("kirjaudu_utils.inc");
	check_session();
if(session_destroy())
{
header("Location: kirjaudu.php");
}
?>