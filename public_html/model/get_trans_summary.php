<?php

require '../../resources/config.php';
require 'connection_new.php';

$cr_balance=0.00;
$dr_balance=0.00;
$dr_previous_month=0.00;
$opening_balance=0.00;
$opening_balance_color="";
$closing_balance_color="";
$closing_balance=0.00;
$total_cr_balance=0.00;
$total_dr_balance=0.00;
$account_balance=0.00;


						
/*$get_monthly_balance="SELECT 
    
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='CR' 
					AND ENT_USER='".$_SESSION['user']."' 
					AND ACTIVE_STATUS='Y'
					AND MONTH(VALUE_DATE)=MONTH(CURDATE()) 
					AND YEAR(VALUE_DATE)=YEAR(CURDATE()))INCOME,
						
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='DR' 
					AND ENT_USER='".$_SESSION['user']."'
					AND ACTIVE_STATUS='Y'					
					AND MONTH(VALUE_DATE)=MONTH(CURDATE()) 
					AND YEAR(VALUE_DATE)=YEAR(CURDATE()))EXPENSE,
					
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='DR' 
					AND ENT_USER='".$_SESSION['user']."'
					AND ACTIVE_STATUS='Y'					
					AND MONTH(VALUE_DATE)=MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH)) 
					AND YEAR(VALUE_DATE)=YEAR(DATE_ADD(CURDATE(),INTERVAL -1 MONTH)))PREV_EXPENSE
					

					FROM DUAL";	*/
					
$get_monthly_balance="SELECT 
    
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='CR' 
					AND ENT_USER='".$_SESSION['user']."' 
					AND ACTIVE_STATUS='Y'
					AND VALUE_DATE<DATE_ADD(CURDATE(), INTERVAL +1 DAY) 
					AND VALUE_DATE>=DATE_ADD(CURDATE(), INTERVAL -1 MONTH))INCOME,
						
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='DR' 
					AND ENT_USER='".$_SESSION['user']."'
					AND ACTIVE_STATUS='Y'					
					AND VALUE_DATE<DATE_ADD(CURDATE(), INTERVAL +1 DAY) 
					AND VALUE_DATE>=DATE_ADD(CURDATE(), INTERVAL -1 MONTH))EXPENSE,
					
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='DR' 
					AND ENT_USER='".$_SESSION['user']."'
					AND ACTIVE_STATUS='Y'					
					AND MONTH(VALUE_DATE)=MONTH(DATE_ADD(CURDATE(),INTERVAL -1 MONTH)) 
					AND YEAR(VALUE_DATE)=YEAR(DATE_ADD(CURDATE(),INTERVAL -1 MONTH)))PREV_EXPENSE
					

					FROM DUAL";						

$get_total_balance="SELECT 
    
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='CR' 
					AND ENT_USER='".$_SESSION['user']."'
					AND ACTIVE_STATUS='Y'
					AND VALUE_DATE<=CURDATE()
					 )INCOME,
						
					(SELECT SUM(TRN_AMOUNT) 
					FROM main_trn 
					WHERE TRN_TYPE='DR' 
					AND ENT_USER='".$_SESSION['user']."' 
					AND ACTIVE_STATUS='Y'
					AND VALUE_DATE<=CURDATE() 
					)EXPENSE

					FROM DUAL";	
					
					
$get_account_balance="SELECT 
                      BALANCE FROM opening_balance
					  WHERE USER_ID='".$_SESSION['user']."' ";						

					
						

$result=mysqli_query($conect,$get_monthly_balance);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
if($row=mysqli_fetch_array($result)){

     $cr_balance=$row["0"];
	 $dr_balance=$row["1"];
	 $dr_previous_month=$row["2"];
	 }
	 
}	

$result=mysqli_query($conect,$get_account_balance);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
if($row=mysqli_fetch_array($result)){

     $account_balance=$row["0"];
	 
	 
	 
	 }
	} 
	 


$result=mysqli_query($conect,$get_total_balance);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
if($row=mysqli_fetch_array($result)){

     $total_cr_balance=$row["0"];
	 $total_dr_balance=$row["1"];
	 
	 
	 }
	 $opening_balance=($total_cr_balance-$cr_balance)-($total_dr_balance-$dr_balance)+ $account_balance;
	 if($opening_balance>0){
	 $opening_balance_color="color:#32CD32";
	 }else{
	 $opening_balance_color="color:#DC143C";
	 
	 }
	 
	 
} 
	
	 
	 
   $closing_balance=$opening_balance+($cr_balance)-($dr_balance);
if($closing_balance>=0){
	 $closing_balance_color="color:#32CD32";
	 }else{
	 $closing_balance_color="color:#DC143C";
	 
	 }
mysqli_close($conect);



function get_monthly_trn(){

require '../../resources/config.php';
require 'connection_new.php';


$get_month_trn="SELECT C.DESCR,C.DAY,C.AMOUNT,TYPE,TRN_CODE
                FROM(


                    SELECT (INC_DESC)DESCR,AMOUNT,(TRN_DAY)DAY,'CR' TYPE ,INC_CODE TRN_CODE
					FROM income_trn A
					WHERE USER='".$_SESSION['user']."'
					AND ACTIVE_STATUS='Y'
                    
                 UNION ALL


                    SELECT (EXP_DESC)DESCR,AMOUNT ,(TRN_DAY)DAY,'DR' TYPE,EXP_CODE TRN_CODE
					FROM expense_trn B
					WHERE USER='".$_SESSION['user']."'
					AND ACTIVE_STATUS='Y'
                ) C ORDER BY TYPE,DAY";
	$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
while($row=mysqli_fetch_array($result)){

      
	  if($row["3"]=='CR')	{
		echo "<tr id='mon_trn_cr' >
              <td>".$row["0"]."</td><td>".number_format($row["2"],2)."</td><td  align='left' onclick='post_transaction(\"".$row["4"]."\",\"CR\")'><i class=\"fa fa-paper-plane\"></i></td><td onclick='delete_monthly_transaction(\"".$row["4"]."\",\"CR\")'><i class=\"fa fa-trash-o\"></i></td>
	          </tr>";
		
		}else{
				
              echo "<tr id='mon_trn_dr' >
              <td>".$row["0"]."</td><td>".number_format($row["2"],2)."</td><td  align='left' onclick='post_transaction(\"".$row["4"]."\",\"CR\")'><i class=\"fa fa-paper-plane\"></i></td><td onclick='delete_monthly_transaction(\"".$row["4"]."\",\"DR\")'><i class=\"fa fa-trash-o\"></i></td>
	          </tr>";
			  }
			  
	 }
	 
}	
		
mysqli_close($conect);
}


function get_trn_history(){
require '../../resources/config.php';
require 'connection_new.php';


$get_month_trn="SELECT TRN_DESC,TRN_TYPE,VALUE_DATE,TRN_AMOUNT,TRN_CODE
				FROM main_trn
				WHERE ENT_USER='".$_SESSION['user']."'
				AND ACTIVE_STATUS='Y'
				ORDER BY VALUE_DATE DESC
				LIMIT 07";


	$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
while($row=mysqli_fetch_array($result)){

      if($row["1"]=='CR'){
	    echo "<tr id='mon_bal_row' >
              <td>".$row["0"]."</td><td>Income</td><td>".$row["2"]."</td><td  align='right'><a class='iframe' href=\"All_Transactions.php\">".number_format($row["3"],2)."</a></td><td onclick='delete_transaction(\"".$row["4"]."\")'><i class=\"fa fa-trash-o\" ></i></td>
	          </tr>";
	  
	  }else{
	     echo "<tr id='mon_bal_row' >
              <td>".$row["0"]."</td><td>Expense</td><td>".$row["2"]."</td><td  align='right'><a class='iframe' href=\"All_Transactions.php\">".number_format($row["3"],2)."</a></td><td onclick='delete_transaction(\"".$row["4"]."\")'><i class=\"fa fa-trash-o\" ></i></td>
	          </tr>";
	  
	  }
	  
			  
	 }
	 
}	
		
mysqli_close($conect);
}



function get_all_trn_history(){
require '../../resources/config.php';
require 'connection_new.php';


$get_month_trn="SELECT TRN_DESC,TRN_TYPE,VALUE_DATE,TRN_AMOUNT,TRN_CODE
				FROM main_trn
				WHERE ENT_USER='".$_SESSION['user']."'
				AND ACTIVE_STATUS='Y'
				ORDER BY VALUE_DATE DESC ";


	$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
while($row=mysqli_fetch_array($result)){

      if($row["1"]=='CR'){
	    echo "<tr id='mon_bal_row' >
              <td>".$row["0"]."</td><td>Income</td><td>".$row["2"]."</td><td  align='right'>".number_format($row["3"],2)."</td><td onclick='delete_transaction(\"".$row["4"]."\")'><i class=\"fa fa-trash-o\" ></i></td>
	          </tr>";
	  
	  }else{
	     echo "<tr id='mon_bal_row' >
              <td>".$row["0"]."</td><td>Expense</td><td>".$row["2"]."</td><td  align='right'>".number_format($row["3"],2)."</td><td onclick='delete_transaction(\"".$row["4"]."\")'><i class=\"fa fa-trash-o\" ></i></td>
	          </tr>";
	  
	  }
	  
			  
	 }
	 
}	
		
mysqli_close($conect);
}


function get_trn_history_onDay($day,$month,$year,$drcr_status){
require '../../resources/config.php';
require 'connection_new.php';


$get_month_trn="SELECT TRN_DESC,TRN_TYPE,VALUE_DATE,TRN_AMOUNT,TRN_CODE
				FROM main_trn
				WHERE ENT_USER='".$_SESSION['user']."'
				AND ACTIVE_STATUS='Y'
				AND VALUE_DATE ='".$year."-".$month."-".$day."'
				AND TRN_TYPE='".$drcr_status."'
				ORDER BY VALUE_DATE DESC ";


	$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
while($row=mysqli_fetch_array($result)){

      if($row["1"]=='CR'){
	    echo "<tr id='mon_bal_row' >
              <td>".$row["0"]."</td><td>Income</td><td>".$row["2"]."</td><td  align='right'>".number_format($row["3"],2)."</td><td onclick='delete_transaction(\"".$row["4"]."\")'><i class=\"fa fa-trash-o\" ></i></td>
	          </tr>";
	  
	  }else{
	     echo "<tr id='mon_bal_row' >
              <td>".$row["0"]."</td><td>Expense</td><td>".$row["2"]."</td><td  align='right'>".number_format($row["3"],2)."</td><td onclick='delete_transaction(\"".$row["4"]."\")'><i class=\"fa fa-trash-o\" ></i></td>
	          </tr>";
	  
	  }
	  
			  
	 }
	 
}	
		
mysqli_close($conect);
}

?>