<?php   
	
	if(isset($_POST['timeTorSTR'],$_SESSION['timeTorSTR'],$_POST['day'],$_SESSION['day'])){ // בדיקה אם כבר נרשם for refresh after 
		if($_SESSION['timeTorSTR'] == $_POST['timeTorSTR']&& $_SESSION['day'] == $_POST['day']){
				header("Location: ".$_SERVER['PHP_SELF']);
				die;
		}
	}
	date_default_timezone_set("Asia/Jerusalem");
	$id	= $_SESSION["customerID"];
	$thisDay = date('Y-m-d');
	
	$day = 	$thisDay;
	$timeTorSTR = '';
	$timeTorFNSH = '';
	//$timeTorCancel = '';
	$timeDaySTR = '';
	$timeDayFNSH = '';
	$hebDay = '';
	$messege = '';
	$dayPart = dayPart();
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		
		if(isset($_POST['day'])){
			$day = $_POST['day'];
			checkDay($day);
		}
		
		if(isset($_POST['timeTorSTR'])){
			$timeTorSTR = $_POST['timeTorSTR'];
			$timeTorFNSH = $_POST['timeTorFNSH'];
			checkTime($timeTorSTR);
			checkTime($timeTorFNSH);
			checkTimeExist($timeTorSTR, $day);
			
			if($timeTorSTR != '' && $timeTorFNSH != '' && $day != ''){     // insert tor to DataBase
				insertTor($day, $timeTorSTR, $timeTorFNSH, $id);
			}
		}
		
		if(isset($_POST['cancelTor'])){
			$timeTorCancel = $_POST['timeTorCancel'];
			checkTime($timeTorCancel);	
			checkDay($day);	
			if($timeTorCancel != ''){         //delete tor from DataBase
			cancelTor($day, $timeTorCancel, $timeTorSTR);
			}
		}
		
	}  //  end if POST REQUEST_METHOD
	
	function checkDay(&$day){
		createConnection($conn);
		$day = 	htmlspecialchars($_POST['day']);
		$day = $conn -> real_escape_string($day);
		$regexDay =  '/\A[\d]{4}-[\d]{2}-[\d]{2}\z/m';
		
		if(!preg_match_all($regexDay, $day)){
			$day = '';
		}
		$conn->close();
		return $day;
	}
	
	function checkTime(&$time){
		createConnection($conn);
		$time = htmlspecialchars($time);
		$time = $conn -> real_escape_string($time);
		$regexTime =  '/\A([\d]{2}:[\d]{2}|[\d]{2}:[\d]{2}:[\d]{2})\z/m';  
		
		if(!preg_match_all($regexTime, $time)){
			$time = '';
		}
		
		$conn->close();
		return $time;
	}
	
	function checkTimeExist($time, $day){
		createConnection($conn);
		$sql_time = "SELECT  * 
				FROM orders 
				WHERE time = '$time'
				AND day = '$day'";
		
		$result = mysqli_query($conn, $sql_time);
		if(mysqli_num_rows($result) > 0){
			$conn->close();
			echo "ה-IP שלך נרשם";
			die;
		}
	}
	
	
	$weekDay = date('D', strtotime($day));
	weekDay($weekDay, $timeDaySTR, $timeDayFNSH, $hebDay);
	checkDayChangeExist($day, $timeDaySTR, $timeDayFNSH);
	
	function weekDay($weekDay, &$timeDaySTR, &$timeDayFNSH, &$hebDay){
		if ($weekDay == 'Sun'){
			 $timeDaySTR = '09:00';
			 $timeDayFNSH = '19:00';
			 $hebDay = 'יום ראשון';
		
		}elseif($weekDay == 'Mon' ){
			$timeDaySTR = '09:00';
			$timeDayFNSH = '15:00';
			$hebDay = 'יום שני';
		
		}elseif( $weekDay ==  'Tue'){
			 $timeDaySTR = '09:00';
			 $timeDayFNSH = '19:00';
			 $hebDay = 'יום שלישי';
		
		}elseif($weekDay ==  'Wed'){
			 $timeDaySTR = '09:00';
			 $timeDayFNSH = '19:00';
			 $hebDay = 'יום רביעי';
			
		}elseif($weekDay == 'Thu'){
			 $timeDaySTR = '09:00';
			 $timeDayFNSH = '19:00';
			 $hebDay = 'יום חמישי';
		
		}elseif($weekDay == 'Fri' ){
			$timeDaySTR = '09:00';
			$timeDayFNSH = '14:00';
			$hebDay = 'יום שישי';
		
		}elseif($weekDay == 'Sat' ){
			$timeDaySTR = '00:00';
			$timeDayFNSH = '00:00';
			$hebDay = 'מוצאי שבת';
		}
	}
	
	function checkDayChangeExist($day, &$timeDaySTR, &$timeDayFNSH){
		createConnection($conn);
		$sql = "SELECT * 
				FROM admin_change 
				WHERE day = '$day'";
		
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			
			$row = $result->fetch_assoc();
			$timeDaySTR = $row['day_start'];
			$timeDayFNSH = $row['day_end'];
		}
		$conn->close();
	}
	function insertTor($day, $timeTorSTR, $timeTorFNSH, $id){
		$doEcho = false;
		ifTorExist($id, $numTor, $doEcho);
		if ($numTor<6){
			createConnection($conn);
				
			$sql = "INSERT INTO orders (day, time, customer)
					VALUES ('$day', '$timeTorSTR', '$id')";

			if ($conn->query($sql) === TRUE) {
				$messege = ' קבעת תור ליום - ' . $day . '<br> בשעה -' . $timeTorSTR . '<br>  עד שעה -' . $timeTorFNSH ;
				$_SESSION['timeTorSTR'] = $timeTorSTR;  //start session to avoid refresh
				$_SESSION['day'] = $day;
				// cookieForMessege($day, $timeTorSTR);
				// echo $day . ":" . $timeTorSTR . "<br>";
			}else{
				echo "Error: " . $sql . "<br>" . $conn->error;   //turn off
			}
			$conn->close();
		}else{
			echo '<script>alert("you can\'t order so many tor");</script>';
		}
	}
	
	function ifTorExist($id, &$numTor, $doEcho){
		createConnection($conn);
		$dayToCheck = date('Y-m-d', time());
		$hourToCheck = date('H:i', time());
		$sql_check = "SELECT  * 
					  FROM orders 
					  WHERE customer = '$id'
					  AND day >= '$dayToCheck'";
		
		$result = mysqli_query($conn, $sql_check);
		if($doEcho){
			if(mysqli_num_rows($result) > 0){
				echo "<button class='button_messege button'>יש לך תור</button>";
			}
			echo "<div class ='tor_messeges'>";
		}
		$numTor = 0;
		while ($row = $result->fetch_assoc()) {
			if($doEcho){
				echo "<div>  יש לך תור ביום - " . $row['day'] . "<br> בשעה - " . $row['time'] . "<hr></div>";
			}
			$numTor = $numTor+1;
			}
			if($doEcho){
				echo "</div>";
			}
			$conn->close();
	}			
		
	function cookieForMessege($day, $timeTorSTR){
		$today = strtotime('today');
		$timeDay = strtotime($day);
		$timeTimeTorSTR = strtotime($timeTorSTR);
		$cookieTime = $timeTimeTorSTR - $today + $timeDay;
		$dayForMessege=[];
		$timeForMessege=[];
		
		if(isset($_COOKIE['dayForMessege'])){
			$i = count($_COOKIE['dayForMessege']);
		}else{
			$i = 0;
		}	
		setcookie('dayForMessege[' .$i. ']', $day, $cookieTime, "/");
		setcookie('timeForMessege[' .$i. ']', $timeTorSTR, $cookieTime, "/");
	}
	// if(isset($_COOKIE['dayForMessege'])){
		// $i = count($_COOKIE['dayForMessege']);
		// while($i>0){
			// echo $_COOKIE['dayForMessege'][$i-1] . ":" . $_COOKIE['timeForMessege'][$i-1] . "<br>";
			// $i = $i-1;
		// }
	// }
	function cancelTor($day, $timeTorCancel, $timeTorSTR){
		createConnection($conn);
		$sql = "DELETE FROM orders 
			WHERE time = '$timeTorCancel'
			AND day = '$day'";
			
		if ($conn->query($sql) === TRUE) {
			$messege = " התור ליום -  " . $day ." <br>  בשעה -  " . $timeTorCancel . " בוטל";
			$_SESSION['timeTorSTR'] = $timeTorSTR;  //start session to avoid if customer insert and delete and want to insert again
			$_SESSION['day'] = $day;
			
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
		
	calNum($timeDaySTR, $timeDayFNSH, $numOfTor);

	function calNum($str, $fnsh, &$numOfTor){  //לחשב כמה  תורות יש באותו יום
		
		$str = strtotime($str);
		$fnsh = strtotime($fnsh);
		$dayTime = $fnsh - $str;
		$numOfTor = $dayTime/20/60;
		return $numOfTor;
	}

	function hazmanaTable($day, $numOfTor, $timeSTR, $id){     //יצירת טבלת תורות
		createConnection($conn);
		$timeSTR  = strtotime($timeSTR);
		
			while ($numOfTor > 0){
				$pORt = "פנוי";
				$timeTorFNSH = $timeSTR + (20*60) ; 
				$timeTorSTR = date("H:i", $timeSTR) ; 
				$timeTorFNSH = date("H:i", $timeTorFNSH) ;
				
				$sql_time = "SELECT  * 
						FROM orders 
						WHERE day = '$day'
						AND time = '$timeTorSTR'";
				
				$result = mysqli_query($conn, $sql_time);
				if(mysqli_num_rows($result) > 0){   //אם קבעו תור בשעה הזאת
					$pORt = "תפוס";
				}
				echo"<tr>
						<td>". $timeTorSTR . "-" . $timeTorFNSH . "</td>
						<td>" . $pORt . "</td>";
					
				if($pORt == 'פנוי'){      // אם התור פנוי בשעה הזאת
				
					echo"<td>
							<form onsubmit='return confirm(`Do you really want to " . $timeTorSTR . " ?`);' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
								<input type='hidden' name='timeTorSTR' value='". $timeTorSTR ."' />
								<input type='hidden' name='timeTorFNSH' value='" . $timeTorFNSH . "' />
								<input type='hidden' name='day' value='" . $day . "' />
								<button type='submit' class='button'>הזמן תור</button>
							</form>
						</td>
					</tr>";
					
				}elseif($pORt != 'פנוי'){
					$sql_id = "SELECT customer 
					FROM orders 
					WHERE time = '$timeTorSTR'
					AND day = '$day'
					AND customer = '$id'";
					
					$result = mysqli_query($conn, $sql_id);
					//$value = mysqli_fetch_field($result);  
					$row = $result->fetch_assoc();

					if($pORt == 'תפוס' && $id == $row['customer']){  //  אם המשתמש קבע בשעה הזאת 
				
						echo"<td>
								<form onsubmit='return confirm(`Do you really want to delete " . $timeTorSTR . " ?`);' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
									<input type='hidden' name='timeTorCancel' value='". $timeTorSTR ."' />
									<input type='hidden' name='timeTorCancelFNSH' value='" . $timeTorFNSH . "' />
									<input type='hidden' name='day' value='" . $day . "' />
									<button type='submit' name='cancelTor' class='button cancel'>בטל תור</button>
								</form>
							</td>
						</tr>";
					
					}
				}	
				$numOfTor = $numOfTor - 1;
				$timeSTR = $timeSTR + (20*60);
				$timeTorSTR = $timeSTR;
				
			}    //  --------- - >  end while
			
			
	$conn->close();	
	}
	
	
	function selectDay($day, $hebDay){  //select another day from this day to 6 day ahead
		echo "    
					<option>בחר יום אחר</option>
				";
		for($i = 0; $i < 7; $i++){
			
				$weekDay = date('D', strtotime($day));
				weekDay($weekDay, $tDS, $tDF, $hebDay);
			if($hebDay != "יום שבת"){
				echo "    
					<option value ='" . $day . "'>" . $day . ' - ' . $hebDay . "</option>
				";
			}	
			$day = strtotime($day);
			$day = $day + 60*60*24;
			$day = date('Y-m-d', $day);
			 
		}
	}
	
	function dayPart(){
		$time = date('H');
		if($time >= 5 && $time < 12){
			$dayPart = "בוקר טוב";
		}elseif($time >= 12 && $time < 18){
			$dayPart = "צהריים טובים";
		}elseif($time >= 18 && $time < 21){	
			$dayPart = "ערב טוב";
		}elseif(($time >= 21 && $time <= 24) || $time < 5 ){	
			$dayPart = "לילה טוב";
		}
		return $dayPart;
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>
