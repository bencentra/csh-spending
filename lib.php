<?php

require_once("mysql_vars.php");

function createTable($committee) {
	//Connect to the MySQL database using a mysqli object
	$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
	//If there was an error, kill the script
	if ($mysqli->conect_error) {
		die ("Connection Error: ".$mysqli->connect_error."<br/>");
	}
	
	//Form the query to select all entries for the given $committee
	$query = "SELECT * FROM ".SPENDING_TABLE." WHERE `committee` = `".$committee."`";
	
	//Make the query
	$result = $mysqli->query($query);
	//If there was an error, quit the script
	if (!$result) {
		die ("Query Error: ".$mysqli->error."<br/>");
	}
	//Handle the result
	else {
		echo "<pre>";
		print_r($result);
		echo "</pre>";
	}
	
	//Close the mysqli connection
	$mysqli->close();
}