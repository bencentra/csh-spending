<?php
//Include constants and functions from 'lib.php'
require_once('lib.php');

//Define some variables for budget totals/percents
$total = 0;
$percent = 0;
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>CSH Spending - 2013-14</title>
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
      		var totalsOptions = {'title':'Budget Breakdown by Committee', 'width':350, 'height':250};
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
				['OpComm', <?php echo round(getTotal(OPCOMM),2); ?>],
				['Evals', <?php echo round(getTotal(EVALS),2); ?>],
				['History', <?php echo round(getTotal(HISTORY),2); ?>],
				['Imps', <?php echo round(getTotal(IMPS),2); ?>],
				['R&D', <?php echo round(getTotal(RANDD),2); ?>],
				['Social', <?php echo round(getTotal(SOCIAL),2); ?>],
				['Misc', <?php echo round(getTotal(MISC),2); ?>]
      		]);
      		//Set the options for the spending chart
      		var spendingOptions = {'title':'Spending Breakdown by Committee', 'width':350, 'height':250};
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
		<h2>CSH Spending 2013-14</h2>
		<p><i>Misappropriating funds and marginalizing profits since 1976!</i></p>
	</header>
	<section id="charts"> 
		<div id="totals-chart" class="chart"></div>
		<div id="spending-chart" class="chart"></div>
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
			<li><a href="#totals">Totals</a>
		</ul>
		<div id="opcomm">
			<h3>OpComm</h3>
			<?php echo createTable(OPCOMM); ?>
			<b>Total Spent: </b>$<?php $total = getTotal(OPCOMM); echo $total; ?><br/>
			<b>Total Allotted: </b>$<?php echo round(YEARLY_TOTAL*BUDGET_OPCOMM, 2); ?><br>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_OPCOMM))*100,2); echo $percent; ?>%
		</div>
		<div id="evals">
			<h3>Evals</h3>
			<?php echo createTable(EVALS); ?>
			<b>Total Spent: </b>$<?php $total = getTotal(EVALS); echo $total; ?><br/>
			<b>Total Allotted: </b>$<?php echo round(YEARLY_TOTAL*BUDGET_EVALS, 2); ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_EVALS))*100,2); echo $percent; ?>%
		</div>
		<div id="history">
			<h3>History</h3>
			<?php echo createTable(HISTORY); ?>
			<b>Total Spent: </b>$<?php $total = getTotal(HISTORY); echo $total; ?><br/>
			<b>Total Allotted: </b>$<?php echo round(YEARLY_TOTAL*BUDGET_HISTORY, 2); ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_HISTORY))*100,2); echo $percent; ?>%
		</div>
		<div id="imps">
			<h3>Imps</h3>
			<?php echo createTable(IMPS); ?>
			<b>Total Spent: </b>$<?php $total = getTotal(IMPS); echo $total; ?><br/>
			<b>Total Allotted: </b>$<?php echo round(YEARLY_TOTAL*BUDGET_IMPS, 2); ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_IMPS))*100,2); echo $percent; ?>%
		</div>
		<div id="randd">
			<h3>R&amp;D</h3>
			<?php echo createTable(RANDD); ?>
			<b>Total Spent: </b>$<?php $total = getTotal(RANDD); echo $total; ?><br/>
			<b>Total Allotted: </b>$<?php echo round(YEARLY_TOTAL*BUDGET_RANDD, 2); ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_RANDD))*100,2); echo $percent; ?>%
		</div>
		<div id="social">
			<h3>Social</h3>
			<?php echo createTable(SOCIAL); ?>
			<b>Total Spent: </b>$<?php $total = getTotal(SOCIAL); echo $total; ?><br/>
			<b>Total Allotted: </b>$<?php echo round(YEARLY_TOTAL*BUDGET_SOCIAL, 2); ?><br/>
			<b>Percentage Spent: </b><?php $percent = round(($total/(YEARLY_TOTAL*BUDGET_SOCIAL))*100,2); echo $percent; ?>%
		</div>
		<div id="misc">
			<h3>Misc</h3>
			<?php echo createTable(ACCUM); ?>
			<b>Total Spent: </b>$<?php $total = getTotal(ACCUM); echo $total; ?><br/>
		</div>
		<div id="donations">
			<h3>Donations</h3>
			<?php echo createTable(DONATIONS); ?>
			<b>Total Donations: </b>$<?php $total = getTotal(DONATIONS); echo $total; ?><br/>
		</div>
		<div id="totals">
			<h3>Totals</h3>
			<table>
			<tr><td><b>Starting Budget (Yearly On-Floor Dues)</b></td><td>$<?php echo YEARLY_TOTAL;?></td></tr>
			<tr><td><b>Total Donations (User Rack, Off-Floor Dues, etc.)</b></td><td>$<?php $donations = getTotal(DONATIONS); echo $donations; ?></td></tr>
			<tr><td><b>Total Expenditures (Committees)</b></td><td>$<?php $total = getTotal(); echo $total; ?> 
			</td></tr>
			<tr><td><b>Remaining Budget (Dues + Donations - Expenses)</b></td><td>$<?php $remaining = YEARLY_TOTAL-$total+$donations; echo $remaining;?>
			</td></tr>
			</table>
		</div>
		</div>
	</section>
	<footer>
		<p>Made by <a href="mailto:bencentra@csh.rit.edu">Ben Centra</a>
	</footer>
</div>
</body>
</html>
