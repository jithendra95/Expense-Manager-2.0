<?php
session_start();
require 'connection_new.php';
require '../../resources/config.php';



//$chkBox=$_POST['chk_trn'];
$chksql=$_POST['chk_sql'];
$trn_code=$_POST['trn_code'];

$sql="";
if($chksql=="income"){
	 
	 
	 $sql3="SELECT NEXT_VAL FROM trn_seq";
      $result3=mysqli_query($conect,$sql3);
	  $row=mysqli_fetch_array($result3);
	  $next_val=$row['NEXT_VAL'];
	  
	 //echo $selected;
	  $sql="INSERT INTO main_trn(TRN_CODE,TRN_TYPE,TRN_AMOUNT, TRN_DESC, TRN_DATE,VALUE_DATE, ENT_DATE, INC_CODE,ENT_USER) 
	       ( SELECT CONCAT('TR',LPAD( '".$next_val."', 8, '0' )),'CR',
            AMOUNT ,
            INC_DESC, 
            CURDATE(),
			CURDATE(),
			
			CURDATE(),       
            INC_CODE,        
            '".$_SESSION['user']."'
			from income_trn WHERE INC_CODE='".$trn_code."')";
			//DATE_FORMAT(NOW() ,CONCAT('%Y-%m-',LPAD(TRN_DAY,2,0))),
	   $sql2="UPDATE trn_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	   $result2=mysqli_query($conect,$sql2);		
	
	   $result=mysqli_query($conect,$sql);
       
	
	  
	
    // header("Location: ".$config["paths"]["view"]."Income.php");
			
	}else{
	
	 
	 
	 $sql3="SELECT NEXT_VAL FROM trn_seq";
      $result3=mysqli_query($conect,$sql3);
	  $row=mysqli_fetch_array($result3);
	  $next_val=$row['NEXT_VAL'];
	  
	 //echo $selected;
	  $sql="INSERT INTO main_trn(TRN_CODE,TRN_TYPE,TRN_AMOUNT, TRN_DESC, TRN_DATE,VALUE_DATE, ENT_DATE, INC_CODE,ENT_USER,PAYEE_DESC,EXP_TYPE_CODE) 
	        (SELECT CONCAT('TR',LPAD( '".$next_val."', 8, '0' )),'DR',
             AMOUNT,
             EXP_DESC , 
            CURDATE(),
			CURDATE(),
			CURDATE(),       
            EXP_CODE,        
           '".$_SESSION['user']."',
		   PAYEE_DESC ,
           EXP_TYPE_CODE   		  
			from expense_trn WHERE EXP_CODE='".$trn_code."')";
			
	   $sql2="UPDATE trn_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	   $result2=mysqli_query($conect,$sql2);		
	
	   $result=mysqli_query($conect,$sql);
       
	
	  
	
   //  header("Location: ".$config["paths"]["view"]."Expense.php");
		
	}	
			
			
			
  
 // echo $_SESSION['user'].$_SESSION['login'];
//$_SESSION['user']=$user;

mysqli_close($conect);




?>






