<?php 
include "functionHazmana.php";
if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true){
			
}else{
	header("Location: enterORregistration.php") ; 
	die;
}

?>
<div class ="tor_messege">
<?php 
	$doEcho = true;
	ifTorExist($id, $numTor, $doEcho);
	
?>
</div>
<div class="out_welcome"></div>
<div class="welcome">

	<a class="log_out" href="logout.php"> התנתק </a>
	<h1>ברוכים הבאים  <?= $name;  ?></h1>
	<h1>ו<?= $dayPart ?> -- <?= $id ?> customer id <br></h1>

	<form class="formGlobal" id="selectDay" action = "<?php $_PHP_SELF; ?>" method = "POST" enctype="multipart/form-data">
		<select class="select_day" onchange="this.form.submit()" name='day' form='selectDay'/>
		
	<?php	
			selectDay($thisDay, $hebDay);

	?>		
		</select>

	</form>
</div>

<h3>
<?php
echo $messege;
?>
</h3>
<div  class="table">
	<h2>
		טבלת תורות ל<?=$hebDay . " - " . $day?> 
	</h2>
	<table  class="tableCustomer">

		<tr>
			<th>שעה</th>
			<th>פנוי/תפוס</th>
			<th></th>
		</tr>
	<?php 
				
			hazmanaTable($day, $numOfTor, $timeDaySTR, $id);
			
	?>	

	</table>
</div>
