<?php
//Include constants and functions from 'lib.php'
include('lib.php');

//Define some variables for budget totals/percents
$combinedTotal = 0;
$combinedPercent = 0;
$committeeTotal = 0;
$committeePercent = 0;

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
		<h2>Budget Breakdown</h2>
		<table>
			<tr><td>Yearly On-Floor Dues: </td><td>$<?php echo YEARLY_TOTAL;?></td></tr>
			<tr><td>OpComm: </td><td>$<?php echo round(YEARLY_TOTAL*BUDGET_OPCOMM);?></td></tr>
			<tr><td>Evals: </td><td>$<?php echo YEARLY_TOTAL*BUDGET_EVALS;?></td></tr>
			<tr><td>History: </td><td>$<?php echo YEARLY_TOTAL*BUDGET_HISTORY;?></td></tr>
			<tr><td>Imps: </td><td>$<?php echo YEARLY_TOTAL*BUDGET_IMPS;?></td></tr>
			<tr><td>R&amp;D: </td><td>$<?php echo YEARLY_TOTAL*BUDGET_RANDD;?></td></tr>
			<tr><td>Social: </td><td>$<?php echo YEARLY_TOTAL*BUDGET_SOCIAL;?></td></tr>
			<tr><td>Misc: </td><td>$<?php echo YEARLY_TOTAL*BUDGET_MISC;?></td></tr>
			<tr><td>Accum (Rollover): </td><td>$<?php echo YEARLY_TOTAL*BUDGET_ACCUM;?></td></tr>
		</table>
	</section>
	<section>
		<h2>Totals</h2>
		<b>Total Expenditure: </b>$<?php $combinedTotal = getTotal()+(YEARLY_TOTAL*BUDGET_ACCUM); echo $combinedTotal; ?>
	</section>
	<section>
		<h2>Spending (by Committee)</h2>
		<h3>OpComm</h3>
		<?php echo createTable("opcomm"); ?>
		<b>Total Spent: </b>$<?php $committeeTotal = getTotal("opcomm"); echo $committeeTotal; ?><br/>
		<b>Percentage Spent: </b><?php $committeePercent = round($committeeTotal/(YEARLY_TOTAL*BUDGET_OPCOMM),2); echo $committeePercent; ?>%
		<h3>Evals</h3>
		<?php echo createTable("evals"); ?>
		<b>Total Spent: </b>$<?php $committeeTotal = getTotal("evals"); echo $committeeTotal; ?><br/>
		<b>Percentage Spent: </b><?php $committeePercent = round($committeeTotal/(YEARLY_TOTAL*BUDGET_EVALS),2); echo $committeePercent; ?>%
		<h3>History</h3>
		<?php echo createTable("history"); ?>
		<b>Total Spent: </b>$<?php $committeeTotal = getTotal("history"); echo $committeeTotal; ?><br/>
		<b>Percentage Spent: </b><?php $committeePercent = round($committeeTotal/(YEARLY_TOTAL*BUDGET_HISTORY),2); echo $committeePercent; ?>%
		<h3>Imps</h3>
		<?php echo createTable("imps"); ?>
		<b>Total Spent: </b>$<?php $committeeTotal = getTotal("imps"); echo $committeeTotal; ?><br/>
		<b>Percentage Spent: </b><?php $committeePercent = round($committeeTotal/(YEARLY_TOTAL*BUDGET_IMPS),2); echo $committeePercent; ?>%
		<h3>R&amp;D</h3>
		<?php echo createTable("randd"); ?>
		<b>Total Spent: </b>$<?php $committeeTotal = getTotal("randd"); echo $committeeTotal; ?><br/>
		<b>Percentage Spent: </b><?php $committeePercent = round($committeeTotal/(YEARLY_TOTAL*BUDGET_RANDD),2); echo $committeePercent; ?>%
		<h3>Social</h3>
		<?php echo createTable("social"); ?>
		<b>Total Spent: </b>$<?php $committeeTotal = getTotal("social"); echo $committeeTotal; ?><br/>
		<b>Percentage Spent: </b><?php $committeePercent = round($committeeTotal/(YEARLY_TOTAL*BUDGET_SOCIAL),2); echo $committeePercent; ?>%
		<h3>Misc</h3>
		<?php echo createTable("misc"); ?>
		<b>Total Spent: </b>$<?php $committeeTotal = getTotal("misc"); echo $committeeTotal; ?><br/>
		<b>Percentage Spent: </b><?php $committeePercent = round($committeeTotal/(YEARLY_TOTAL*BUDGET_MISC),2); echo $committeePercent; ?>%
	</section>
	<footer>
	
	</footer>
</body>
</html>