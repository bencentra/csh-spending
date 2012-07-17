<?php

require_once("mysql_vars.php");

function createTable($committee) 
{
	//Connect to the MySQL database using a mysqli object
	$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
	//If there was an error, kill the script
	if ($mysqli->connect_error) {
		die ("Connection Error: ".$mysqli->connect_error."<br/>");
	}
	
	//Form the query to select all entries for the given $committee
	$query = "SELECT * FROM ".SPENDING_TABLE." WHERE committee='".$committee."'";
	//echo $query."<br/>";
	
	//Make the query
	$result = $mysqli->query($query);
	//If there was an error, quit the script
	if (!$result) {
		die ("Query Error: ".$mysqli->error."<br/>");
	}
	//Handle the result
	else {
		//echo "<pre>";
		$html = createTableHeader();
		while($row = $result->fetch_assoc()) {
			//print_r($row);
			$html .= "<tr><td>".$row["date"]."</td>";
			$html .= "<td>".$row["item"]."</td>";
			$html .= "<td>".$row["purchaser"]."</td>";
			$html .= "<td>".$row["merchant"]."</td>";
			$html .= "<td>".$row["amount"]."</td></tr>";
		}
		$html .= "</table><br/>";
		echo $html;
		//echo "</pre>";
	}
	
	//Close the mysqli connection
	$mysqli->close();
}

function createTableHeader() 
{
	$html = "<table class='committee'><tr><th>Date</th><th>Item</th><th>Purchaser</th><th>Merchant</th><th>Amount</th></tr>";
	return $html;
}