<?php 
session_start();

if ($_SESSION['login']!="1") {
header ("Location: index.php");
}

require '../../resources/config.php';
require '../../resources/config_imports.php';
require $config["paths"]["template"].'menu.php';
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

.loader{
margin-left:43%;
}

body{
margin-left:50px;
}

</style>


<script>




function submit_data(){


amount=document.form1.amount_txt.value;
trn_desc=document.form1.desc_txt.value;
//trn_date="none";
trn_type=document.form1.inc_type.value;

if(trn_type=='day'){
trn_date=document.form1.trn_day.value;
}else{
trn_date=1;
}


//trn_date=document.form1.trn_day.value;
document.getElementById("submit_button").innerHTML='<i class="fa fa-spinner fa-spin"></i>&nbsp  Saving ';
 
 
$.ajax({

type:'POST',
data:{amount:amount,trn_desc:trn_desc,trn_date:trn_date,trn_type:trn_type,chk_sql:"income"},
url:"<?php echo $config["paths"]["model"]?>save_transaction.php",
success:function(){
//alert(result);
document.getElementById("submit_button").innerHTML='Submit ';
alert('Income Saved Sucessfully');

clear_data();
//load_pending_trn();

//window.location.assign("");


//check_num();
}


     })
	 
	 
	 }
	 

	 
	
	 
	 function clear_data(){
	 document.form1.amount_txt.value="";
     document.form1.desc_txt.value="";
     document.form1.inc_type.value="";
	 
	 mon_date_change();
	 }
	 
	 
	 
	 $(function() {
		  // Initialize form validation on the registration form.
		  // It has the name attribute "formEmployee"
		  $("form[name='form1']").validate({
			// Specify validation rules
			rules: {
			  // The key name on the left side is the name attribute
			  // of an input field. Validation rules are defined
			  // on the right side
			  amount_txt:  {required:true,number:true},
			  desc_txt: {required:true},
			  inc_type:{required:true}
			  /*
			  emp_leave_band:"required"*/
			  
			},
			// Specify validation error messages
			messages: {
			  inc_type: "Please Select Income Type"
			  /*emp_leave_band:"Please Select Leave Band"*/
			 
			},
			tooltip_options: {
			  amount_txt: {trigger:'focus,placement:top'},
			  desc_txt:{trigger:'focus',placement:'right'},
			  inc_type:{trigger:'focus',placement:'right'}
			   },
			// Make sure the form is submitted to the destination defined
			// in the "action" attribute of the form when valid
			submitHandler: function(form) {
			 submit_data();
		       
			}
		  });
		});
		
		
function run_report(){
rep_month=document.Form1.rep_month.value;
rep_year=document.Form1.rep_year.value;
rep_type=document.Form1.rep_type.value;
//alert(start_date);
m_url="Report_View.php?rep_month="+rep_month+"&rep_year="+rep_year+"&rep_type="+rep_type;
window.open(m_url);

 }
</script>

<title>MyExpense-Reports</title>

</head>

<body >
<?php menu();?>

<div class="container">
<form name='Form1'>

<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-6">&nbsp </div>
  <div class="col-sm-2"></div>
</div>


<div class="row">
   <div class="col-sm-2"><b>Month * </b></div>
    
    <div class="col-sm-3">
			  <select class="form-control" id="rep_month" name='rep_month' style="width:150px">
				<option value='1'>January</option>
				<option value='2'>February</option>
				<option value='3'>March</option>
				<option value='4'>April</option>
				<option value='5'>May</option>
				<option value='6'>June</option>
				<option value='7'>July</option>
				<option value='8'>August</option>
				<option value='9'>September</option>
				<option value='10'>October</option>
				<option value='11'>November</option>
				<option value='12'>December</option>
			  </select>
   </div>
  <div class="col-sm-1"><b>Year * </b></div>
  <div class="col-sm-2">
      <select class="form-control" id="rep_year" name='rep_year' style="width:100px">
				<?php
				echo '<option value='.date("Y",strtotime('-1 years')) .'>'.date("Y",strtotime('-1 years')) .'</option>';
				echo '<option value='.date("Y").' selected>'.date("Y").'</option>';
				echo '<option value='.date("Y",strtotime('-1 years')) .'>'.date("Y",strtotime('+1 years')) .'</option>';
				?>
			  </select>
  </div>
  <div class="col-sm-2"><input type='button' id='submit_button' value='View Report' onclick='run_report()'></div>
</div>

</br>
<div class="row">
   <div class="col-sm-2"><b>Report Type * </b></div>
   <div class="col-sm-3">
   
   <select class="form-control" id="rep_type" name='rep_type' style="width:200px">
				<option value='calandar_report'>Transaction -Calender</option>
			    <option value='all_report'> All Transactions</option>
				<option value='expense_report'> All Expenses</option>
				<option value='income_report'> All Income</option>
				<option value='breakup_report' disabled> Expense Break Up</option>
	</select>
   
    </div>
     <div class="col-sm-7"><b>&nbsp </b></div>
 </div>
   </form>
</div>
</body>
</html>