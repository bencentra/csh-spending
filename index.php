<?php
require_once('lib.php');
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>CSH Spending - 2012</title>
	<link rel="stylesheet" type="text/css" href="style.css"></link>
</head>
<body>
	<header>
		<h1>CSH Spending - 2012</h1>
	</header>
	<section> 
		<h3>Budget Breakdown</h3>
	</section>
	<section>
		<h3>Spending (by Committee)</h3>
		<h3>OpComm</h3>
		<?php createTable("opcomm"); ?>
		<h3>Evals</h3>
		<?php createTable("evals"); ?>
		<h3>History</h3>
		<?php createTable("history"); ?>
		<h3>Imps</h3>
		<?php createTable("imps"); ?>
		<h3>R&amp;D</h3>
		<?php createTable("randd"); ?>
		<h3>Social</h3>
		<?php createTable("social"); ?>
		<h3>Misc</h3>
		<?php createTable("misc"); ?>
	</section>
	<footer>
	
	</footer>
</body>
</html>