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

?>
 <style>
 @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);
}
@import url(https://fonts.googleapis.com/css?family=Titillium+Web:300);

.main-menu-fa-2x {
font-size: 2em;
}
.main-menu-fa {
position: relative;
display: table-cell;
width: 60px;
height: 36px;
text-align: center;
vertical-align: middle;
font-size:20px;
}


.main-menu:hover,nav.main-menu.expanded {
width:250px;
overflow:visible;
}

.main-menu {
background:#fbfbfb;
border-right:1px solid #e5e5e5;
position:fixed;
top:0;
bottom:0;
height:100%;
left:0;
width:60px;
overflow:hidden;
-webkit-transition:width .05s linear;
transition:width .3s linear;
-webkit-transform:translateZ(0) scale(1,1);
z-index:1000;
}

.main-menu>ul {
margin:7px 0;
margin-top:150px;
}

/*.main-menu>ul>li>ul {
display:none
}*/

.main-menu>ul ul {
    position: absolute;
	background:#fbfbfb;
    top: 1em;
    left: 250px;
    display: none;
	
}

.main-menu>ul > li:hover ul {
     
    display: block;
}




.main-menu li {
position:relative;
display:block;
width:250px;
}

.main-menu li>a {
position:relative;
display:table;
border-collapse:collapse;
border-spacing:0;
color:#999;
 font-family: arial;
font-size: 14px;
text-decoration:none;
-webkit-transform:translateZ(0) scale(1,1);
-webkit-transition:all .1s linear;
transition:all .1s linear;
  
}

.main-menu .nav-icon {
position:relative;
display:table-cell;
width:60px;
height:36px;
text-align:center;
vertical-align:middle;
font-size:18px;
}

.main-menu .nav-text {
position:relative;
display:table-cell;
vertical-align:middle;
width:190px;
  font-family: 'Titillium Web', sans-serif;
}

.main-menu>ul.logout {
position:absolute;
left:0;
bottom:30%;
}

.no-touch .scrollable.hover {
overflow-y:hidden;
}

.no-touch .scrollable.hover:hover {
overflow-y:auto;
overflow:visible;
}

a:hover,a:focus {
text-decoration:none;
}

nav {
-webkit-user-select:none;
-moz-user-select:none;
-ms-user-select:none;
-o-user-select:none;
user-select:none;
}

nav ul,nav li {
outline:0;
margin:0;
padding:0;
}
.main-menu li:hover>a,nav.main-menu li.active>a,.dropdown-menu>li>a:hover,.dropdown-menu>li>a:focus,.dropdown-menu>.active>a,.dropdown-menu>.active>a:hover,.dropdown-menu>.active>a:focus,.no-touch .dashboard-page nav.dashboard-menu ul li:hover a,.dashboard-page nav.dashboard-menu ul li.active a {
color:#fff;
background-color:#5fa2db;
}
.area {
float: left;
background: #e2e2e2;
width: 100%;
height: 100%;
}
@font-face {
  font-family: 'Titillium Web';
  font-style: normal;
  font-weight: 300;
  src: local('Titillium WebLight'), local('TitilliumWeb-Light'), url(http://themes.googleusercontent.com/static/fonts/titilliumweb/v2/anMUvcNT0H1YN4FII8wpr24bNCNEoFTpS2BTjF6FB5E.woff) format('woff');
}

 </style>
 
 
           <nav class="main-menu">
		   <!--
            <ul>
                <li>
                    <a href="http://justinfarrow.com">
                        <i class="fa fa-home fa-2x"></i>
                        <span class="nav-text">
                            Dashboard
                        </span>
                    </a>
                  
                </li>
                <li class="has-subnav">
                    <a href="#">
                        <i class="fa fa-laptop fa-2x"></i>
                        <span class="nav-text">
                            UI Components
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-list fa-2x"></i>
                        <span class="nav-text">
                            Forms
                        </span>
                    </a>
                 
                </li>
                <li class="has-subnav">
                    <a href="#">
                       <i class="fa fa-folder-open fa-2x"></i>
                        <span class="nav-text">
                            Pages
                        </span>
                    </a>
                   
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-bar-chart-o fa-2x"></i>
                        <span class="nav-text">
                            Graphs and Statistics 
                        </span> 
                    </a>
					
					                <ul>
											<li>
												<a href="http://justinfarrow.com">
													<i class="fa fa-home fa-2x"></i>
													<span class="nav-text">
														Dashboard
													</span>
												</a>
											  
											</li>
											
											<li class="has-subnav">
												<a href="#">
												   <i class="fa fa-folder-open fa-2x"></i>
													<span class="nav-text">
														Pages
													</span>
												</a>
											   
											</li>
											
										</ul>	
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-font fa-2x"></i>
                        <span class="nav-text">
                            Typography and Icons
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                       <i class="fa fa-table fa-2x"></i>
                        <span class="nav-text">
                            Tables
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                        <i class="fa fa-map-marker fa-2x"></i>
                        <span class="nav-text">
                            Maps
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                       <i class="fa fa-info fa-2x"></i>
                        <span class="nav-text">
                            Documentation
                        </span>
                    </a>
                </li>
            </ul>-->
			
			<ul>
                <li>
                    <a href="<?php echo $config["paths"]["view"];?>Home.php">
                        <i class="fa fa-home fa-2x main-menu-fa main-menu-fa-2x"></i>
                        <span class="nav-text">
                            Home
                        </span>
                    </a>
                  
                </li>
                <li class="has-subnav">
                    <a href="<?php echo $config["paths"]["view"];?>Expense.php">
                        <i class="fa fa-usd  fa-2x main-menu-fa main-menu-fa-2x"></i>
                        <span class="nav-text">
                            Expense
                        </span>
                    </a>
                    
                </li>
                <li class="has-subnav">
                    <a href="<?php echo $config["paths"]["view"];?>Income.php">
                       <i class="fa  fa-line-chart fa-2x main-menu-fa main-menu-fa-2x"></i>
                        <span class="nav-text">
                            Income
                        </span>
                    </a>
                 
                </li>
                <li class="has-subnav">
                    <a href="<?php echo $config["paths"]["view"];?>Budget.php">
                       <i class="fa fa-folder-open fa-2x main-menu-fa main-menu-fa-2x"></i>
                        <span class="nav-text">
                            Budget
                        </span>
                    </a>
                   
                </li>
				
				<li class="has-subnav">
                    <a href="">
                       <i class="fa fa-bar-chart fa-2x main-menu-fa main-menu-fa-2x"></i>
                        <span class="nav-text">
                            Reports
                        </span>
                    </a>
					
					                  <ul>
											<li>
												<a href="<?php echo $config["paths"]["view"];?>Reports.php">
													<i class="fa fa-calendar fa-2x main-menu-fa main-menu-fa-2x"></i>
													<span class="nav-text">
														Monthly Reports
													</span>
												</a>
											  
											</li>
											
											<li class="has-subnav">
												<a href="#">
												   <i class="fa fa-calendar-check-o fa-2x main-menu-fa main-menu-fa-2x"></i>
													<span class="nav-text">
														Yearly Reports
													</span>
												</a>
											   
											</li>
											
										</ul>	
                   
                </li>
				
				<li>
                    <a href="#">
                       <i class="fa fa-user fa-2x main-menu-fa main-menu-fa-2x"></i>
                        <span class="nav-text">
                            Profile
                        </span>
                    </a>
                   
                </li>
				
				
				 <li class="has-subnav">
                   <a href="<?php echo $config["paths"]["model"]?>Log_out.php">
                         <i class="fa fa-power-off fa-2x main-menu-fa main-menu-fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>  
				
				
				</ul>

            <!--ul class="logout">
                <li>
                   <a href="<?php echo $config["paths"]["model"]?>Log_out.php">
                         <i class="fa fa-power-off fa-2x"></i>
                        <span class="nav-text">
                            Logout
                        </span>
                    </a>
                </li>  
            </ul-->
        </nav>
 <?php }?>