<?php

require_once("mysql_vars.php");

/**
 * Budget-related constants
 */
define(YEARLY_TOTAL,5670);
define(BUDGET_OPCOMM,.19);
define(BUDGET_EVALS,.04);
define(BUDGET_HISTORY,.09);
define(BUDGET_IMPS,.09);
define(BUDGET_RANDD,.19);
define(BUDGET_SOCIAL,.25);
define(BUDGET_MISC,.05);
define(BUDGET_ACCUM,.10);

/**
 * getMysqliConnection() - Get a fresh mysqli connection object
 * @return $mysqli - a mysqli connection
 */
function getMysqliConnection() 
{
	//Connect to the MySQL database using a mysqli object
	$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
	//If there was an error, kill the script
	if ($mysqli->connect_error) {
		die ("Connection Error: ".$mysqli->connect_error."<br/>");
	}
	//Return the $mysqli object
	return $mysqli;
}

/**
 * createTable() - Query the database for all purchases for a committee and create a table of the results
 * @param string $committee - the committee to query data for
 * @return string $html - the table of data created
 */
function createTable($committee) 
{
	//Get a mysqli connection
	$mysqli = getMysqliConnection();
	
	//Form the query to select all entries for the given $committee
	$query = "SELECT * FROM ".SPENDING_TABLE." WHERE committee='".$committee."'";
	
	//Make the query
	$result = $mysqli->query($query);
	//If there was an error, quit the script
	if (!$result) {
		die ("Query Error: ".$mysqli->error."<br/>");
	}
	//Handle the result
	else {
		//Form an html string containing the table
		$html = "<table class='committee'>";
		//Create the table headers
		$html .= "<tr><th>Date</th><th>Item</th><th>Purchaser</th><th>Merchant</th><th>Amount</th></tr>";
		//Loop through each row in the $result
		while($row = $result->fetch_assoc()) {
			//Add a row to the table
			$html .= "<tr><td>".$row["date"]."</td>";
			$html .= "<td>".$row["item"]."</td>";
			$html .= "<td>".$row["purchaser"]."</td>";
			$html .= "<td>".$row["merchant"]."</td>";
			$html .= "<td>".$row["amount"]."</td></tr>";
		}
		//Close the table
		$html .= "</table><br/>";
	}
	
	//Close the mysqli connection
	$mysqli->close();
	
	//Return the $html table string
	return $html;
}

/**
 * getTotal() - Use a mysql query to calculate the total budget spent, overall or by committee
 * @param string $committee - null to query for total budget, string for committee to query total for
 * @return double $total - the total spent overall/for the committee
 */
function getTotal($committee=null) 
{
	//Get a new mysqli connection
	$mysqli = getMysqliConnection();
	
	//If $committee is null, query for the total budget spent
	if ($committee == null) {
		$query = "SELECT SUM(amount) as total FROM ".SPENDING_TABLE;
	} 
	//If $committee is set, query for the total spent by a committee
	else {
		$query = "SELECT SUM(amount) as total FROM ".SPENDING_TABLE." WHERE committee='".$committee."'";
	}
	//Make the query
	$result = $mysqli->query($query);
	//If there was an error, quit the script
	if (!$result) {
		die ("Query Error: ".$mysqli->error."<br/>");
	}
	//If not, return the total
	else {
		$total = $result->fetch_assoc();
		return $total["total"];
	}
}

?>