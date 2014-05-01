<?php
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	include_once('../vendor/autoload.php');

	use com\daleyjem\webvantage\Webvantage;

	$url 		= $_GET['url'];
	$db			= $_GET['db'];
	$user		= $_GET['user'];
	$pass		= $_GET['pass'];
	$dateSpan	= (isset($_GET['dateSpan'])) ? ($_GET['dateSpan']) : (null);

	$webvantage = new Webvantage($url, $db, $user, $pass);
	
	$entries = $webvantage->getJobEntries($dateSpan);

	echo json_encode($entries);
	
?>