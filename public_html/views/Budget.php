<?php 
session_start();

if ($_SESSION['login']!="1") {
header ("Location: index.php");
}
$acc_bal=0.00;
$bal_status="";


require '../../resources/config.php';
require '../../resources/config_imports.php';
require  $config["paths"]["model"].'connection_new.php';
require $config["paths"]["template"].'menu.php';


$get_acc_bal="SELECT BALANCE FROM opening_balance WHERE USER_ID='".$_SESSION['user']."'";

	$result=mysqli_query($conect,$get_acc_bal);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{

if($row=mysqli_fetch_array($result)){
		 $acc_bal=$row["0"]; 
		 $bal_status="update";
	 }else{
	   $bal_status="insert";
	 }
	 
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
 date_picker_imports($config);
 ?>

<!--link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.datepick.css"> 
<script src="jquery.plugin.js"></script>
<script src="http://keith-wood.name/js/jquery.datepick.js"></script-->



<!--
<script language="JavaScript" type = "text/javascript"  src = "JS/CreateClass.js" ></script>
<script language="JavaScript" type = "text/javascript"  src = "JS/ClassDetails.js" ></script>
-->
<style>

#mon_pend_inc_row{

background-color:#F0F8FF;

}

#mon_pend_inc_row:hover{

background-color:#FFFACD;

}

body{
margin-left:50px;
}

</style>



<script>

//$("#start_date").$datepicker();	


$(function() {
	$("#start_date,#end_date").datepick({dateFormat: 'dd-mm-yyyy'});
});

function submit_data(){
bud_amount=document.form1.amount_txt.value;
trn_desc=document.form1.desc_txt.value;
trn_date="none";
trn_type=document.form1.inc_type.value;

if(trn_type=="month"){
trn_date=document.form1.trn_day.value;
}
$.ajax({

type:'POST',
data:{bud_amount:bud_amount,trn_desc:trn_desc,trn_date:trn_date,trn_type:trn_type,chk_sql:"income"},
url:"<?php echo $config["paths"]["model"]?>save_transaction.php",
success:function(){
//alert(result);
alert('Income Save Sucessfully');
clear_data();
load_pending_trn();
//window.location.assign("");


//check_num();
}


     })
	 
	 
	 }
	 
	 function acc_submit_data(){
bal_amount=document.form1.acc_balance.value;
bal_status=document.form1.hid_bal_stat.value;
//trn_type=document.form1.inc_type.value;


$.ajax({

type:'POST',
data:{acc_balance:bal_amount,trn_type:bal_status,chk_sql:"acc_bal"},
url:"<?php echo $config["paths"]["model"]?>save_transaction.php",
success:function(){
//alert(result);
alert('Account Balance Saved Sucessfully');
clear_data();
//window.location.assign("");


//check_num();
}


     })
	 
	 
	 }
	 
	 
	 
	 function clear_data(){
	 document.form1.amount_txt.value="";
     //document.form1.acc_balance.value="";
     
	 
	 
	 }
</script>

<title>Budget</title>

</head>

<body onload=''>
<?php menu();?>

<form name='form1'>

<div class="container-fluid">

<fieldset>
<legend>Budgeting</legend>
<div  align='left'  class='row'> 
<br/>
<div class='col-sm-2'>Expense Budget</div>
<div class='col-sm-8'><input type='text' class='input_field'  name='amount_txt' width='100px' >&nbsp
<input type='button'  id='submit_button_long' name='submit_btn' width='100px' value='Save Budget' onclick='submit_data()' >
</div>
</div>

<div  align='left'  class='row'> 
<br/>
<div class='col-sm-2'>Budget Start</div>
<div class='col-sm-2'><input type='text' class='input_field'  name='start_date' id='start_date' width='100px' ></div>
<div class='col-sm-2'>Budget End</div>
<div class='col-sm-2'><input type='text' class='input_field'  name='end_date' id='end_date'  width='100px' ></div>
<div class='col-sm-4'>&nbsp</div>
</div>

<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Account Balance</div>
<div class='col-sm-10' ><input type='text' class='input_field'  name='acc_balance' value='<?php echo number_format($acc_bal,2);?>' >
<input type='hidden' name='hid_bal_stat' value='<?php echo $bal_status;?>'>
<input type='button'  id='submit_button_long'  name='acc_submit_btn' width='100px' value='Set Account Balance' onclick='acc_submit_data()' >
</div>
</div>




</div>


</fieldset>
<!--/table-->



<br/>
<br/>
<br/>

</form>



</div>

</body>
</html>