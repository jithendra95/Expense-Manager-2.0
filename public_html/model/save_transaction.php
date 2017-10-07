<?php
session_start();
require 'connection_new.php';



if(isset($_POST['amount'])){
$amount=$_POST['amount'];
$trn_desc=$_POST['trn_desc'];
$trn_date=$_POST['trn_date'];}


$trn_type=$_POST['trn_type'];
$chk_sql=$_POST['chk_sql'];
$sql="";
//$sql="INSERT INTO class VALUES('".$name."')";
  /*    $sql="SELECT NEXT_VAL FROM user_seq";
      $result=mysql_query($sql);
	  $row=mysql_fetch_array($result);
	  $next_val=$row['NEXT_VAL'];
	  
	  $sql="UPDATE user_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	  $result=mysql_query($sql);*/
	  
     // $sql="INSERT INTO user VALUES (LPAD( '".$next_val."', 10, '0' ),'".$user."','".$pass."',CURDATE(),'Y')";
	  
	 if($chk_sql=='income'){ 
	 if($trn_type=='month'){
	 
	  $sql3="SELECT NEXT_VAL FROM inc_seq";
      $result3=mysqli_query($conect,$sql3);
	  $row=mysqli_fetch_array($result3);
	  $next_val=$row['NEXT_VAL'];
	  
	  $sql="INSERT INTO income_trn(INC_CODE,AMOUNT, INC_DESC, TRN_DAY, ENT_DATE, USER) 
	        VALUES (CONCAT('IN',LPAD( '".$next_val."', 8, '0' )),'".$amount."','".$trn_desc."','".$trn_date."',CURDATE(),'".$_SESSION['user']."')";
		
		$result=mysqli_query($conect,$sql);
		
		
       $sql2="UPDATE inc_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	   $result2=mysqli_query($conect,$sql2);		
			
		}else if($trn_type=='day'){
		
      $sql3="SELECT NEXT_VAL FROM trn_seq";
      $result3=mysqli_query($conect,$sql3);
	  $row=mysqli_fetch_array($result3);
	  $next_val=$row['NEXT_VAL'];
	  
		  $sql="INSERT INTO main_trn(TRN_CODE,TRN_TYPE,TRN_AMOUNT, TRN_DESC, TRN_DATE, ENT_DATE, ENT_USER,INC_CODE,VALUE_DATE) 
	        VALUES (CONCAT('TR',LPAD( '".$next_val."', 8, '0' )),'CR','".$amount."','".$trn_desc."',CURDATE(),CURDATE(),'".$_SESSION['user']."','CURRENT','".$trn_date."')";
		  
		  $result=mysqli_query($conect,$sql);
		
		  $sql2="UPDATE trn_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	      $result2=mysqli_query($conect,$sql2);
	  
		}else{
		
		echo 'Invalid Transaction Type Selected';
		}	
			
		}	
		else if($chk_sql=='expense'){ 
		$trn_nature=$_POST['trn_nature'];
		$payee_desc=$_POST['payee_desc'];

	 if($trn_type=='month'){
	 
	  $sql3="SELECT NEXT_VAL FROM exp_seq";
      $result3=mysqli_query($conect,$sql3);
	  $row=mysqli_fetch_array($result3);
	  $next_val=$row['NEXT_VAL'];
	  
	  $sql="INSERT INTO expense_trn(EXP_CODE,AMOUNT, EXP_DESC, TRN_DAY, ENT_DATE, USER,PAYEE_DESC,EXP_TYPE_CODE) 
	        VALUES (CONCAT('EP',LPAD( '".$next_val."', 8, '0' )),'".$amount."','".$trn_desc."','".$trn_date."',CURDATE(),'".$_SESSION['user']."',
			  '".$payee_desc."','".$trn_nature."')";
			  
		 $result=mysqli_query($conect,$sql);
		
       $sql2="UPDATE exp_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	   $result2=mysqli_query($conect,$sql2);		
			
		}else if($trn_type=='day'){
		
      $sql3="SELECT NEXT_VAL FROM trn_seq";
      $result3=mysqli_query($conect,$sql3);
	  $row=mysqli_fetch_array($result3);
	  $next_val=$row['NEXT_VAL'];
	  
		  $sql="INSERT INTO main_trn(TRN_CODE,TRN_TYPE,TRN_AMOUNT, TRN_DESC, TRN_DATE, ENT_DATE, ENT_USER,INC_CODE,PAYEE_DESC,EXP_TYPE_CODE,VALUE_DATE) 
	        VALUES (CONCAT('TR',LPAD( '".$next_val."', 8, '0' )),'DR','".$amount."','".$trn_desc."',CURDATE(),CURDATE(),'".$_SESSION['user']."','CURRENT',
			 '".$payee_desc."','".$trn_nature."','".$trn_date."')";
		
		  $result=mysqli_query($conect,$sql);
		
		
		  $sql2="UPDATE trn_seq SET LAST_VAL=NEXT_VAL,NEXT_VAL=NEXT_VAL+1";
	      $result2=mysqli_query($conect,$sql2);
	  
		}	
			
		}	
		else if($chk_sql=='acc_bal'){
		$balance=$_POST['acc_balance'];
		
		if($trn_type=='insert'){
	 
	  
	  
	  $sql="INSERT INTO opening_balance(USER_ID,BALANCE) 
	        VALUES ('".$_SESSION['user']."','".$balance."')";
			  
		 $result=mysqli_query($conect,$sql);
				
			
		
		}else if($trn_type=='update'){
		
		$sql="INSERT INTO opening_balance_bk(USER_ID,BALANCE,MOD_DATE) 
	        VALUES ( (SELECT USER_ID FROM opening_balance WHERE USER_ID= '".$_SESSION['user']."'),
			       (  SELECT BALANCE FROM opening_balance WHERE USER_ID= '".$_SESSION['user']."'),
			         CURDATE())";
			  
		 $result=mysqli_query($conect,$sql);
		 
		$sql="UPDATE opening_balance  
	        SET BALANCE='".$balance."'
			WHERE USER_ID='".$_SESSION['user']."'";
			
			 $result=mysqli_query($conect,$sql);
		
		}
		}
			
 // $result=mysql_query($sql);
  echo $_SESSION['user'].$_SESSION['login'];
//$_SESSION['user']=$user;

mysqli_close($conect);




?>






