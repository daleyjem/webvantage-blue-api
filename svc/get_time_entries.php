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

	$webvantage = new Webvantage($url, $db, $user, $pass);
	//$webvantage->signIn($db);
	$entries = $webvantage->getJobEntries('4/20/2014');

	echo json_encode($entries);
	
?>