<?php
session_start();
if($_SESSION['id'] !='' && $_SESSION['position'] == 'User'){

$name = $_SESSION['name'];
include 'user_nav.php';
include 'databaseconnection.php';

$coupons = $connection->query("SELECT * FROM coupons");

while($row = $coupons->fetch_array()){
	$name = $row['Name'];
	$cost = explode('%',$row['Cost']);
	$des  = explode('-',$row['Description']);
	$exp  = explode('%',$row['Expiration']);
	?>
	<br><br><br>
	<div class="container">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Validity</th>
					<th>Cost</th>
					<th>Buy</th>
				</tr>
			</thead>
			<tbody>

			<?php
			for($i=0;$i<sizeof($cost);$i++){
				?>
				<tr>
					<td><?php echo $name; ?></td>
					<td><?php echo $des[$i]; ?></td>
					<td><?php echo $exp[$i].' Months'; ?></td>
					<td><?php echo $cost[$i]; ?></td>
					<td><button id="<?php echo $name; ?>" value="$i" class="btn">Purchase</button></td>
				</tr>
				<?php
			}

			?>
<?php
}	

}

?>