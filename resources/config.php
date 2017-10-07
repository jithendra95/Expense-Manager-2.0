<?php
   
   
    $config = array(
    "urls" => array(
        "baseUrl" => "http://example.com"
    ),
    "paths" => array(
        "model" => "../model/",
		"view" => "../views/",
		"template" => "../template/",
		"css" => "../CSS/",
		"library" => array(
		    "bootstrap_css"=>"../../resources/library/bootstrap-3.3.6-dist/css/bootstrap.min.css",
			"bootstrap_js"=>"../../resources/library/bootstrap-3.3.6-dist/js/bootstrap.min.js",
			"jquery_library"=>"../../resources/library/jquery-1.11.2.min.js",
			"colorbox_library"=>"../../resources/library/Color_Box/",
			"datepicker_library"=>"../../resources/library/JS/"
			
			),
        "image" => array(
            "content" => "../img/content/",
            "layout" =>  "../img/layout/"
        )
      )
    );
	
	// define("HTML_PATH", realpath(dirname(__FILE__) . '/library'));
//	 define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));
 
     

  //echo $config["paths"]["images"]["content"];
  //echo constant("HTML_PATH"); 
   
   
   
   /*function connection(){
   
  $database_conect =array(
        "db1" => array(
            "dbname" => "expense_manager",
            "username" => "root",
            "password" => "",
            "host" => "localhost"
        ));
		
   $ip=$database_conect["db1"]["host"];//mysql13.000webhost.com
   $user=$database_conect["db1"]["username"];//a4108455_jt
   $pass=$database_conect["db1"]["password"];//jimmyanddimi
   $db=$database_conect["db1"]["dbname"];//'expense_manager';//a4108455_expense

		$conect=mysqli_connect($ip,$user,$pass,$db);
		//$conect=mysql_connect("mysql13.000webhost.com","a4108455_jt","jimmyanddimi");

		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }

      return $conect;
   

   }*/
   
   
  

?>