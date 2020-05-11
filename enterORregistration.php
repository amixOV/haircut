<?php  
//	error_reporting (0);
?>

<form class="formGlobal window enter" action = "<?php $_PHP_SELF; ?>" method = "POST" enctype="multipart/form-data">
	<div class="inside">
		<h2> כניסה למערכת</h2>
		
		<input type="text" name="name" placeholder="שם" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ; ?>" />
		<input type="password" name="pass" placeholder="סיסמא" value="<?= (isset($_POST['pass'])) ? $_POST['pass'] : '' ; ?>"/>
		
		<button type="submit" name="login" class="button"><i class="fas fa-hand-scissors fa-2x"></i></button>
		
		<span class="error"><?= $errorText ?></span>
		<span class="send"><?= $sendText ?></span>
		<div class="sign_in">
			<span> לא נרשמת עדיין לחץ כאן</span>
			<button type="button" class="buttonRegOrEnter button"><i class="fas fa-sign-in-alt fa-2x"></i></button>
		</div>
	</div>
</form>
<form class="formGlobal window registration" action = "<?php $_PHP_SELF; ?>" method = "POST" enctype="multipart/form-data">
	<div class="inside">
		<h2>הרשמה</h2>
		
		<input type="text" name="nameForReg" placeholder="שם" value="<?= (isset($_POST['nameForReg'])) ? $_POST['nameForReg'] : '' ; ?>" />
		<input type="email" name="mail" placeholder="אימייל" value="<?= (isset($_POST['mail'])) ? $_POST['mail'] : '' ; ?>"/>
		<input type="text" name="phone" placeholder="טלפון" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : '' ; ?>"/>
		<button type="submit" name="register" class="buttonRegOrEnter button">הרשם</i></button>
		<button type="button" class="buttonRegOrEnter button"> חזרה לכניסה </button>
		<span class="error"><?= $errorText ?></span>
	</div>
</form>
<div class="window_text"></div>
<?php// } ?>        

















