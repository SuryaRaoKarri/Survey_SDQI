<?php


if($_REQUEST['username'] != ''){
	include "databaseconnection.php";
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$position = $_REQUEST['position'];

	
	$user =$connection->query("SELECT * FROM user_credentials WHERE UserID ='$username' AND Access = '$position'"); 

			if($user->num_rows == '1'){
				
				while ($row = $user->fetch_array()) {
					
					if($password == $row['Password']){
						session_start();
						$_SESSION['id'] = $username;
						$_SESSION['name'] = $row['User_Name'];
						$_SESSION['position'] = $position;

						if($position == 'User'){
							echo "user_login";
						}
						else if($position == 'Client'){
							echo "client_login";
						}
						else if($position == 'Admin'){
							echo "admin_login";
						}


					}
					else echo 'invalid password';
				}
			}	
			else  echo "invalid user";
		
		


}





/*if($_POST['username'] != '')
{
	$username = $_POST['username'];
	$password = $_POST['Password'];
	
	include "databaseconnection.php";	
	$passwordmMatch = $connection->query("SELECT password FROM user_credentials WHERE userID ='$username'")->fetch_array();
		echo $passwordmMatch['password'];

}	*/	

?>