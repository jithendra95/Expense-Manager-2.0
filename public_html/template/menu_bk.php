<?php

function menu(){

require '../../resources/config.php';
require $config["paths"]["model"].'connection_new.php';

$m_profile_url="";

$get_image_url="SELECT IMG_PATH FROM
                user A,profile_image B
				WHERE A.IMG_ID=B.IMG_ID
				AND A.USER_ID='".$_SESSION['user']."'";

				
$result=mysqli_query($conect,$get_image_url);						
if (!$result) {
   die('Invalid query: ' . mysqli_error($conect));
}else{
//if($row=mysql_fetch_array($result)){
/*row["USER_NAME"];
"1";*/
$count=0;
while($row=mysqli_fetch_array($result)){
   $m_profile_url=$row["0"];
}	
		
mysqli_close($conect);

}


echo '<nav class="navbar navbar-inverse">
     <div class="container-fluid">
     <div class="navbar-header">
	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">My Expense</a>
    </div>
	<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href="'.$config["paths"]["view"].'Home.php">Home</a></li>
      <li><a href="'.$config["paths"]["view"].'Expense.php">Expense</a></li>
      <li><a href="'.$config["paths"]["view"].'Income.php">Income</a></li>
      <li><a href="'.$config["paths"]["view"].'Budget.php">Budgeting</a></li>
	  
    </ul>
	 <ul class="nav navbar-nav navbar-right">
	 
	 <li><a href=""><img class="img-responsive img-circle" style="padding:2%; width:25px;height:25px;" src="'.$config["paths"]["image"]["layout"].'/'.$m_profile_url.'"/></a></li>
	  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.ucfirst($_SESSION['user_name']).' <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li align="center" class="well">
                <div><img class="img-responsive img-circle" style="padding:2%;" src="'.$config["paths"]["image"]["layout"].'/'.$m_profile_url.'"/><a class="change" href=""><span class="glyphicon glyphicon-camera"></span></a></div>
                <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span> Security</a>
                <a href="'.$config["paths"]["model"].'Log_out.php" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
            </li>
           </ul>
        </li>
		
	 
	 </ul>
    </div>
	</div>
    </nav>';

//<li><a href="'.$config["paths"]["model"].'Log_out.php">'.ucfirst($_SESSION['user_name']).'&nbsp <span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
}

?>