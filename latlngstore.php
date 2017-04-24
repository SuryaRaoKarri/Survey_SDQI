<?php
session_start();

if($_REQUEST['latlng'] !=''){

	$_SESSION['latlng'] = $_REQUEST['latlng'];
	echo $_SESSION['latlng'];
}

?>