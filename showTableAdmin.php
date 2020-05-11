

<?php
	if($_POST['torAdmin']=='tableOrder'){
		$selectName = 'select'.$_POST['torAdmin'];
		$arrToSelect =array(
			array('time','תחילת התור'),
			array('day','יום'),
			array('id','שם הלקוח'),
			array('order_time','שעת ההזמנה')
		);
		selectFunction($arrToSelect, $selectName);
		showTableOrders();
	
	}elseif($_POST['torAdmin']=='tableCustomer'){
		$selectName = 'select'.$_POST['torAdmin'];
		$arrToSelect =array(
			array('name','שם הלקוח'),
			array('phone_number','טלפון'),
			array('email','אימייל')
		);
		selectFunction($arrToSelect, $selectName);
		showTableCustomer();
		
	}elseif($_POST['torAdmin']=='tableChange'){
		$selectName = 'select'.$_POST['torAdmin'];
		$arrToSelect =array(
			array('day','יום'),
			array('day_start','תחילת יום'),
			array('day_end','סוף יום')
		);
		selectFunction($arrToSelect, $selectName);
		showTableChange();
	}
	
	
	function selectFunction($arr, $selectName){
		echo '<select onchange="this.form.submit()" name="'.$selectName.'">';
		foreach($arr as $optionArr){
			echo '<option onchange="this.form.submit()" value="' .$optionArr[0]. '">' .$optionArr[1]. '</option>';
		}
		echo '</select>';
	}
	
	function showTableChange(){
		if(isset($_POST['selectChange'])){
			$var = $_POST['selectChange'];
		}else{
			$var = 'day';
		}
		createConnection($conn);
		$sql = "SELECT *
				FROM admin_change
				ORDER BY `$var` ";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) > 0){
			$row = $result->fetch_assoc();
			while ($row = $result->fetch_assoc()) {
				?>
				<tr>
					<td>
						<?=$row['day']?>
					</td>
					<td>
						<?=$row['day_start']?>
					</td>
					<td>
						<?=$row['day_end']?>
					</td>
				</tr>
				
				<?php
				//var_dump ($row);
			}
		}else{
			echo "Error: " . $conn->error;
		}
		
	}
		
	
	function showTableCustomer(){
		if(isset($_POST['selectCustomer'])){
			$var = $_POST['selectCustomer'];
		}else{
			$var = 'name';
		}
		createConnection($conn);
		$sql = "SELECT *
				FROM customer
				ORDER BY `$var` ";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) > 0){
			$row = $result->fetch_assoc();
			while ($row = $result->fetch_assoc()) {
				?>
				<tr>
					<td>
						<?=$row['name']?>
					</td>
					<td>
						<?=$row['phone_number']?>
					</td>
					<td>
						<?=$row['email']?>
					</td>
				</tr>
				
				<?php
				//var_dump ($row);
			}
		}else{
			echo "Error: " . $conn->error;
		}
		
	}
	function showTableOrders(){
		//echo $_POST['']
		if(isset($_POST['selecttableOrder'])){
			$var = $_POST['selecttableOrder'];
			
		}else{
			$var = 'order_time';
		}
		echo $var;
		createConnection($conn);  //orders.customer, customer.id
		$sql = "SELECT *
				FROM orders
				INNER JOIN customer ON customer.id =  orders.customer
				ORDER BY `$var` ";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) > 0){
			$row = $result->fetch_assoc();
			while ($row = $result->fetch_assoc()) {
				?>
				<tr>
					<td>
						<?=$row['name']?>
					</td>
					<td>
						<?=$row['time']?>
					</td>
					<td>
						<?=$row['day']?>
					</td>
					<td>
						<?=$row['phone_number']?>
					</td>
					<td>
						<?=$row['email']?>
					</td>
					<td>
						<?=$row['order_time']?>
					</td>
				</tr>
				
				<?php
				//var_dump ($row);
			}
		}else{
			echo "Error: " . $conn->error;
		}
			
	}
?>