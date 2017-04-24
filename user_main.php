
<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if($_SESSION['id'] != '' && $_SESSION['position']=='User'){

	$name		=	$_SESSION['name'];
	$id 		=	$_SESSION['id'];
	$latlng		=	explode(',',$_SESSION['latlng']);
	$lat2  		=	$latlng[0];
	$lng2 		=	$latlng[1];

	include 'user_nav.php';
	include 'databaseconnection.php';
	echo '<br><br><br>';
?>
<div class="container">
	

<?php

//User filled forms
	$filled_forms = $connection->query("SELECT FilledForms , Credits from users where UserID='$id'")->fetch_array();

	$_SESSION['credits'] = $filled_forms['Credits'];
	$_SESSION['filled_forms'] = $filled_forms['FilledForms'];
//

//Filter the forms based in location 
	$forms = $connection->query("SELECT * from clients limit 10");

	while($row = $forms->fetch_array()){

		$formsID  = explode('%',$row['Forms']);
		$formname = explode('%',$row['Formname']);
		$formdes  = explode('%',$row['Form_Des']);
		$date     = explode('%',$row['Form_Date']);
		$form_loc = explode('%',$row['LatLng']);
		$user_filled_forms = explode('%', $filled_forms['FilledForms']);
		for($i=0;$i<sizeof($form_loc);$i++){
			
			$dup = 'a';
			$form_loc_latlng = explode(',', $form_loc[$i]);		
			$lat1 = $form_loc_latlng[0];
			$lng1 = $form_loc_latlng[1];
			$dup  = array_search($formsID[$i], $user_filled_forms);
			$dist =rad2deg( acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lng1-$lng2))))*60*1.1515*1.609344; 
			
			if($dist < 100 && $dup !='a' ){
				echo '<div class="col-sm-4">
						<div class="panel panel-info">
     	 					<div class="panel-heading">'.$formname[$i].'</div>
      						<div class="panel-body">
      						Form Description : '.$formdes[$i].'<br><br>
      						Date : '.$date[$i].'<br><button class="btn pull-right" name="'.$row['UserID'].'" id="'.$formname[$i].'" value="'. $formsID[$i].'" onclick="Redirect(this.value,this.id,this.name);">Open</button>
      						</div>
    					</div>
					</div>';
				//echo '<tr><td>'..'</td><td>'..'</td><td>'..'</td><td></td></tr>';
			}

		}

	}

//

?>
		
<script type="text/javascript">
	function Redirect(loc,formname,clientid){

		window.location ="Form_Show.php?FormID="+loc+"&name="+formname+"&clientid="+clientid;

	}
</script>


		

<?php 
//echo $filled_forms['FilledForms'];
} 
?>
<script type="text/javascript">
	
navigator.geolocation.getCurrentPosition(showPosition);
function showPosition(position) {

	var pos = position.coords.latitude+','+position.coords.longitude;
	//Store User Location in session 
		http = new XMLHttpRequest();
		http.open('GET','latlngstore.php?latlng='+pos,true);
		http.send();
	//
}

</script>
