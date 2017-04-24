<?php

$connection = new mysqli('localhost','root','','survey');
	if($connection->connect_error){
		echo $connection->connect_error;
	}
?>