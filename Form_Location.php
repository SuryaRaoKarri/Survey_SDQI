<?php
session_start();

$name = $_SESSION['name'];

	if($_SESSION['id'] !='' && $_SESSION['position'] ==	'Client'){
	include 'Client_nav.php';
?>
		<br><br><br><br>
		<form action="Form_Create.php" onsubmit="return getloc()" id="create" method="POST">
			<center>
				Location : <input type="text" name="client_location" id='location' required>
				
				<input type="submit" class="btn" style="margin-left: 20px;" name="submit"  value="GO" >
			</center>
		</form>

		<script type="text/javascript">
			var	inp 	=	document.getElementById('location');
			var address = 	new google.maps.places.Autocomplete(inp);

			function getloc(){
				var geocoder = new google.maps.Geocoder();
		        var address = document.getElementById('location').value;
		        
		        geocoder.geocode( { 'address': address }, function(results, status) {
		        
		          	if (status == google.maps.GeocoderStatus.OK) {
		           		

		                window.location='Form_Create.php?location='+$('#location').val()+'&lat='+results[0].geometry.location.lat()+'&lng='+results[0].geometry.location.lng();
					}
				});

		    
		      return false;
			}
			
		</script>

<?php
	}
?>