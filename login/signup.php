<?php

if($_POST['email']!=" "){
include "databaseconnection.php";

	$name = $_POST['name'];
	//$email = $_POST['email'];
	$email=$_POST['email'];
	$phoneno = $_POST['phoneno'];
	$gender = $_POST['gender'];
	$position = $_POST['position_sign'];
	$password = $_POST['password'];
	$conpassword = $_POST['conf_password'];
	$otp = $_POST['OTP'];
	$alertotp = $_POST['otp_validate'];
	$company = $_POST['company']; 

	$sql=$connection->query("INSERT INTO `user_credentials`(`UserID`, `Password`, `User_Name`, `Access`) VALUES ('$email','$password','$name','$position')");
		
	if($sql){
		if($position == 'Client'){
			$clientInsertion = $connection->query("INSERT INTO `clients`(`UserID`, `Credits`, `Company`, phone_no, gender) VALUES ('$email','100','$company','$phoneno','$gender')");
			if(!$clientInsertion){

				echo $connection->error;

			}
			header("Location: mainpage.html");
		}
		if($position == 'User'){
			$userInsertion = $connection->query("INSERT INTO `users`(`UserID`, `phone_no`,gender) VALUES ('$email','$phoneno','$gender')");
			if(!$userInsertion){

				echo $connection->error;

			}
			header("Location: mainpage.html");
		}	
	}
	else echo $connection->error; 
}
?>