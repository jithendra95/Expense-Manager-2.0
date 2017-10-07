<?php 
session_start();

if ($_SESSION['login']!="1") {
header ("Location: index.php");
}
require '../../resources/config.php';
require '../../resources/config_imports.php';
require $config["paths"]["template"].'menu.php';
require $config["paths"]["model"].'get_trans_summary.php';

$chk_sql="";
if(isset($_GET['chk_sql'])){
$chk_sql=$_GET['chk_sql'];
}else{
$chk_sql='none';
}
?>


<!DOCTYPE HTML>
<html lang='en'>

<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- *******************Main imports******************-->
<?php 
 main_imports($config); 
 
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

</style>

<script>

function delete_transaction(trn_code){


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
	 
	// alert("Transaction Deleted");

}



</script>

<title>All Transactions</title>

</head>

<body>

<div class="container-fluid">
<div  align='left'  class='row'> 




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
	
     <?php 
	 
	 if($chk_sql=='none'){
	 get_all_trn_history();
	 }else if($chk_sql=='daily_trn'){
	 get_trn_history_onDay($_GET['day'],$_GET['month'],$_GET['year'],$_GET['drcr_status']);
	 }
	 
	 
	 ?>
	 
    </tbody>
	
</table>



</div>


</div>
</body>