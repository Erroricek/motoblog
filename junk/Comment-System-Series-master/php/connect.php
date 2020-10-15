<?php
	date_default_timezone_set('Europe/Prague');
	$dbhost = 'localhost:3307';
	$dbuser = 'database';
	$dbpass = '$37HP2a9_=Jt*%WR';
	$dbname = 'motoblog';

	$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die(mysqli_error($connect));
?>
