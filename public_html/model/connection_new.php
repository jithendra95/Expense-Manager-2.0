<?php

$ip='localhost';//mysql13.000webhost.com
$user='root';//'root';//id1908885_jimmydimi
$pass='';//jimmyanddimi
$db='my_expense';//'my_expense';//id1908885_myexpense

$conect=mysqli_connect($ip,$user,$pass,$db);
//$conect=mysql_connect("mysql13.000webhost.com","a4108455_jt","jimmyanddimi");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//mysql_select_db('expense_manager',$conect);
//mysql_select_db('a4108455_expense',$conect);



?>