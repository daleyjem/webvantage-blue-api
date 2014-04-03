<?php
	include_once('../src/Webvantage.php');

	$url 		= $_GET['baseUrl'];
	$db			= $_GET['db'];
	$options	= isset($_GET['options']) ? $_GET['options'] : array();


	$webvantage = new Webvantage($url, $db, $options);
	$webvantage->signIn();
	$webvantage->getJobEntries();
	
?>