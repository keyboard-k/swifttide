<?php
//This is a controller file
	//Get database files
	//homepage.dl.php
	//sample.dl.php
	$E['dl'][] = 'homepage';
	$E['dl'][] = 'sample';

	require_once('ignition.php'); //The first line in every file!!
	
	//get the layout file, simple
	require($E['ly'] . 'homepage.ly.php');
?>