<?php
	session_start();
	
	
	$con= mysqli_connect('localhost','root','','register');
	mysqli_select_db($con, 'register');
	
	$name = isset($_POST['username']) ? $_POST['username'] : '';
	$pass = isset($_POST['password']) ? $_POST['password'] : '';
	
	$s = "select * from users where name = '$name' && password = '$pass'";
	echo $name,$pass;
	
	$result= mysqli_query($con, $s);
	$num = mysqli_num_rows($result);
	
	if($num == 1){
		header ('location:index.php');
		
	}else{
		header('location:register.php');
		
		}
	
	
	?>