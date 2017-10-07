<?php


$conect=mysql_connect("localhost","root","");
//$conect=mysql_connect("mysql13.000webhost.com","a4108455_jt","jimmyanddimi");
if(!$conect)
{
  
    die("DB error:".mysql_error);
}
mysql_select_db('expense_manager',$conect);
//mysql_select_db('a4108455_expense',$conect);



?>