<?php


 function main_imports($config){
   
  /* echo '<link rel="stylesheet" type="text/css" href="'.$config["paths"]["css"].'Style.css">
		<script src="'.$config["paths"]["library"]["jquery_library"].'"></script>
		<link rel="stylesheet" href="'.$config["paths"]["library"]["bootstrap_css"].'">
		<script src="'.$config["paths"]["library"]["bootstrap_js"].'" ></script>';*/
		
	echo	'<link rel="stylesheet" type="text/css" href="'.$config["paths"]["css"].'Style.css">
	      <link rel="stylesheet" type="text/css" href="'.$config["paths"]["library"]["colorbox_library"].'colorbox.css">
	      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		  <script src="'.$config["paths"]["library"]["datepicker_library"].'/validation/dist/jquery.validate.min.js" ></script>
		  <script src="'.$config["paths"]["library"]["colorbox_library"].'/jquery.colorbox-min.js" ></script>
          <script src="'.$config["paths"]["library"]["datepicker_library"].'/validation/dist/jquery-validate.bootstrap-tooltip.min.js" ></script>';
   
   }
   
   function date_picker_imports($config){
   /*
   echo  '  <link rel="stylesheet" type="text/css" href="'.$config["paths"]["library"]["datepicker_library"].'jquery.datepick.css"> 
			<script src="'.$config["paths"]["library"]["datepicker_library"].'jquery.plugin.js"></script>
			<script src="'.$config["paths"]["library"]["datepicker_library"].'jquery.datepick.js"></script>';
			*/
			
	echo	'<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.datepick.css"> 
			<script src="http://keith-wood.name/js/jquery.plugin.js"></script>
			<script src="http://keith-wood.name/js/jquery.datepick.js"></script>';
   }
   
   function high_chart_import(){
   
   
  echo '<script src="https://code.highcharts.com/highcharts.js"></script>
         <script src="https://code.highcharts.com/modules/exporting.js"></script>';
   }
   ?>