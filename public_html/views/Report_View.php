<?php 
session_start();

if ($_SESSION['login']!="1") {
header ("Location: index.php");
}

require '../../resources/config.php';
require '../../resources/config_imports.php';
require $config["paths"]["template"].'menu.php';
?>


<head>
 <!-- *******************Main imports******************-->
<?php 
 main_imports($config); 
 date_picker_imports($config);
 ?>

<title>Reports</title>
</head>


<?php 

if(isset($_GET['rep_type'])){
    $rep_type      =$_GET['rep_type'];
	$rep_month     =$_GET['rep_month'];
    $rep_year      =$_GET['rep_year'];
}

if($rep_type=="calandar_report"){
//require 'Reports/calandar_report.php';
require $config["paths"]["model"].'report_handler.php';
   ?>
	<script>
	
	$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				//Example of preserving a JavaScript event for inline calls.
				
			});
			
			
	</script>	
   <div align='center'>
   <h3>Transaction Calender</h3>
   <h4><?php echo date("F", mktime(0, 0, 0, $rep_month, 15)).'  '.$rep_year?><h2>
   </div>
		 
	 <div align='center'>	
	 <?php echo draw_calendar($rep_month,$rep_year);
	  }

	?>
</div>

<?php
if($rep_type=="all_report"){
require $config["paths"]["model"].'report_handler.php';
   ?>
		
   <div align='center'>
   <h3>All Transactions</h3>
   <h4><?php echo date("F", mktime(0, 0, 0, $rep_month, 15)).'  '.$rep_year?><h2>
   </div>
		 
	 <div align='center'>	<?php  print_all_transaction_report($rep_month,$rep_year);
	}

	?>
</div>


<?php
if($rep_type=="expense_report"){
require $config["paths"]["model"].'report_handler.php';
   ?>
		
   <div align='center'>
   <h3>Expense Transactions</h3>
   <h4><?php echo date("F", mktime(0, 0, 0, $rep_month, 15)).'  '.$rep_year?><h2>
   </div>
		 
	 <div align='center'>	<?php  print_exp_transaction_report($rep_month,$rep_year);
	}

	?>
</div>


<?php
if($rep_type=="income_report"){
require $config["paths"]["model"].'report_handler.php';
   ?>
		
   <div align='center'>
   <h3>Income Transactions</h3>
   <h4><?php echo date("F", mktime(0, 0, 0, $rep_month, 15)).'  '.$rep_year?><h2>
   </div>
		 
	 <div align='center'>	<?php  print_inc_transaction_report($rep_month,$rep_year);
	}

	?>
</div>