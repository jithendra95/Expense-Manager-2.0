<?php 
session_start();

require '../../resources/config.php';
require '../../resources/config_imports.php';
require $config["paths"]["model"].'password_encryption.php';
require $config["paths"]["model"].'connection_new.php';
//$conect=connection();
if(isset($_SESSION['login'])){
if ($_SESSION['login']=="1") {
header ("Location: Home.php");
}else{$_SESSION['login_msg']="Invalid";}
}else{$_SESSION['login_msg']="";}
/*
require  'PHP/connection_new.php';
$sql="select * from user";
$result=mysqli_query($conect,$sql);
while ($row=mysqli_fetch_array($result)){

echo $row['USER_ID'] .'		'.$row['USER_NAME'].'		'.$row['PASSWORD'].'<BR/>';
}


$sql="select * from main_trn order by TRN_DATE";
$result=mysqli_query($conect,$sql);
while ($row=mysqli_fetch_array($result)){

echo $row['1'] .'		'.$row['2'].'		'.$row['5'].'<BR/>';
}*/
/*$hashPass=generateHash_sha1('abc123');
echo $hashPass;*/

if($_SERVER["REQUEST_METHOD"] == "POST") {
/*require  'PHP/connection_new.php';
$hashPass=generateHash_sha1('abc123');
$sql="UPDATE user SET PASSWORD ='".$hashPass."' where USER_ID='0000000003' or USER_NAME='dismanthidissanaya@gmail.com' ";
$result=mysqli_query($conect,$sql);*/
/*
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}*/

$result=mysqli_query($conect,"SELECT USER_NAME,PASSWORD,USER_ID,(SELECT IMG_PATH FROM profile_image WHERE IMG_ID=user.IMG_ID) IMG_PATH FROM `user` where (USER_NAME='".$_POST["user"]."'OR USER_EMAIL ='".$_POST["user"]."') AND ACTIVE_STATUS='Y' ");
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}
 if(isset(  $_POST["user"])&& isset( $_POST["pass"])  )
{

if($row=mysqli_fetch_array($result)){

  if(verify_sha1($_POST["pass"],$row["PASSWORD"])){
  
  $_SESSION['user']=$row["USER_ID"];
  $_SESSION['user_name']=$row["USER_NAME"];
  $_SESSION['login']="1";
  
  $cookie_name = "user";
  $cookie_value = $row["USER_NAME"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
setcookie('image_url', $row["IMG_PATH"] , time() + (86400 * 30), "/");

  header("Location: Home.php");
  
}
else{
//$error=$_POST["pass"]."			".$row["PASSWORD"];
$error="Invalid Username or Password ";
}


}else{
$error="Invalid Username or Password ";
//header("Location: Index.php");
}

}else{

$_SESSION['login']="0";
//header("Location: Index.php");
$error="Invalid Username or Password";
}



mysqli_close($conect);}
?>


<!DOCTYPE HTML>
<html lang='en'>

<head>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-signin-client_id" content="361515016237-7g0akg1rfta6ivgv1bplb8gf18s1uikq.apps.googleusercontent.com">


<!-- *******************Main imports******************-->
<?php 
 main_imports($config);
?>
<link rel="stylesheet" href="<?php echo $config["paths"]["css"].'menu_style.css'?>" >
<!--
<script language="JavaScript" type = "text/javascript"  src = "JS/CreateClass.js" ></script>
<script language="JavaScript" type = "text/javascript"  src = "JS/ClassDetails.js" ></script>
-->

<style>
/*
#login_button{

background-color:#4169E1;
color:#fff;
width: 270px;
height: 30px;
font-family: 'Ubuntu', 'Lato', sans-serif;
border-radius: 5px;


}

#login_button:hover{
background-color:#6495ED;
}
*/


#log_tab{

background-color:#2F4F4F;
width:420px;
border-radius: 5px;
align:center;
}
#login_section{
margin-top:15%;


}

.loading_img{
margin-left:43%;
}





</style>

<script>
/*
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  alert('Name: ' + profile.getName());
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}


function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
*/
$(document).ready(function(){

$(".input").focus(function(){
})
});

$(document).ready(function(){

$(".input").blur(function(){
})
});

$(document).ready(function(){
$("#login_button").click(function(){
//$(".loading_img").css('display','block');
 document.getElementById("login_button").innerHTML='<i class="fa fa-spinner fa-spin"></i>&nbsp  Loading ';
 document.getElementById("login_form").submit();
 //document.getElementById("login_button").disabled='true';
})

});


function switch_user(){



$.ajax({


		type:'POST',
		data:{chk_sql:"switch"},
		url:"<?php echo $config["paths"]["model"]?>Log_out.php",
		success:function(){
		//alert(result);
		
		alert("Switch User");
		location.reload(); 
		

		//window.location.assign("");


		//check_num();
		}


     })
	 
	 
}


function register_user(){

window.location.assign('Sign_In.php');
}



</script>

<title>Expense Manager-Login</title>

</head>

<body >

<form action="" method="POST" name='login' id='login_form' ">
<!--div class="container-fluid">
<div class="row" id='login_section'>
  <div class="col-sm-4"></div>
  <div class="col-sm-8"  id='log_tab'>
  

<div height='60px' align='center' class='row'> 
<div class='col-*-*' ><h3 color='#fff' class='header'><b>Sign In</b></h3></div>
</div>


<div height='60px' align='center' class='row'> 
<br/>
<div class='col-*-*'><input type='text' class='log_input_field'  name='user' placeholder='Email' ></div>
</div>

<br/>

<div height='60px' align='center' class='row'> 
<div class='col-*-*'><input type='password' class='log_input_field'  name='pass' placeholder='Password' ></div>
</div>
<br/>
<div style = "font-size:12px; color:#cc0000; margin-left:115px;"><?php if($_SERVER["REQUEST_METHOD"] == "POST"){echo $error;}?></div>
<br/>
<div height='60px' align='center' class='row'> 
<div class='col-*-*'><button type='submit' value='' id='login_button'  > Login </button></div>
<br/>
</div>






<div height='60px' align='center' class='row'> 
<div class='col-sm-6'>
  <a class='link' href="Sign_In.php" >Register</a>
</div>

<div class='col-sm-6'>
  <a class='link' ohref="#">Forgot Password?</a>
</div>
</div>

<br/>




</div-->

<div class="container">
  <div class="profile--open">
  
  
    <button class="profile__avatar" id="toggleProfile">
	<?php  if(isset($_COOKIE['user'])) {?>
     <img src="<?php echo $config["paths"]["image"]["layout"]?>/profile-male-icon.png" alt="Avatar" /> 
	 <?php }else{?>
	  <img src="<?php echo $config["paths"]["image"]["layout"]?>/no-image.png" alt="Avatar" /> 
	 <?php }?>
    </button>
	
	
	
    <div class="profile__form">
      <div class="profile__fields">
        <?php  if(isset($_COOKIE['user'])) {?>
			 
			 
			   <div align='center'>Hi <?php echo $_COOKIE['user'];?>  </div>
			   <input type="hidden"   name='user' value='<?php echo $_COOKIE['user'];?>'/>
			   
			   
			  
		<?php }else{?>
		
		<div class="field">
          <input type="text" id="fieldUser" class="input"  name='user' required pattern=.*\S.* />
          <label for="fieldUser" class="label">Username</label>
        </div>
		
		<?php }?>
		
		
        <div class="field">
          <input type="password" id="fieldPassword" class="input" name='pass' required pattern=.*\S.* />
          <label for="fieldPassword" class="label">Password</label>
        </div>
		
		<?php  if(isset($_COOKIE['user'])) {?>
		 <div class="field">
		         <div  style='display:inline;float:left;' class='user_switch' onclick=''>Forgot Password</div>
				 <div  style='display:inline;float:right;' class='user_switch' onclick='switch_user()'>Switch User</div>
				 <br/>
		 </div>
		<?php }else{?>
                <div class="field">
				 <div  style='display:inline;float:left;' class='user_switch' onclick=''>Forgot Password</div>
				 <div  style='display:inline;float:right;' class='user_switch' onclick='register_user()'>Register</div>
				 <br/>
		        </div>
		<?php }?>
		
		<div style = "font-size:12px; color:#cc0000; "><?php if($_SERVER["REQUEST_METHOD"] == "POST"){echo $error;}?></div>
        <div class="profile__footer">
           <div class="button raised blue">
            <div class="center" id='login_button' fit>LOGIN</div>
            <paper-ripple fit></paper-ripple>
          </div>
        </div>
      </div>
     </div>
  </div>
</div>

</div>
</div>
</form>




</body>