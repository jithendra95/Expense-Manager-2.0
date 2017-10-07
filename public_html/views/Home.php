<?php 
session_start();
if(isset($_SESSION['login'])){
if ($_SESSION['login']!="1") {
header ("Location: index.php");
}
}else{
$_SESSION['login']="0";
header ("Location: index.php");
}
require '../../resources/config.php';
require '../../resources/config_imports.php';
require $config["paths"]["template"].'menu.php';
require $config["paths"]["model"].'get_trans_summary.php';
require 'Dashboard.php'
?>


<!DOCTYPE HTML>
<html lang='en'>

<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- *******************Main imports******************-->
<?php 
 main_imports($config); 
 date_picker_imports($config); 
 ?>


<!--
<script language="JavaScript" type = "text/javascript"  src = "JS/CreateClass.js" ></script>
<script language="JavaScript" type = "text/javascript"  src = "JS/ClassDetails.js" ></script>
-->

<style>

#mon_bal{

margin-left:5%;

}
#mon_trn{

margin-left:5%;

}

#mon_bal_row:hover{

background-color:#FFFACD;

}
#mon_trn_cr{
background-color:#DDFBAB
}
#mon_trn_cr:hover{
background-color:#03DCD8
}


#mon_trn_dr{
background-color:#FCBBAC
}
#mon_trn_dr:hover{
background-color:#03DCD8
}


.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 100%;
    border-radius: 5px;
	
}

#expense_card{
   background-color:#FF4C4C;
   width=100%;
}

#income_card{
background-color:#60C15D;
width=100%;
}

#balance_card{
background-color:#4A749A;
width=100%;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.card_img {
    border-radius: 5px 5px 0 0;
}

.dash_container {
    padding: 2px 16px;
}



</style>

<script>

function delete_transaction(trn_code){

if(confirm("Are You Sure You Want to Delete the Transaction")){
		$.ajax({

		type:'POST',
		data:{trn_code:trn_code,chk_sql:"main_trn"},
		url:"<?php echo $config["paths"]["model"]?>delete_transaction.php",
		success:function(){
		//alert(result);
		
		alert("Transaction Deleted");
		location.reload(); 
		

		//window.location.assign("");


		//check_num();
		}


     })
	} 
	// alert("Transaction Deleted");

}


$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				//Example of preserving a JavaScript event for inline calls.
				
			});
			
			

function delete_monthly_transaction(trn_code,m_type){

if(confirm("Are You Sure You Want to Delete the Transaction")){
$.ajax({

		type:'POST',
		data:{trn_code:trn_code,type:m_type,chk_sql:"monthly_trn"},
		url:"<?php echo $config["paths"]["model"]?>delete_transaction.php",
		success:function(){
		//alert(result);
		
		alert("Monthly Transaction Deleted");
		location.reload(); 
		

		//window.location.assign("");


		//check_num();
		}


     })
	 

  }
}

function post_transaction(trn_code,m_type){
   if(confirm("Are You Sure You Want to Post the Transaction")){
   
   m_chk_sql='';


		if (m_type=='CR'){
		m_chk_sql='income';

		}else if(m_type=='DR'){
		m_chk_sql='expense';
		}


$.ajax({


		type:'POST',
		data:{trn_code:trn_code,chk_sql:"monthly_trn"},
		url:"<?php echo $config["paths"]["model"]?>save_pen_trans_new.php",
		success:function(){
		//alert(result);
		
		alert("Transaction Posted Successfully");
		location.reload(); 
		

		//window.location.assign("");


		//check_num();
		}


     })
	 

  }

}


</script>

<title>Home</title>

</head>

<body>

<?php menu();?>
<div class="container-fluid">

<div  align='left'  class='row'> 
<div class='col-sm-2'> &nbsp </div>

<div class='col-sm-2'>
		<div class="card" id='expense_card' >
		 <div class="dash_container">
		 <table width='100%'>
		   <tr>
			   <td rowspan='2'>
				<img class='card_img' src="<?php echo $config["paths"]["image"]["layout"]?>/dash_expense.png" alt="Avatar" style="width:50px; height:60px">
			   </td>
			   <td align='right'>
				  <h1><?php   echo number_format($dr_previous_month,0); ?></h1> 
				  <p style="font-size:11px;">Last Month Expenses</p>
				   
			   </td>
		  </tr>
		  
		 </table>
		  </div>
		</div>
	</div>	
	
	
	<div class='col-sm-2'>
		<div class="card" id='expense_card'>
		 <div class="dash_container">
				 <table width='100%'>
				   <tr>
					   <td rowspan='2'>
						 <img class='card_img' src="<?php echo $config["paths"]["image"]["layout"]?>/dash_expense.png" alt="Avatar" style="width:50px; height:60px">
					   </td>
					   <td align='right'>
						  <h1><?php   echo number_format($dr_balance,0); ?></h1> 
						  <p style="font-size:11px;">Last 30 Days Expenses</p>
						   
					   </td>
				  </tr>
				  
				 </table>
		  </div>
		</div>
	</div>	
	
	<div class='col-sm-2'>
		<div class="card" id='income_card'>
		 <div class="dash_container">
				 <table width='100%'>
				   <tr>
					   <td rowspan='2'>
						 <img class='card_img' src="<?php echo $config["paths"]["image"]["layout"]?>/dash_income.png" alt="Avatar" style="width:50px; height:60px">
					   </td>
					   <td align='right'>
						  <h1><?php   echo number_format($cr_balance,0); ?></h1> 
						  <p style="font-size:11px;">Last 30 Days Income</p>
						   
					   </td>
				  </tr>
				  
				 </table>
		  </div>
		</div>
	</div>	
	
	<div class='col-sm-2'>
		<div class="card" id='balance_card' width='100%'>
		 <div class="dash_container" >
				 <table width='100%'>
				   <tr>
					   <td rowspan='2'>
						  <img  class='card_img' src="<?php echo $config["paths"]["image"]["layout"]?>/dash_balance.png" alt="Avatar" style="width:50px; height:60px">
					   </td>
					   <td align='right'>
						  <h1><?php   if ($closing_balance>=0){echo number_format($closing_balance,0);}else{echo '('.number_format(-1*$closing_balance,0).')';} ?></h1> 
						  <p style="font-size:11px;">Current Balance</p>
						   
					   </td>
				  </tr>
				  
				 </table>
		  </div>
		</div>
	</div>
	
	
	<div class='col-sm-2'> &nbsp </div>
	
</div>
<br/>
<div  align='left'  class='row'> 
<div class='col-sm-1'> &nbsp </div>
<!-- <div class='col-sm-4'>

<table class="table table-striped" >
    <thead>
      <tr rowspan='2' style="background-color:#B0E0E6;">
	    <th colspan='2' >Monthly Balance</th>
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
     <tr id='mon_bal_row'>
       <td>Opening Balance</td><td style="<?php echo $opening_balance_color;?>;" align='right'><?php   echo number_format($opening_balance,2); ?></td>
	 </tr>
     <tr id='mon_bal_row'>	 
	   <td>Monthly Income</td><td style="color:#32CD32;" align='right'><?php  echo number_format($cr_balance,2); ?></td>
	 </tr>
     <tr id='mon_bal_row'>	 
	   <td>Monthly Expense</td><td style="color:#DC143C;" align='right'><?php   echo number_format($dr_balance,2); ?></td>
	 </tr> 
	 <tr id='mon_bal_row'>	 
	   <td>Closing Balance</td><td style="<?php echo $closing_balance_color;?>;" align='right'><?php   echo number_format($closing_balance,2); ?></td>
	 </tr>
	 
    </tbody>
	
</table>



</div>-->

<div class='col-sm-5'><?php display_pie_chart($config); ?></div>
<div class='col-sm-4'><?php display_expense_vs_income($config); ?></div>
<div class='col-sm-2'> &nbsp </div>

</div>

<div  align='left'  class='row'> 
<div class='col-sm-1'> &nbsp </div>
<div class='col-sm-4'>
<table class="table table-striped" >
    <thead>
      <tr style="background-color:#B0E0E6;">
	   <th colspan='4'>Frequent Transactions</th>
      </tr>
	  <tr style="background-color:#69C7D6;">
	   <th>Discription</th>
	   <th colspan='3'>Amount</th>
	  
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
     <?php get_monthly_trn();?>
	 
    </tbody>
	
</table>
</div>
<div class='col-sm-1'> &nbsp </div>
<div class='col-sm-6'>

<table class="table table-striped" >
    <thead>
      <tr style="background-color:#B0E0E6;">
		 <th colspan='5'>Transactions History</th>
      </tr>
	   <tr style="background-color:#69C7D6;">
	   <th>Discription</th>
	   <th>Expense/Income</th>
	   <th>Transaction Date</th>
	   <th colspan='2'>Amount</th>
	   
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
     <?php get_trn_history();?>
	 
    </tbody>
	
</table>

</div>



</div>
</div>
</body>