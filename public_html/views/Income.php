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


function mon_date_change()
{
data='<br/>';
data+="<div  class='col-sm-2' >Transaction Day *</div>";
data+="<div class='col-sm-10' >";

data+="<div class=\"form-group\">"
data+="<select class='form-control' name='trn_day' style='width:100px'>";
for(i=1;i<=28;i++){
data+="<option value="+i+">"+i+"</option>";
}
data+="</select></div>";
data+="</div>";
data2='<br/>';
data2+="<div  class='col-sm-2' >Value Date *</div>";
data2+="<div class='col-sm-10' >";

data2+="<input type='text' name='trn_day' id='trn_day' class='input_field' placeholder='YYYY-MM-DD'>";
data+="</div>";

//data+='</span></div> </div>';
inm_type_val=document.form1.inc_type.value;
if(inm_type_val=='month'){
//document.getElementById('mon_date_div').innerHTML=data;
//alert('mon');
}else if(inm_type_val=='day'){

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
	 
	 
	/* function load_pending_trn(){
	 
	 $(".loader").css('display','block');
		
	 $.ajax({
   
	type:'POST',
	data:{chk_sql:"income"},
	url:"<?php echo $config["paths"]["model"]?>get_trans_details.php",
	success:function(result){
	//alert(result);
	//alert('Completed');
	//window.location.assign("");
	document.getElementById("mon_pend_inc").innerHTML=result;
	 $(".loader").css('display','none');
    }
     })
	 }*///This section No Longer in income screen
	 
	 
	
	 
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
</script>

<title>Income</title>

</head>

<body >
<?php menu();?>

<form name='form1'>

<div class="container-fluid">

<fieldset>
<legend>Income Entry</legend>
<div  align='left'  class='row'> 
<br/>
<div class='col-sm-2'>Amount Earned *</div>
<div class='col-sm-8'><input type='text' class='input_field'  name='amount_txt' width='100px' >&nbsp
<button type='submit'  id='submit_button' name='submit_btn'   onclick='' > Submit </button>
</div>

</div>

<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Income Discription *</div>
<div class='col-sm-10' ><input type='text' class='input_field'  name='desc_txt' ></div>
</div>

<div height='60px' align='left' class='row'> 
<br/>
<div  class='col-sm-2' >Income Type *</div>
   <div class='col-sm-10 ' >
         <div class="form-group">
			  <select class="form-control" onchange='mon_date_change()' name='inc_type' style="width:200px">
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

<!--  This Section No Longer in Income Screen,Moved to Home Screen
<form name='form2' action='<?php echo $config["paths"]["model"]?>save_pen_trans.php' method='POST'>

<input type="HIDDEN" value="income" name='chk_sql'>

<fieldset>
<legend>Pending Monthy Income </legend>

 <table class="table table-striped">
    <thead>
      <tr style="background-color:#B0E0E6;">
	    <th>No.</th>
        <th>Transaction Discription</th>
        <th>Amount</th>
        <th>Check</th>
      </tr>
    </thead>
	
	<tbody id='mon_pend_inc'>
	
    

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