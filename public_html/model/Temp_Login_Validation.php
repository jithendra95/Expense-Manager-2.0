<?php
/*if($_POST["chksql"]=="test"){

echo 'Hello';
}*/

echo $_POST["user"];
echo $_POST["pass"];
if(isset( $_POST["user"])&& isset( $_POST["pass"])  )
{


if($_POST["user"]=="user" && $_POST["pass"]=="pass" )
{
$_SESSION['user']=$_POST["user"];
$_SESSION['pass']=$_POST["pass"];
$_SESSION['login']="1";
$_SESSION['login_msg']="";

header("Location: ../Home.php");
}else{
$_SESSION['login_msg']="Invalid Username or Password";
//header("Location: ../Index.php");
}


}else{
$_SESSION['login_msg']="Invalid Username or Password";
//header("Location: ../Index.php");
}


?>