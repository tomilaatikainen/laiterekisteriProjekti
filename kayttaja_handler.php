﻿<?php
	session_start();
	require_once("database_utils.inc");

	$asiakas["tunnus"] = $_SESSION["tunnus"];
	$asiakas["nimi"] = $_SESSION["nimi"];

    $data = haeVaraukset($asiakas);


?>