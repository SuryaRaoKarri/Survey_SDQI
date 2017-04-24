<?php

if($_REQUEST['email']!=''){

$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$conpassword = $_REQUEST['conf_password'];
$otp = $_REQUEST['OTP'];
$alertotp = $_REQUEST['otp_validate'];

if($otp == $alertotp){
		if($password == $conpassword){
			$connection = new mysqli('localhost','root','','survey');
				if(!$connection->connect_error){
					$emailQuery = $connection->query("SELECT UserID from user_credentials   where UserID = '$email'");
						if($emailQuery){
							if($emailQuery->num_rows == "1"){
								echo "3";
							}
							else echo "2";
						}
				}	
		}
		else echo "1";

	}
else echo "0";


}
?>
