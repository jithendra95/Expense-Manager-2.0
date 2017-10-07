<?php




function get_expense_type(){

require '../../resources/config.php';
require 'connection_new.php';


/*$get_month_trn="SELECT EXP_TYPE_DESC,SUM(TRN_AMOUNT)
				FROM main_trn A,expense_type B
				WHERE A.EXP_TYPE_CODE=B.EXP_TYPE_CODE
				AND A.ENT_USER='".$_SESSION['user']."'
				AND A.ACTIVE_STATUS='Y'
				AND MONTH(VALUE_DATE)<=MONTH(CURDATE()) 
				AND YEAR(VALUE_DATE)<=YEAR(CURDATE())
				AND MONTH(VALUE_DATE)>=MONTH(DATE_ADD(CURDATE(),INTERVAL -5 MONTH)) 
				AND YEAR(VALUE_DATE)>=YEAR(DATE_ADD(CURDATE(),INTERVAL -5 MONTH))
				GROUP BY EXP_TYPE_DESC ";
				*/
				
$get_month_trn="SELECT EXP_TYPE_DESC,SUM(TRN_AMOUNT)
				FROM main_trn A,expense_type B
				WHERE A.EXP_TYPE_CODE=B.EXP_TYPE_CODE
				AND A.ENT_USER='".$_SESSION['user']."'
				AND A.ACTIVE_STATUS='Y'
				AND VALUE_DATE<DATE_ADD(CURDATE(), INTERVAL +1 DAY) 
				AND VALUE_DATE>=DATE_ADD(CURDATE(), INTERVAL -1 MONTH)
				GROUP BY EXP_TYPE_DESC ";				
				
				
	$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
$count=0;
while($row=mysqli_fetch_array($result)){
    
	if($count==0){
	
	echo  '{
                name: \''.$row["0"].'\',
                y: '.$row["1"].'
            }';
	
	$count++;
	}else{
	  
	  echo  ',{
                name: \''.$row["0"].'\',
                y: '.$row["1"].'
            }';
	
	}
      
	 
	 
	 
	 
	       
}	
		
mysqli_close($conect);

}

}




function get_monthly_expense(){

require '../../resources/config.php';
require 'connection_new.php';

$cr_amount="";
$dr_amount="";
$months="";

$get_month_trn=" SELECT DR_AMOUNT,CR_AMOUNT,MONTHNAME(STR_TO_DATE(DR_TABLE.MONTH,'%m'))
                FROM main_trn A ,
                
				(SELECT SUM(TRN_AMOUNT) DR_AMOUNT,MONTH(VALUE_DATE) MONTH
				FROM main_trn A
				WHERE A.ENT_USER='".$_SESSION['user']."'
				AND TRN_TYPE='DR'
				AND A.ACTIVE_STATUS='Y'
				AND MONTH(VALUE_DATE)<=MONTH(CURDATE()) 
				AND MONTH(VALUE_DATE)>=MONTH(DATE_ADD(CURDATE(),INTERVAL -5 MONTH)) 
				AND YEAR(VALUE_DATE)=YEAR(CURDATE())
                GROUP BY MONTH(VALUE_DATE))DR_TABLE	,
				
				(SELECT SUM(TRN_AMOUNT) CR_AMOUNT,MONTH(VALUE_DATE) MONTH
				FROM main_trn A
				WHERE A.ENT_USER='".$_SESSION['user']."'
				AND TRN_TYPE='CR'
				AND A.ACTIVE_STATUS='Y'
				AND MONTH(VALUE_DATE)<=MONTH(CURDATE()) 
				AND MONTH(VALUE_DATE)>=MONTH(DATE_ADD(CURDATE(),INTERVAL -5 MONTH)) 
				AND YEAR(VALUE_DATE)=YEAR(CURDATE())
                GROUP BY MONTH(VALUE_DATE))CR_TABLE 
				
				WHERE MONTH(A.VALUE_DATE)=DR_TABLE.MONTH
				AND MONTH(A.VALUE_DATE)=CR_TABLE.MONTH
				AND A.ENT_USER='".$_SESSION['user']."'
				AND MONTH(VALUE_DATE)<=MONTH(CURDATE()) 
				AND MONTH(VALUE_DATE)>=MONTH(DATE_ADD(CURDATE(),INTERVAL -5 MONTH)) 
				AND YEAR(VALUE_DATE)=YEAR(CURDATE())
                GROUP BY MONTH(VALUE_DATE)";
				
	//echo $get_month_trn;			
				
	$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{

$count=0;
while($row=mysqli_fetch_array($result)){
    
	if($count==0){
	
	$cr_amount=$row["1"];
	$dr_amount=$row["0"];
	$months='\''.$row["2"].'\'';
	
	$count++;
	}else{
	  
	$cr_amount.=','.$row["1"];
	$dr_amount.=','.$row["0"];
	$months.=','.'\''.$row["2"].'\'';
	
	}
      
	 
	 
	 
	 
	       
}	
		
mysqli_close($conect);
return array($months,$dr_amount,$cr_amount);

}

}


?>