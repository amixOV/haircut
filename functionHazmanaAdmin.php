<?php 

	if(isset($_POST['startDay'])){
		$timeDaySTR = $_POST['startDay'];
		$timeDayFNSH = $_POST['finishDay'];
		$adminMessage = '';
		checkTime($timeDaySTR);
		checkTime($timeDayFNSH);
		$past = false;
		if($timeDaySTR  !='' && $timeDayFNSH !=''){
			//checkIfPast($timeDaySTR, $past);  //   צריך לייחס לזמן הקיים
			if($past == false){
				enterChangeDay($day, $timeDaySTR, $timeDayFNSH, $adminMessage);
			}else{
				echo "אי אפשר לשנות את מה שהיה";
				die;
			}
		}else{
			die;
		}
	}

	if(isset($_POST['pushTor'])){
		$pushTor = $_POST['timeTorCancel'];
		checkTime($pushTor);	
		checkDay($day);
		pushTor($day, $pushTor);
	}

	


	function pushTor($day, $pushTor){
		$adminTor = $pushTor;
		createConnection($conn);
		
		do{
			$sql = "SELECT order_id
			FROM orders
			WHERE day = '$day'
			AND time = '$pushTor'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) > 0){
				$order_id[] = $result->fetch_assoc();
				$pushTor = strtotime($pushTor)+20*60;
				$pushTor =  date("H:i", $pushTor);
			}
		}while(mysqli_num_rows($result) > 0);
		
		foreach($order_id as $id){
			foreach($id as $id){
				$sql_up = "UPDATE orders
				SET time = DATE_ADD(time, INTERVAL 20 MINUTE)
				WHERE order_id = '$id'";
				
				if ($conn->query($sql_up) === FALSE) {
					echo "Error updating record: " . $conn->error;
				}
			} 
		}
		$sql_admin_tor = "INSERT INTO orders (day, time, customer)
				VALUES ('$day', '$adminTor', '8')"; 
			if ($conn->query($sql_admin_tor) === TRUE) {//  '8' moshe`s ID
				//$_SESSION['pushTor'] = $adminTor;  //start session to avoid refresh
			}else{
				echo "Error updating record: " . $conn->error;
			}
		$conn->close();
		 header("location:/mosheHasapar/destroy_post.php");
	}
	
	function checkIfPast($stringTime, &$past){ //   צריך לייחס לזמן הקיים
		$stringTime = strtotime($stringTime);
		echo '<br> post time - ' . $stringTime;
		$now = time();
		echo '<br> now - ' .$now;
		if($stringTime > $now){
				$past = false;
		}else{
			$past = true;
		}
		return $past;
	}
	
	function enterChangeDay($day, $timeDaySTR, $timeDayFNSH, $adminMessage){
		createConnection($conn);
		$sql = "SELECT day 
				FROM admin_change 
				WHERE day = '$day'";
			
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) > 0){
			$sql = "UPDATE admin_change SET day_start='$timeDaySTR' , day_end='$timeDayFNSH' , admin_message='$adminMessage' WHERE day='$day'";
			
			if($conn->query($sql) === FALSE){
				echo "Error: " . $sql . "<br>" . $conn->error;   //turn off
			}
		}else{
			$sql = "INSERT INTO admin_change (day, day_start, day_end, admin_message)
			VALUES ('$day', '$timeDaySTR', '$timeDayFNSH', '$adminMessage')";
			
			if($conn->query($sql) === FALSE){
				echo "Error: " . $sql . "<br>" . $conn->error;   //turn off
			}
		}
		$conn->close();
	}
	
	calNum($timeDaySTR, $timeDayFNSH, $numOfTor);
	function hazmanaAdminTable($day, $numOfTor, $timeSTR, $id){
		createConnection($conn);
			$timeSTR  = strtotime($timeSTR);
			
				while ($numOfTor > 0){
					$pORt = "PANUY";
					$timeTorFNSH = $timeSTR + (20*60) ; 
					$timeTorSTR = date("H:i", $timeSTR) ; 
					$timeTorFNSH = date("H:i", $timeTorFNSH) ;
					
					$sql_time = "SELECT  * 
							FROM orders 
							WHERE day = '$day'
							AND time = '$timeTorSTR'";
					
					$result = mysqli_query($conn, $sql_time);
					if(mysqli_num_rows($result) > 0){  //אם קבעו תור בשעה הזאת
						$pORt = "TAFUS";
					}
					
					echo"<tr>
							<td>". $timeTorSTR . "-" . $timeTorFNSH . "</td>";
						
					if($pORt == 'PANUY'){      // אם התור פנוי בשעה הזאת
					
						echo"<td>
								<form onsubmit='return confirm(`Do you really want to " . $timeTorSTR . " ?`);' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
									<input type='hidden' name='timeTorSTR' value='". $timeTorSTR ."' />
									<input type='hidden' name='timeTorFNSH' value='" . $timeTorFNSH . "' />
									<input type='hidden' name='day' value='" . $day . "' />
									<button class='button' type='submit' value='hazmana'><span>תפוס תור</span></button>
								</form>
							</td>
						</tr>";
						
					}elseif($pORt == 'TAFUS'){
						
						$sql_id = "SELECT * 
						FROM orders 
						WHERE time = '$timeTorSTR'
						AND day = '$day'";
						//AND customer = '$id'";
						
						$result = mysqli_query($conn, $sql_id);
						//$value = mysqli_fetch_field($result);  
						$row = $result->fetch_assoc();
						$customerId = $row['customer'];
						
						$sql_customer = "SELECT * 
						FROM customer 
						WHERE id = '$customerId'";
						
						$result = mysqli_query($conn, $sql_customer);
						//$value = mysqli_fetch_field($result);  
						$row = $result->fetch_assoc();
						$customerName = $row['name'];
						$customerPhone = $row['phone_number'];
						$customerMail = $row['email'];
						
						echo"
							<td>
								<form onsubmit='return confirm(`Do you really want to delete " . $timeTorSTR . " ?`);' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
									<input type='hidden' name='timeTorCancel' value='". $timeTorSTR ."' />
									<input type='hidden' name='timeTorCancelFNSH' value='" . $timeTorFNSH . "' />
									<input type='hidden' name='day' value='" . $day . "' />
									<button class='button cancel' type='submit' name='cancelTor' >בטל תור</button>
									<button class='button cancel' type='submit' name='pushTor' >דחוף תור</button>
								</form>
							</td>
							<td class='button_detail'> " . $customerName . " <br><button class='button'> פרטים </button>
							<div class='hidden_detail'> מס טלפון -  " . $customerPhone  . 
							"<br> המייל הוא - " . $customerMail . " </div></td>
							<td> <a href='https://wa.me/" . $customerPhone . "/?text=urlencodedtext'><i class='fab fa-whatsapp fa-2x'></i></a></td>
							<td><a href='tel:" . $customerPhone  . "'><i class='fas fa-phone-square fa-2x'></i></a></td>
							
						</tr>";
						
					}	
					$numOfTor = $numOfTor - 1;
					$timeSTR = $timeSTR + (20*60);
					$timeTorSTR = $timeSTR;
					
				}    //  --------- - >  end while
				
				
		$conn->close();
	}
	
				
				
				




