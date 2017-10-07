<?php 
session_start();
require '../../resources/config.php';
require '../../resources/config_imports.php';
if(isset($_SESSION['login'])){
if ($_SESSION['login']=="1") {
header ("Location: Home.php");
}}
?>


<!DOCTYPE HTML>
<html lang='en'>

<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- *******************Main imports******************-->
<?php 
 main_imports($config); ?>

<style>
#sign_up_button{

background-color:#00ff00;
margin-left:-10px;
color:#000;
width: 120px;
height: 50px;
font-family: 'Ubuntu', 'Lato', sans-serif;
border-radius: 5px;



}

#sign_up_button:hover{
background-color:#7fff00;
color:#ffffff;
}

#cancel_button{

background-color:#dc143c;
margin-left:60px;
color:#000;
width: 120px;
height: 50px;
font-family: 'Ubuntu', 'Lato', sans-serif;
border-radius: 5px;


}

#cancel_button:hover{
background-color:#ff0000;
color:#ffffff;
}


#log_tab{

background-color:#FFFFFF;
width:420px;
border-radius: 5px;
align:center;
}

#sign_section{
margin-top:10%;
}

.loading_img{
margin-left:43%;
}

.sign_up_field {
    background: #c0c0c0;
    background: -moz-linear-gradient(#c0c0c0, #dcdcdc);
    background: -ms-linear-gradient(#c0c0c0, #dcdcdc);
    background: -o-linear-gradient(#c0c0c0, #dcdcdc);
    background: -webkit-gradient(linear, 0 0, 0 100%, from(#c0c0c0), to(#dcdcdc));
    background: -webkit-linear-gradient(#c0c0c0, #dcdcdc);
    background: linear-gradient(#c0c0c0, #dcdcdc);
    border: 1px solid #dcdcdc;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.1);
    border-radius: 5px;
    font-family: 'Ubuntu', 'Lato', sans-serif;
    color: #FFF;
    width: 270px;
    height: 50px;
	padding:8px;
	
}

.sign_up_field:focus {
    box-shadow: inset 0 0 2px #000;
    background: #A9A9A9;
    border-color: #c0c0c0;
    outline: none;
}

.sign_up_field:disabled {
    box-shadow: inset 0 0 2px #000;
    background: #696969;
    border-color: #c0c0c0;
    outline: none;
}




</style>

<script>


$(document).ready(function(){
$("#cancel_button").click(function(){
location.reload();

})
});






 $(function() {
		  // Initialize form validation on the registration form.
		  // It has the name attribute "formEmployee"
		  $("form[name='login']").validate({
			// Specify validation rules
			rules: {
			  // The key name on the left side is the name attribute
			  // of an input field. Validation rules are defined
			  // on the right side
			  name:  {required:true},
			  user: {required:true,email:true},
			  pass:{required:true},
			  repass:{required:true}
			  /*
			  emp_leave_band:"required"*/
			  
			},
			// Specify validation error messages
			messages: {
			  
			  /*emp_leave_band:"Please Select Leave Band"*/
			 
			},
			tooltip_options: {
			  name: {trigger:'focus,placement:top'},
			  user:{trigger:'focus',placement:'right'},
			  pass:{trigger:'focus',placement:'right'},
			  repass:{trigger:'focus',placement:'right'}
			   },
			// Make sure the form is submitted to the destination defined
			// in the "action" attribute of the form when valid
			 submitHandler: function(form) {
			 document.getElementById("sign_up_button").innerHTML='<i class="fa fa-spinner fa-spin"></i>&nbsp  Signing... ';

			 document.login.action='<?php echo $config["paths"]["model"]?>User_creation.php';
	         form.submit();
		       
			}
		  });
		});




</script>

<title>Expense Manager-Registration</title>

</head>

<body >
<form  method="POST" name='login' ">
<div class="container-fluid">
<div class="row" id='sign_section'>
  <div class="col-sm-4"></div>
  <div class="col-sm-8"  id='log_tab'>
  
<!--table   class='log_tab' -->

<div height='60px' align='center' class='row'> 
<div class='col-*-*' ><h3 color='#000' ><b>Registration</b></h3></div>
</div>

<div height='60px' align='center' class='row'> 
<br/>
<div class='col-*-*'><input type='text' class='sign_up_field'  name='name' placeholder='Name' ></div>
</div>

<div height='60px' align='center' class='row'> 
<br/>
<div class='col-*-*'><input type='text' class='sign_up_field'  name='user' placeholder='Email' ></div>
</div>

<br/>

<div height='60px' align='center' class='row'> 
<div class='col-*-*'><input type='password' class='sign_up_field'  name='pass' placeholder='Password' ></div>
</div>
<br/>

<div height='60px' align='center' class='row'> 
<div class='col-*-*'><input type='password' class='sign_up_field'  name='repass' placeholder='Re-Type Password' ></div>
</div>
<br/>


<div height='60px' align='center' class='row'> 

<div class='col-sm-6'><input type='button' value='Cancel' id='cancel_button'  ></div>
<div class='col-sm-6'><button type='submit' value='' id='sign_up_button'  >Sign Up</button></div>

</div>


<br/>




<!--/table-->
</div>

</div>
</div>
</form>




</body>