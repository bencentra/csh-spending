<?php
//Include constants and functions from 'lib.php'
include('lib.php');

//Define some variables for budget totals/percents
$total = 0;
$percent = 0;
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>CSH Spending - 2012</title>
	<link rel="stylesheet" type="text/css" href="style.css"></link>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
		// Load the Visualization API and the piechart package.
   	 	google.load('visualization', '1.0', {'packages':['corechart']});
    
   		// Set a callback to run when the Google Visualization API is loaded.
    	google.setOnLoadCallback(drawBudgetChart);

    	// Callback funtion to create the spending chart
    	function drawBudgetChart() {
        	//Create a new data table for the chart
    		var data = new google.visualization.DataTable();
    		//Add two columns of data: one for committee, one for budget
    		data.addColumn('string', 'Committee');
    		data.addColumn('number', 'Budget');
			//Add the data rows to the table
    		data.addRows([
				['OpComm', <?php echo round(YEARLY_TOTAL*BUDGET_OPCOMM);?>],
				['Evals', <?php echo YEARLY_TOTAL*BUDGET_EVALS;?>],
				['History', <?php echo YEARLY_TOTAL*BUDGET_HISTORY;?>],
				['Imps', <?php echo YEARLY_TOTAL*BUDGET_IMPS;?>],
				['R&D', <?php echo YEARLY_TOTAL*BUDGET_RANDD;?>],
				['Social', <?php echo YEARLY_TOTAL*BUDGET_SOCIAL;?>],
				['Misc', <?php echo YEARLY_TOTAL*BUDGET_MISC;?>],
				['Accum', <?php echo YEARLY_TOTAL*BUDGET_ACCUM;?>]
      		]);
			//Set the options for the chart
      		var options = {'title':'Budget Breakdown by Committee', 'width':500, 'height':300};
      		//Create a new chart
      		var chart = new google.visualization.PieChart(document.getElementById('budget-chart'));
      		//Draw the chart
      		chart.draw(data, options);
    	}
	</script>
</head>
<body>
<div id="wrapper">
	<header>
		<h1>CSH Spending - 2012</h1>
	</header>
	<section> 
		<h2>Budget Breakdown</h2>
		<div id="budget-chart"></div>
		<!-- <table>
			<tr><td>Yearly On-Floor Dues: </td><td>$<?php //echo YEARLY_TOTAL;?></td></tr>
			<tr><td>OpComm: </td><td>$<?php //echo round(YEARLY_TOTAL*BUDGET_OPCOMM);?></td></tr>
			<tr><td>Evals: </td><td>$<?php //echo YEARLY_TOTAL*BUDGET_EVALS;?></td></tr>
			<tr><td>History: </td><td>$<?php //echo YEARLY_TOTAL*BUDGET_HISTORY;?></td></tr>
			<tr><td>Imps: </td><td>$<?php //echo YEARLY_TOTAL*BUDGET_IMPS;?></td></tr>
			<tr><td>R&amp;D: </td><td>$<?php //echo YEARLY_TOTAL*BUDGET_RANDD;?></td></tr>
			<tr><td>Social: </td><td>$<?php //echo YEARLY_TOTAL*BUDGET_SOCIAL;?></td></tr>
			<tr><td>Misc: </td><td>$<?php //echo YEARLY_TOTAL*BUDGET_MISC;?></td></tr>
			<tr><td>Accum (Rollover): </td><td>$<?php //echo YEARLY_TOTAL*BUDGET_ACCUM;?></td></tr>
		</table> -->
	</section>
	<section>
		<h2>Totals</h2>
		<table>
		<tr><td><b>Starting Budget (Yearly On-Floor Dues): </b></td><td>$<?php echo YEARLY_TOTAL;?></td></tr>
		<tr><td><b>Total Donations (User Rack, Off-Floor Dues, etc.): </b></td><td>$<?php $donations = getTotal("donations"); echo $donations; ?></td></tr>
		<tr><td><b>Total Expenditures (Committees): </b></td><td>$<?php $total = getTotal(); echo $total; ?> 
		(<?php $percent = round(($total/YEARLY_TOTAL),2); echo $percent; ?>%)</td></tr>
		<tr><td><b>Remaining Budget (Dues + Donations - Expenses): </b></td><td>$<?php $remaining = YEARLY_TOTAL-$total+$donations; echo $remaining;?>
		(<?php $percent = 100 - round(($remaining/YEARLY_TOTAL),2); echo $percent;?>%)</td></tr>
		</table>
	</section>
	<section>
		<h2>Spending (by Committee)</h2>
		<ul>
			<li><a href="#opcomm">OpComm</a></li>
			<li><a href="#evals">Evals</a></li>
			<li><a href="#history">History</a></li>
			<li><a href="#imps">Imps</a></li>
			<li><a href="#randd">R&amp;D</a></li>
			<li><a href="#social">Social</a></li>
			<li><a href="#misc">Misc</a></li>
			<li><a href="#donations">Donations</a></li>
		</ul>
		<div id="opcomm">
			<h3>OpComm</h3>
			<?php echo createTable("opcomm"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("opcomm"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round($total/(YEARLY_TOTAL*BUDGET_OPCOMM),2); echo $percent; ?>%
		</div>
		<div id="evals">
			<h3>Evals</h3>
			<?php echo createTable("evals"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("evals"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round($total/(YEARLY_TOTAL*BUDGET_EVALS),2); echo $percent; ?>%
		</div>
		<div id="history">
			<h3>History</h3>
			<?php echo createTable("history"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("history"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round($total/(YEARLY_TOTAL*BUDGET_HISTORY),2); echo $percent; ?>%
		</div>
		<div id="imps">
			<h3>Imps</h3>
			<?php echo createTable("imps"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("imps"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round($total/(YEARLY_TOTAL*BUDGET_IMPS),2); echo $percent; ?>%
		</div>
		<div id="randd">
			<h3>R&amp;D</h3>
			<?php echo createTable("randd"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("randd"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round($total/(YEARLY_TOTAL*BUDGET_RANDD),2); echo $percent; ?>%
		</div>
		<div id="social">
			<h3>Social</h3>
			<?php echo createTable("social"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("social"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round($total/(YEARLY_TOTAL*BUDGET_SOCIAL),2); echo $percent; ?>%
		</div>
		<div id="misc">
			<h3>Misc</h3>
			<?php echo createTable("misc"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("misc"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round($total/(YEARLY_TOTAL*BUDGET_MISC),2); echo $percent; ?>%
		</div>
	</section>
	<section>
		<h2>Donations</h2>
		<div id="donations">
			<?php echo createTable("donations"); ?>
			<b>Total Donations: </b>$<?php $total = getTotal("donations"); echo $total; ?><br/>
		</div>
	</section>
	<footer>
		<p>Made by <a href="mailto:bencentra@csh.rit.edu">Ben Centra</a>
	</footer>
</div>
</body>
</html>