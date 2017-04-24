<?php
session_start();
$_SESSION['id']='';
$_SESSION['name']='';
$_SESSION['position']='';
$_SESSION['latlng']='';

header('location: mainpage.html');
?>