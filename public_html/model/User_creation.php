<?php
session_start();
require 'connection_new.php';
require 'password_encryption.php';
require '../../resources/config.php';


if($_POST['user']!=null && $_POST['name']!=null)
{
$name=$_POST['name'];
$user=$_POST['user'];
$pass=$_POST['pass'];

//$pass=generateHash_sha1($pass);
$pass=generateHash_sha1($pass);
//$sql="INSERT INTO class VALUES('".$name."')";
      $sql="SELECT NEXT_VAL FROM user_seq";
      $result=mysqli_query($conect,$sql);
	  $row=mysqli_fetch_array($result);
	  $next_val=$row['NEXT_VAL'];
	  
	  
	  
      $sql="INSERT INTO user VALUES (LPAD( '".$next_val."', 10, '0' ),'".$name."','".$pass."',CURDATE(),'Y','".$user."','0000000001')";
      $result=mysqli_query($conect,$sql);


if ( $result == FALSE) {
   echo "User Already Exist".mysqli_error($conect);  
    
} 

else {
  $sql="UPDATE user_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	  $result=mysqli_query($conect,$sql);
	  
    //echo "New Class created successfully";
	/*$_SESSION['user']=$user;
	$_SESSION['user_name']=$name;
    $_SESSION['login']="1";*/
	
	
$result=mysqli_query($conect,"SELECT USER_NAME,PASSWORD,USER_ID FROM `user` where USER_NAME= '".$name."'");

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
  header("Location: ".$config["paths"]["view"]."Home.php");
  
}
else{
//$error=$_POST["pass"]."			".$row["PASSWORD"];
$error="Invalid Username or Password ";
    }
 
   }

  }

  }
}
mysqli_close($conect);


?>






