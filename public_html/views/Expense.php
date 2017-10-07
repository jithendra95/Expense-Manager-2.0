<?php 
session_start();

if ($_SESSION['login']!="1") {
header ("Location: index.php");
}

require '../../resources/config.php';
require '../../resources/config_imports.php';
require $config["paths"]["template"].'menu.php';
?>
<?php
function display_exp_type(){

require '../../resources/config.php';
require  $config["paths"]["model"].'connection_new.php';

$result=mysqli_query($conect,"SELECT EXP_TYPE_CODE,EXP_TYPE_DESC 
					FROM expense_type ");


if (!$result) {
   die('Invalid query: ' . mysql_error());
}else{
while($row=mysqli_fetch_array($result)){
      echo "<option value='".$row["EXP_TYPE_CODE"]."'>".$row["EXP_TYPE_DESC"]."</option>";
	 }
	
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

function mon_date_change()
{
data='<br/>';
data+="<div  class='col-sm-2' >Transaction Day *</div>";
data+="<div class='col-sm-10' >";

data+='<div class="form-group">';
data+="<select class='form-control' name='trn_day' style='width:100px'>";
for(i=1;i<=28;i++){
data+="<option value="+i+">"+i+"</option>";
}
data+="</select></div>";

data2='<br/>';
data2+="<div  class='col-sm-2' >Value Date *</div>";
data2+="<div class='col-sm-10' >";

data2+="<input type='text' name='trn_day' id='trn_day' class='input_field' placeholder='YYYY-MM-DD'>";
data+="</div>";

//data+='</span></div> </div>';
exp_type_val=document.form1.exp_type.value;
if(exp_type_val=='month'){
//document.getElementById('mon_date_div').innerHTML=data;
//alert('mon');
}else if(exp_type_val=='day'){

document.getElementById('mon_date_div').innerHTML=data2;
$("#trn_day").datepick({dateFormat: 'yyyy-mm-dd'});

//alert('Test');
}else{
document.getElementById('mon_date_div').innerHTML='';
}

}



function submit_data(){
amount=document.form1.amount_txt.value;
trn_desc=document.form1.desc_txt.value;
//trn_date="none";
trn_type=document.form1.exp_type.value;
trn_nature=document.form1.exp_nature.value;
payee_desc=document.form1.payee_desc.value;

if(trn_type=='day'){
trn_date=document.form1.trn_day.value;
}else{
trn_date=1;
}

document.getElementById("submit_button").innerHTML='<i class="fa fa-spinner fa-spin"></i>&nbsp  Saving ';

 

$.ajax({

type:'POST',
data:{amount:amount,trn_desc:trn_desc,trn_date:trn_date,trn_type:trn_type,trn_nature:trn_nature,payee_desc:payee_desc,chk_sql:"expense"},
url:"<?php echo $config["paths"]["model"]?>save_transaction.php",
success:function(){
//alert(result);
document.getElementById("submit_button").innerHTML='Submit ';
alert('Expense Saved Sucessfully');
 
clear_data();
//load_pending_trn();

//window.location.assign("");


//check_num();
}


     })
	 
	 
	 }

	 
	/* function load_pending_trn(){
	 data=" <tr id='mon_pend_exp'> ";
	 data+= "<td>1</td>";
     data+= " <td>Tetster</td>";
     data+= " <td>1500.00</td>";
     data+= " <td><input type='checkbox' value='1'></td>";
     data+=" </tr>"; 
	
	 
	 $(".loader").css('display','block');
	 
	 $.ajax({

	type:'POST',
	data:{chk_sql:"expense"},
	url:'<?php echo $config["paths"]["model"]?>get_trans_details.php',
	success:function(result){
	//alert(result);
	//alert('Completed');
	//window.location.assign("");
	document.getElementById("mon_pend_exp").innerHTML=result;
	$(".loader").css('display','none');
    }
     })
	 
	 
	 
	 }*///This section No Longer in expense screen
	 
	 function clear_data(){
	 document.form1.amount_txt.value="";
     document.form1.desc_txt.value="";
	  document.form1.payee_desc.value="";
     document.form1.exp_type.value="";
	 document.form1.exp_nature.value="";
	 
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
			  exp_type:{required:true},
			  exp_nature:{required:true}
			  /*
			  emp_leave_band:"required"*/
			  
			},
			// Specify validation error messages
			messages: {
			  inc_type: "Please Select Expense Type",
			  exp_nature: "Please Select Nature of Expense"
			  /*emp_leave_band:"Please Select Leave Band"*/
			 
			},
			tooltip_options: {
			  amount_txt: {trigger:'focus,placement:top'},
			  desc_txt:{trigger:'focus',placement:'right'},
			  exp_type:{trigger:'focus',placement:'right'},
			  exp_nature:{trigger:'focus',placement:'right'}
			   },
			// Make sure the form is submitted to the destination defined
			// in the "action" attribute of the form when valid
			submitHandler: function(form) {
			 submit_data();
		       
			}
		  });
		});
		
		
		
		
		
</script>

<title>Expense</title>

</head>

<body >
<?php menu();?>

<form name='form1'>

<div class="container-fluid">

<fieldset>
<legend>Expense Entry</legend>
<div  align='left'  class='row'> 
<br/>
<div class='col-sm-2'>Amount Spent *</div>
<div class='col-sm-8'><input type='text' class='input_field'  name='amount_txt' width='100px' >&nbsp
<button   type='submit'  id='submit_button' name='submit_btn'   onclick='' >Submit</button>
</div>

</div>

<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Nature of Expense  *</div>
<div class='col-sm-10' >

<div class='form-group'>
<select class='form-control'onchange='' name='exp_nature' style='width:300px'>
<option value=''>----Please Select-----</option>
<?php display_exp_type();?>
</select>
</div>
</div>
</div>


<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Expense Discription *</div>
<div class='col-sm-10' ><input type='text' class='input_field'  name='desc_txt' ></div>
</div>

<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Payee Discription </div>
<div class='col-sm-10' ><input type='text' class='input_field'  name='payee_desc' ></div>
</div>

<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Expense Type *</div>
<div class='col-sm-10' >
<div class='form-group'>
		<select class='form-control' onchange='mon_date_change()' name='exp_type' style='width:200px'>
		<option value=''>----Please Select-----</option>
		<option value='day'>One Time</option>
		<option value='month'>Frequent</option>
		</select>
</div>
</div>
</div>


<div height='60px' align='left' class='row' id='mon_date_div'> 
</div>


</fieldset>
<!--/table-->



<br/>
<br/>
<br/>

</form>
<!--  This Section No Longer in Expense Screen,Moved to Home Screen

<form name='form2' action='<?php echo $config["paths"]["model"]?>save_pen_trans.php' method='POST'>

<input type="HIDDEN" value="expense" name='chk_sql'>

<fieldset>
<legend>Pending Monthy Expense </legend>

 <table class="table table-striped">
    <thead>
      <tr style="background-color:#B0E0E6;">
	    <th>No.</th>
        <th>Transaction Discription</th>
        <th>Amount</th>
        <th>Check</th>
      </tr>
    </thead>
	
	<tbody id='mon_pend_exp'>
	
    

	 </tr>
	 
    </tbody>
	
</table>
</fieldset>





</form>

</div>


  <div class="loader"></div>
-->

</body>
</html>