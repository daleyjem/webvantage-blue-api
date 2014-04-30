<?php
	include_once('../vendor/autoload.php');

	use com\daleyjem\Webvantage;

	$url 		= $_GET['baseUrl'];
	$db			= $_GET['db'];
	$options	= isset($_GET['options']) ? $_GET['options'] : array();


	$webvantage = new Webvantage($url, $db, $options);
	$webvantage->signIn();
	$webvantage->getJobEntries();
	
?>