<?php

if(isset($_REQUEST['record_type'])){

include 'databaseconnection.php';

session_start();
$id = $_SESSION['id'];
//$id = '123@gmail.com';

	$form_in = array();

	$form_in[0] 	= 	$_REQUEST['record_type'];
	$form_in[1]		=	$_REQUEST['record_id'];
	$form_in[2]		=	$_REQUEST['record_name'];
	$form_in[3]		=	$_REQUEST['record_value'];
	$form_in[4] 	=	$_REQUEST['record_req'];
	$formname		=	$_REQUEST['formname'];
	$formdes 		=	$_REQUEST['formdes'];
	$location 		=	$_REQUEST['location'];
	$latlng 		=	$_REQUEST['lat'].','.$_REQUEST['lng'];
	$date 			=	date('d/m/y');

	$form_data	 = 	implode('|',$form_in);

	$id_num_sql = $connection->query("SELECT Num FROM Temp where ID='ID'");
	if($id_num_sql){
		$id_num = $id_num_sql->fetch_assoc();
		$num = $id_num['Num'];
		$file_name = $num.'.txt';
		$file_loc =	fopen('Forms/'.$file_name,'w');
		fwrite($file_loc, $form_data);

		$form_get = $connection->query("SELECT * FROM Clients WHERE UserID='$id'")->fetch_array();
		
		if($form_get['Forms'] != ''){
			$form_data_db	= 	$form_get['Forms'].'%'.$num;
			$formname		=	$form_get['Formname'].'%'.$formname;
			$formdes 		=	$form_get['Form_Des'].'%'.$formdes;
			$date 			=	$form_get['Form_Date'].'%'.$date;
			$location		=	$form_get['Location'].'%'.$location;
			$latlng 		=	$form_get['LatLng'].'%'.$latlng;		
		}
		else{ 
				$form_data_db	=	$num;
				 }
	//Update Form value 
			$form_update = $connection->query("UPDATE Clients SET Forms='$form_data_db',Formname='$formname',Form_Des='$formdes',Form_Date='$date',Location='$location',LatLng='$latlng' WHERE UserID='$id'");
				if($form_update){
					
					echo "FORM ID :".$num;
					
						$num++;
					//Update Number value in the temp table to get value for other form.
						$num_update = $connection->query("UPDATE Temp SET Num='$num' WHERE ID='ID'");
						
						if(!$num_update){
							echo $connection->error;
						}
					//
				}
				else echo $connection->error;
				
	//		
	
	}
	else echo $connection->error;

}

?>