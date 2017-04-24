<?php
session_start();
if(isset($_POST['submit'])){
	
	include 'databaseconnection.php';
	
	$formids =	explode(',',$_SESSION['formid']);
	$formid	 =  $_POST['formid'];
	$form_in =	explode(',',$_POST['form_in_id']);
	$clientid = $_POST['clientid'];

	$initial =0;

	for($i=0;$i<sizeof($formids);$i++){
		if($form_in[$i]=='CB'){
			$val = implode(',',$_POST[$formids[$i]]);
		}
		else $val = $_POST[$formids[$i]];

		if($initial==0){
			
			$form_data = $form_in[$i].'='.$val;
			$initial++;
		}
		else{

			$form_data = $form_data.'|'.$form_in[$i].'='.$val;
		}



	}


		$form_data=$_SESSION['form_ID'].'-'.$form_data;

	$form_data_sql = $connection->query("SELECT * FROM clients where UserID='$clientid' ")->fetch_array();
	$fill_result = $form_data_sql['Form_Result'];
	$credits = $form_data_sql['Credits'];

	if($fill_result !=''){
			$fill_result = $fill_result.'%'.$form_data;
	}
	else $fill_result = $form_data;
	
	//Deduct credits from clients
	$credits = $credits-10;
	$connection->query("UPDATE clients set Form_Result='$fill_result',Credits='$credits' where UserID='$clientid'");

	//Add credits to the user
	$id = $_SESSION['id'];
	$credits = $_SESSION['credits']+10;
	$forms_add = $_SESSION['filled_forms'].'%'.$_SESSION['form_ID'];
	$connection->query("UPDATE users set Credits='$credits',FilledForms='$forms_add' where UserID='$id'");
	header('Location: user_main.php');
	
}
?>