<?php
	/*header('Content-Type: text/html; charset=windows-1255');
	
	$jd = gregoriantojd(2, 11, 2019);
	echo jdtojewish($jd, true), PHP_EOL;
     // jdtojewish($jd, true, CAL_JEWISH_ADD_GERESHAYIM), PHP_EOL,
     // jdtojewish($jd, true, CAL_JEWISH_ADD_ALAFIM), PHP_EOL,
     // jdtojewish($jd, true,CAL_JEWISH_ADD_ALAFIM_GERESH), PHP_EOL;   */
	
	header('Content-Type: text/html; charset=utf8_unicode_ci'); 
	session_start();		
	include 'functEnterORregis.php';
	date_default_timezone_set("Asia/Jerusalem");
?>
<!DOCTYPE html>   
<html dir="rtl" lang="he">
<head>

	<link href="https://fonts.googleapis.com/css?family=Miriam+Libre" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="script.js"></script>	
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="shortcut icon" href="favicon.ico" sizes="16x16" type="image/ico"> 

	
	<meta charset="UTF-8">				
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Site for ">
    <meta name="keywords" content="moshe hasapar,haircut,tisporet,xpr,משה הספר">
	<meta name="author" content="amix">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> משה הספר | הזמנת תורים </title>
	
</head>
<body dir="rtl">
		<header>
			<h1 class="h1_header">המספריים של משה</h1>
			<h2 class="h2_header">תספורות ברמה לגברים וילדים</h2>
			<div class="bg"></div>
			<div class="trieng"></div>
			
		</header>
		<section>
		<div class="shaped"></div>
	<?PHP
		// echo "password mosheAdmin - wQ89rifr <br>";
		// echo "password amir11 - iMOLfg1J <br>";
		// echo "password amir6 - GiYExdsB <br>";
		
		if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true){
				$name = $_SESSION["customerName"]; 
				
					if($name == "moshe Admin2"){
						include "hazmanaAdmin.php" ;
					}else{
						include "hazmana.php" ;
					}
						
		}
		
		else{
				include "enterORregistration.php" ; 
		}
				
				
	?>
				
		</section>
		
		<footer>
			<div class="footer"></div>
		</footer>
		

			
		


	</body>
 
</html>