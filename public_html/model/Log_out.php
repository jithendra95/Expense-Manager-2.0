<?php 

session_start();
require '../../resources/config.php';
$_SESSION['login']="0";

if(isset($_POST['chk_sql'])){
  if($_POST['chk_sql']=='switch'){
    setcookie("user", "", time() - 3600, "/");
	setcookie("image_url", "", time() - 3600, "/");}
	echo 'Deleted';
}
header ("Location: ".$config["paths"]["view"]."Index.php");


?>