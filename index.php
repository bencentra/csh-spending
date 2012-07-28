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
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<link rel="stylesheet" type="text/css" href="jquery-ui/css/smoothness/jquery-ui-1.8.22.custom.css"/>
	<script type="text/javascript" src="jquery-ui/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="jquery-ui/js/jquery-ui-1.8.22.custom.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript">
		//Set up the tabs
		$(function() {
			$( "#tabs" ).tabs();
		});
		// Load the Visualization API and the piechart package.
   	 	google.load('visualization', '1.0', {'packages':['corechart']});
    
   		// Set a callback to run when the Google Visualization API is loaded.
    	google.setOnLoadCallback(drawCharts);

    	// Callback funtion to create the spending chart
    	function drawCharts() {
        	//Create a new data table for the totals chart
    		var totalsData = new google.visualization.DataTable();
    		//Add two columns of data: one for committee, one for budget
    		totalsData.addColumn('string', 'Committee');
    		totalsData.addColumn('number', 'Budget');
			//Add the data rows to the table
    		totalsData.addRows([
				['OpComm', <?php echo round(YEARLY_TOTAL*BUDGET_OPCOMM,2);?>],
				['Evals', <?php echo round(YEARLY_TOTAL*BUDGET_EVALS,2);?>],
				['History', <?php echo round(YEARLY_TOTAL*BUDGET_HISTORY,2);?>],
				['Imps', <?php echo round(YEARLY_TOTAL*BUDGET_IMPS,2);?>],
				['R&D', <?php echo round(YEARLY_TOTAL*BUDGET_RANDD,2);?>],
				['Social', <?php echo round(YEARLY_TOTAL*BUDGET_SOCIAL,2);?>],
				['Misc', <?php echo round(YEARLY_TOTAL*BUDGET_MISC,2);?>],
				['Accum', <?php echo round(YEARLY_TOTAL*BUDGET_ACCUM,2);?>]
      		]);
			//Set the options for the totals chart
      		var totalsOptions = {'title':'Budget Breakdown by Committee', 'width':375, 'height':300};
      		//Create a new chart
      		var totalsChart = new google.visualization.PieChart(document.getElementById('totals-chart'));
      		//Draw the chart
      		totalsChart.draw(totalsData, totalsOptions);

      		//Create a new data table for the spending chart
      		var spendingData = new google.visualization.DataTable();
      		//Add two columns of data: one for committee, one for budget
      		spendingData.addColumn('string', 'Committee');
      		spendingData.addColumn('number', 'Budget');
      		//Add the data rows to the table
      		spendingData.addRows([
				['OpComm', <?php echo round(getTotal('opcomm'),2); ?>],
				['Evals', <?php echo round(getTotal('evals'),2); ?>],
				['History', <?php echo round(getTotal('history'),2); ?>],
				['Imps', <?php echo round(getTotal('imps'),2); ?>],
				['R&D', <?php echo round(getTotal('randd'),2); ?>],
				['Social', <?php echo round(getTotal('social'),2); ?>],
				['Misc', <?php echo round(getTotal('misc'),2); ?>]
      		]);
      		//Set the options for the spending chart
      		var spendingOptions = {'title':'Spending Breakdown by Committee', 'width':375, 'height':300};
      		//Create a new chart
      		var spendingChart = new google.visualization.PieChart(document.getElementById('spending-chart'));
      		//Draw the chart
      		spendingChart.draw(spendingData, spendingOptions);
    	}
	</script>
</head>
<body>
<div id="wrapper">
	<header>
		<h2>CSH Spending 2012-2013</h2>
	</header>
	<section id="charts"> 
		<div id="totals-chart" class="chart"></div>
		<div id="spending-chart" class="chart"></div>
		<br class="clear"/>
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
	<section id="totals">
		<h2>Totals</h2>
		<table>
		<tr><td><b>Starting Budget <br/>(Yearly On-Floor Dues)</b></td><td>$<?php echo YEARLY_TOTAL;?></td></tr>
		<tr><td><b>Total Donations <br/>(User Rack, Off-Floor Dues, etc.)</b></td><td>$<?php $donations = getTotal("donations"); echo $donations; ?></td></tr>
		<tr><td><b>Total Expenditures <br/>(Committees)</b></td><td>$<?php $total = getTotal(); echo $total; ?> 
		(<?php $percent = round(($total/YEARLY_TOTAL),2); echo $percent; ?>%)</td></tr>
		<tr><td><b>Remaining Budget <br/>(Dues + Donations - Expenses)</b></td><td>$<?php $remaining = YEARLY_TOTAL-$total+$donations; echo $remaining;?>
		(<?php $percent = 100 - round(($remaining/YEARLY_TOTAL),2); echo $percent;?>%)</td></tr>
		</table>
	</section>
	<section id="spending">
		<h2>Spending</h2>
		<div id="tabs">
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
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_OPCOMM))*100,2); echo $percent; ?>%
		</div>
		<div id="evals">
			<h3>Evals</h3>
			<?php echo createTable("evals"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("evals"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_EVALS))*100,2); echo $percent; ?>%
		</div>
		<div id="history">
			<h3>History</h3>
			<?php echo createTable("history"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("history"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_HISTORY))*100,2); echo $percent; ?>%
		</div>
		<div id="imps">
			<h3>Imps</h3>
			<?php echo createTable("imps"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("imps"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_IMPS))*100,2); echo $percent; ?>%
		</div>
		<div id="randd">
			<h3>R&amp;D</h3>
			<?php echo createTable("randd"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("randd"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_RANDD))*100,2); echo $percent; ?>%
		</div>
		<div id="social">
			<h3>Social</h3>
			<?php echo createTable("social"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("social"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_SOCIAL))*100,2); echo $percent; ?>%
		</div>
		<div id="misc">
			<h3>Misc</h3>
			<?php echo createTable("misc"); ?>
			<b>Total Spent: </b>$<?php $total = getTotal("misc"); echo $total; ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_MISC))*100,2); echo $percent; ?>%
		</div>
		<div id="donations">
			<h3>Donations</h3>
			<?php echo createTable("donations"); ?>
			<b>Total Donations: </b>$<?php $total = getTotal("donations"); echo $total; ?><br/>
		</div>
		</div>
	</section>
	<footer>
		<p>Made by <a href="mailto:bencentra@csh.rit.edu">Ben Centra</a>
	</footer>
</div>
</body>
</html>