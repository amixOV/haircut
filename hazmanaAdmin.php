<?php

if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true){  
	if($name == "moshe Admin2"){
		include "functionHazmana.php";
		include "functionHazmanaAdmin.php";
	}else{
		header("Location: enterORregistration.php") ;
		die;
	}
}else{
	header("Location: enterORregistration.php") ;
	die;
}

?>
<div class="progress"></div>
<button class='button_admin_table button'>פרטים</button>
<div class ="table_admin_DB">
	<input id="myInput" type="text" placeholder="Search.."/>
	<form class="form" action = "<?php $_PHP_SELF; ?>" method = "POST" enctype="multipart/form-data">
		
		<button class="button button_table_admin" type="submit" name="torAdmin" value="tableOrder">הזמנות</button>
		<button class="button button_table_admin" type="submit" name="torAdmin" value="tableCustomer">לקוחות</button>
		<button class="button button_table_admin" type="submit" name="torAdmin" value="tableChange">שינויים</button>
		
		<table class="table_admin_DB_2">
		<?php 
		if(isset($_POST['torAdmin'])){
			include "showTableAdmin.php";
			
		}
		
		?>
		</table>
		
	</form>
</div>

<div class="welcome_admin">	
	<a class="log_out" href="logout.php"> התנתק </a>
	<h1>ברוכים הבאים  <?= $name;  ?></h1>
	<h1>ו<?= $dayPart ?>--<?= $id ?>  - customer id <br></h1>
	<form class="formGlobal" action = "<?php $_PHP_SELF; ?>" method = "POST" enctype="multipart/form-data">
		<input onchange="this.form.submit()" type="date" name="day" placeholder="Day" value="<?= $day ; ?>" />
	</form>

	<form class="formGlobal" action = "<?php $_PHP_SELF; ?>" method = "POST" enctype="multipart/form-data">
		<h3> לשנות את שעת פתיחה /סגירה של יום : <?= $day ?> </h3>
		<input type="time" name="startDay" placeholder="startDay" step="1200" value="<?= $timeDaySTR ; ?>" />
		<input type="time" name="finishDay" placeholder="finishDay" step="1200" value="<?= $timeDayFNSH ; ?>" />
		
		<input type="hidden" name="day" value="<?= $day ; ?>" />
		<button class="button" type="submit" value="submit" name="torAdmin">שנה</button>
	</form>
</div>	
	

	<h3>
	<?php
	echo $messege;
	?>
	</h3>

<div  class="table table_admin">
	<table class="tableAdmin">
		
		<h2>
		טבלת תורות ל<?=$hebDay . " - " . $day?> 
		</h2>
		<tr>
			<th>שעה</th>
			<th>פעולה</th>
			<th>שם הלקוח</th>
			<th>WHATS APP</th>
			<th>CALL NOW</th>
		</tr>
	<?php 
			hazmanaAdminTable($day, $numOfTor, $timeDaySTR, $id);
	?>	

	</table>
</div>
