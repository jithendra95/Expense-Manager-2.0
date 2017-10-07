<?php



function draw_calendar($month,$year){
require '../../resources/config.php';
require 'connection_new.php';

?>
<style>

/* calendar */
table.calendar		{ border-left:1px solid #999; }
tr.calendar-row_head	{ height:100px; }
tr.calendar-row	{ height:150px; }
td.calendar-day	{ min-height:80px; font-size:11px; position:relative; background:#E6E6FA } * html div.calendar-day { height:80px; }
td.calendar-day:hover	{ background:#FFFFCC; }
td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { background:#69C7D6; color:#000;font-weight:bold; text-align:center; width:150px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
div.day-number		{ background:#fff;  color:#483D8B; font-weight:bold; align:left; margin-top:-50px; width:10px; text-align:left; }
/* shared */
td.calendar-day, td.calendar-day-np { width:120px; height:80px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }

.amount{
font-size:15px;
align:right;
font-weight: bold;
cursor:pointer
}
.inc{color: green;}

.exp{color: red;}

a {
  color: inherit;
  text-decoration: none !important; /* no underline */
}
</style>

<?php
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row_head"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			//$day_val=get_leaves_onday();
			
			
			//$calendar.= str_repeat(get_leaves_onday($list_day,$month,$year),1);
			$calendar.= get_trans_onday($list_day,$month,$year);//Data should be here
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}







function get_trans_onday($day,$month,$year){

require '../../resources/config.php';
require 'connection_new.php';

$transaction_onday= "SELECT (SELECT SUM(TRN_AMOUNT) 
					FROM main_trn A
					WHERE A.ENT_USER='".$_SESSION['user']."'
					AND TRN_TYPE='DR'
					AND A.ACTIVE_STATUS='Y'
					AND MONTH(VALUE_DATE)<=MONTH(CURDATE())
					AND VALUE_DATE ='".$year."-".$month."-".$day."' )DR_AMOUNT,
					
					(SELECT SUM(TRN_AMOUNT)
					FROM main_trn A
					WHERE A.ENT_USER='".$_SESSION['user']."'
					AND TRN_TYPE='CR'
					AND A.ACTIVE_STATUS='Y'
					AND MONTH(VALUE_DATE)<=MONTH(CURDATE())
					AND VALUE_DATE ='".$year."-".$month."-".$day."' )CR_AMOUNT
					FROM DUAL
					
					"; 
					
					//echo $transaction_onday;
					
$result=mysqli_query($conect,$transaction_onday);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{

$transaction_string="";
$count=0;
while($row=mysqli_fetch_array($result)){
    
	
	/*$cr_amount=$row["1"];
	$dr_amount=$row["0"];
	$months='\''.$row["2"].'\'';*/
	
	if($row["0"]<>0 and $row["0"]!=null){
	$transaction_string .= '<div align=center class=\' amount exp\'><a class=\'iframe\' href=All_Transactions.php?chk_sql=daily_trn&day='.$day.'&month='.$month.'&year='.$year.'&drcr_status=DR >-'.number_format($row["0"],2).'</a></div><br/>';
	}
    
   if($row["1"]<>0 and $row["1"]!=null){
   $transaction_string .= '<div align=center class=\' amount inc\'><a class=\'iframe\' href=All_Transactions.php?chk_sql=daily_trn&day='.$day.'&month='.$month.'&year='.$year.'&drcr_status=CR >+'.number_format($row["1"],2).'</a><div><br/>';
   }
	  
	 
	 
	 
	 
	       
}	
		
mysqli_close($conect);

} 
return $transaction_string;
}



function print_all_transaction_report($month,$year){

require '../../resources/config.php';
require 'connection_new.php';



?>

<style>


.amount{
font-size:15px;
align:right;
font-weight: bold;
cursor:pointer
}
.inc{color: green;}

.exp{color: red;}

#mon_bal_row:hover{

background-color:#FFFACD;

}

a {
  color: inherit;
  text-decoration: none !important; /* no underline */
}
</style>

<div class="container-fluid">
<div  align='left'  class='row'> 

<table class="table table-striped" >
    <thead>
      <tr style="background-color:#B0E0E6;">
		 <th colspan='5'>Transactions History</th>
      </tr>
	   <tr style="background-color:#69C7D6;">
	   <th>Discription</th>
	   <th>Expense/Income</th>
	   <th>Transaction Date</th>
	   <th colspan='2'>Amount</th>
	   
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
	
<?php

$get_month_trn="SELECT TRN_DESC,TRN_TYPE,VALUE_DATE,TRN_AMOUNT,TRN_CODE
				FROM main_trn
				WHERE ENT_USER='".$_SESSION['user']."'
				AND ACTIVE_STATUS='Y'
				AND VALUE_DATE<=LAST_DAY('".$year."-".$month."-01')
				AND VALUE_DATE>DATE_ADD(DATE_ADD(LAST_DAY('".$year."-".$month."-01'),INTERVAL +1 DAY),INTERVAL -1 MONTH) 
				ORDER BY VALUE_DATE DESC ";

//echo $get_month_trn;				
$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{

$grant_total=0;
$transaction_string="";
$count=0;
while($row=mysqli_fetch_array($result)){
    
	if($row["TRN_TYPE"]=='CR'){
	
	echo  "  <tr id='mon_bal_row' >
							  <td>".$row["0"]."</td><td>Income</td><td>".$row["2"]."</td><td  align='right' class='amount inc'>".number_format($row["3"],2)."</td>
							  </tr>";
							  
							  $grant_total+=$row["3"];
	}else{
	
	echo "  <tr id='mon_bal_row' >
							  <td>".$row["0"]."</td><td>Expense</td><td>".$row["2"]."</td><td  align='right' class='amount exp'>-".number_format($row["3"],2)."</td>
							  </tr>";
							  
							  $grant_total-=$row["3"];
	}
	
	
	  
	 
	 
	 
	 
	       
}	
		
mysqli_close($conect);

}
?>

<tr>
<td colspan='3' align=center><b>Total</b></td>

<?php
if($grant_total<0){
echo "<td class='amount exp' align='right' >". number_format($grant_total,2);
}else{
echo "<td class='amount inc' align='right' >". number_format($grant_total,2);
}

?>

</td>
 
 
 </tr>
</tbody>
	
</table>


</div>
</div>
<?php
}
?>




<?php

function print_exp_transaction_report($month,$year){

require '../../resources/config.php';
require 'connection_new.php';



?>

<style>


.amount{
font-size:15px;
align:right;
font-weight: bold;
cursor:pointer
}


#mon_bal_row:hover{

background-color:#FFFACD;

}

a {
  color: inherit;
  text-decoration: none !important; /* no underline */
}
</style>

<div class="container-fluid">
<div  align='left'  class='row'> 

<table class="table table-striped" >
    <thead>
      <tr style="background-color:#B0E0E6;">
		 <th colspan='5'>Expense History</th>
      </tr>
	   <tr style="background-color:#69C7D6;">
	   <th>Discription</th>
	   <th>Expense Type</th>
	   <th>Payee</th>
	   <th>Transaction Date</th>
	   <th colspan='2'>Amount</th>
	   
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
	
<?php

$get_month_trn="SELECT TRN_DESC,TRN_TYPE,VALUE_DATE,TRN_AMOUNT,TRN_CODE,PAYEE_DESC,
                (SELECT EXP_TYPE_DESC FROM expense_type WHERE EXP_TYPE_CODE=main_trn.EXP_TYPE_CODE)EXP_TYPE
				FROM main_trn
				WHERE ENT_USER='".$_SESSION['user']."'
				AND ACTIVE_STATUS='Y'
				AND TRN_TYPE='DR'
				AND VALUE_DATE<=LAST_DAY('".$year."-".$month."-01')
				AND VALUE_DATE>DATE_ADD(DATE_ADD(LAST_DAY('".$year."-".$month."-01'),INTERVAL +1 DAY),INTERVAL -1 MONTH) 
				ORDER BY VALUE_DATE DESC ";

//echo $get_month_trn;				
$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{

$grant_total=0;
$transaction_string="";
$count=0;
while($row=mysqli_fetch_array($result)){
    

	 
	 echo "  <tr id='mon_bal_row' >
							  <td>".$row["0"]."</td><td>".$row["6"]."</td><td>".$row["5"]."</td><td>".$row["2"]."</td><td  align='right' class='amount'>".number_format($row["3"],2)."</td>
							  </tr>";
							  
							  $grant_total+=$row["3"];
	 
	 
	       
}	
		
mysqli_close($conect);

}
?>

<tr>
<td colspan='4' align=center><b>Total</b></td>

<?php

echo "<td class='amount' align='right' >". number_format($grant_total,2);


?>

</td>
 
 
 </tr>
</tbody>
	
</table>


</div>
</div>
<?php
}
?>





<?php

function print_inc_transaction_report($month,$year){

require '../../resources/config.php';
require 'connection_new.php';



?>

<style>


.amount{
font-size:15px;
align:right;
font-weight: bold;
cursor:pointer
}


#mon_bal_row:hover{

background-color:#FFFACD;

}

a {
  color: inherit;
  text-decoration: none !important; /* no underline */
}
</style>

<div class="container-fluid">
<div  align='left'  class='row'> 

<table class="table table-striped" >
    <thead>
      <tr style="background-color:#B0E0E6;">
		 <th colspan='5'>Income History</th>
      </tr>
	   <tr style="background-color:#69C7D6;">
	   <th>Discription</th>
	   <th>Transaction Date</th>
	   <th colspan='2'>Amount</th>
	   
      </tr>
    </thead>
	<tbody id='mon_pend_inc'>
	
	
<?php

$get_month_trn="SELECT TRN_DESC,TRN_TYPE,VALUE_DATE,TRN_AMOUNT,TRN_CODE
				FROM main_trn
				WHERE ENT_USER='".$_SESSION['user']."'
				AND ACTIVE_STATUS='Y'
				AND TRN_TYPE='CR'
				AND VALUE_DATE<=LAST_DAY('".$year."-".$month."-01')
				AND VALUE_DATE>DATE_ADD(DATE_ADD(LAST_DAY('".$year."-".$month."-01'),INTERVAL +1 DAY),INTERVAL -1 MONTH) 
				ORDER BY VALUE_DATE DESC ";

//echo $get_month_trn;				
$result=mysqli_query($conect,$get_month_trn);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{

$grant_total=0;
$transaction_string="";
$count=0;
while($row=mysqli_fetch_array($result)){
    

	 
	 echo "  <tr id='mon_bal_row' >
							  <td>".$row["0"]."</td><td>".$row["2"]."</td><td  align='right' class='amount'>".number_format($row["3"],2)."</td>
							  </tr>";
							  
							  $grant_total+=$row["3"];
	 
	 
	       
}	
		
mysqli_close($conect);

}
?>

<tr>
<td colspan='2' align=center><b>Total</b></td>

<?php

echo "<td class='amount' align='right' >". number_format($grant_total,2);


?>

</td>
 
 
 </tr>
</tbody>
	
</table>


</div>
</div>
<?php
}
?>

