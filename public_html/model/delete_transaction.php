<?php
session_start();
require 'connection_new.php';
require '../../resources/config.php';



$chksql=$_POST['chk_sql'];
$trnCode=$_POST['trn_code'];

$sql="";
if($chksql=="main_trn"){
	

			
	   $sql="UPDATE main_trn SET ACTIVE_STATUS='N' WHERE TRN_CODE='".$trnCode."'";		
	   $result=mysqli_query($conect,$sql);
      
			
	}else if($chksql=="monthly_trn"){
	
      $chkType=$_POST['type'];
	  
	    if($chkType='CR'){
		
		$sql="UPDATE income_trn SET ACTIVE_STATUS='N' WHERE INC_CODE='".$trnCode."'";		
	    $result=mysqli_query($conect,$sql);
		
		}else{
		
		 $sql="UPDATE income_trn SET ACTIVE_STATUS='N' WHERE EXP_CODE='".$trnCode."'";		
	     $result=mysqli_query($conect,$sql);
		
		}
     
	}	
			
			
			
  
 // echo $_SESSION['user'].$_SESSION['login'];
//$_SESSION['user']=$user;

mysqli_close($conect);




?>






