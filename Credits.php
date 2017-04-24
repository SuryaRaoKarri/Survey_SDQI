<?php
session_start();
if($_SESSION['id']!=''){

	$id = $_SESSION['id'];
	$name = $_SESSION['name'];

	include 'user_nav.php';
	include 'databaseconnection.php';


	$position = strtolower($_SESSION['position']).'s';
	$credits = $connection->query("SELECT Credits from ".$position." where UserID='$id' ")->fetch_array();
	if($credits){
		echo '<div class="container"><br><br><br><h2> Current Balance : '.$credits['Credits'].'</h2></div>';
	}
	else echo '<br><br>'.$connection->error;

}

?>