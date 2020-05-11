
<?php   
	global $errorText ;
	global $sendText ;
		
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['register'])){   //if customer want register
			
			if(isset($_POST['mail']) && isset($_POST['phone']) && isset($_POST['nameForReg'])){
			
				checkMail($mail); 
				checkPhone($phone);
				checkname($nameForReg);

				checkDetailExist($mail, $phone, $nameForReg, $DetailExist);  //אם קיים שם או טלפון או מייל
	
				if($DetailExist){
					$errorText = 'השם הטלפון או המייל קיימים במערכת';
				}else{
					if($mail != '' && $phone != '' && $nameForReg != '' ){
						$pass = choicePass();
						
						$subject = 'סיסמא';
						$message = 'שלום '. $nameForReg .'הסיסמא שלך היא : ' . $pass ;
						$headers = 'From: Moshe@hasapar.com' . "\r\n" .
							'Don\'t Reply' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();

						//mail($mail, $subject, $message, $headers);   ------>  turn on with not local host
						$sendText =  " נשלח אליך למייל סיסמא ";
						echo '<br>' . $message;
						connectDbForRegis($nameForReg,$mail,$pass,$phone);
					}else{
						$errorText = 'הזן שם משתמש, מייל ומספר טלפון תקינים';
						
					}
				}
			}
		}elseif(isset($_POST['login'])){         //if customer want login
			if(isset($_POST['name']) && isset($_POST['pass'])){
				$name = htmlspecialchars($_POST['name']);
				$pass = htmlspecialchars($_POST['pass']);
				$name = filter_input(INPUT_POST, 'name');
				$pass = filter_input(INPUT_POST, 'pass');
				$pass = $_POST['pass'];
			
				if($name != '' && $pass != '' ){
					connectDbForEnter($name,$pass,$confCustomer);
					if($confCustomer == false){
						$errorText = "השם או הסיסמא אינם קיימים במערכת";
					}
				}else{
					$errorText = "הזן שם משתמש וסיסמא";
				
				}
			}
		}	
	}
	
	function checkPhone(&$phone){
		$phone = htmlspecialchars ($_POST['phone']);		
		$phone=  str_replace(['-','_',' '], "", $phone);//------phone
		$regexFphone = '/\A[\d]{7,10}\z/m';
		if(preg_match_all($regexFphone, $phone)){
			return $phone;
		}else{
			$phone = '';
			return $phone;
		}
	}
	function checkMail(&$mail){
		$mail = htmlspecialchars ($_POST['mail']);
		$regexMail = "/^([a-zA-Z0-9_]{2,})\@([a-zA-Z0-9_]{2,})(\.([a-zA-Z0-9_]{2,})){1,2}$/";
		if(preg_match_all($regexMail, $mail)){
			return $mail;
		}else{
			$mail = '';
			return $mail;
		}
	}
	function checkname(&$nameForReg){
		$nameForReg = htmlspecialchars ($_POST['nameForReg']);
		return $nameForReg;
		
	}
	
	function checkDetailExist($mail, $phone, $nameForReg ,&$DetailExist){
		createConnection($conn);
		
		$sql = "SELECT name, email, phone_number
		FROM customer 
		WHERE name = '$nameForReg'
		OR phone_number = '$phone'
		OR email = '$mail'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$DetailExist = true;
			
		}else{
			//echo 'its not exist';
		}
		$conn->close(); 
	}
	
	function choicePass(){
		
		$alphabet = 'abcdefghijklmnopqrstuvwxyz@$&ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); 
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		$pass = implode($pass); //turn the array into a string
		return $pass;  
	}	

	function connectDbForRegis($nameForReg,$mail,$pass,$phone){
		createConnection($conn);	
		$nameForReg = mysqli_real_escape_string($conn,$nameForReg);
		$mail = mysqli_real_escape_string($conn,$mail);
		$phone = mysqli_real_escape_string($conn,$phone);
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		
		$sql = "INSERT INTO customer (name, email, password, phone_number)
		VALUES ('$nameForReg', '$mail', '$pass', '$phone')";

		if ($conn->query($sql) === TRUE) {
			echo "<br> New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close(); 
		
	}
	function connectDbForEnter($name,$pass,&$confCustomer){
		createConnection($conn);
		$name = mysqli_real_escape_string($conn,$name);
		$pass = mysqli_real_escape_string($conn,$pass); 
		
		
		$sql = "SELECT * 
				FROM customer 
				WHERE name = '$name'";
		$result = mysqli_query($conn, $sql);
		if($result == false){
			$confCustomer = false;  //לא בשימוש
			return $confCustomer;    //לא בשימוש
			
		}elseif($result == true){
			
			$passFromDB = mysqli_fetch_assoc($result);
			$passwordHash = $passFromDB['password'];
			$passCheck = password_verify( $pass, $passwordHash );
			
			
			if($passCheck){
				$confCustomer = true;   //לא בשימוש
				$_SESSION["logged"] = true;
				$_SESSION["customerName"] = $name; 
				
				$sql = "SELECT id 
					FROM customer 
					WHERE name = '$name' limit 1";
					//$id = $result  ;
				$result = mysqli_query($conn, $sql);
				//$value = mysqli_fetch_field($result);  
				$row = $result->fetch_assoc();
				$_SESSION["customerID"] = $row['id'];
				return $confCustomer;   //לא בשימוש
				
			}
		}
		
		$conn->close();
	} 
	
	function createConnection(&$conn){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "moshehasapar";
			// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);   //רק בבניה להראות error
		}
			
	}
	
	
	
