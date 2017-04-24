<?php
session_start();
$name = $_SESSION['name'];
$id   = $_SESSION['id'];


if($_REQUEST['FormID'] !=''){
include 'user_nav.php';
?>
<form action='user_form_store.php' method="POST">
<div class="container">
<?php

	$form_name = $_REQUEST['name'];
	$form_id = $_REQUEST['FormID'];
	$form_id_txt = $_REQUEST['FormID'].'.txt';
	$file = fopen('Forms/'.$form_id_txt,'r');
	$filecont = fread($file, filesize('Forms/'.$form_id_txt));
	$formcont = explode('|',$filecont);
	$type = explode(',',$formcont[0]);
	$formid = explode(',',$formcont[1]); $_SESSION['formid']=$formcont[1];
	$formname = explode(',',$formcont[2]);
	$options = explode('%',$formcont[3]);
	$_SESSION['form_ID'] = $form_id;
	echo '<br><h4>'.$form_name.'--'.$form_id.'</h4><hr>';
	echo '<input type="hidden" name="formid" value="'.$form_id.'">';
	echo '<input type="hidden" name="form_in_id" value="'.$formcont[0].'">';
	echo '<input type="hidden" name="clientid" value="'.$_REQUEST['clientid'].'">';

for($i=0;$i<sizeof($formid);$i++){

	if($type[$i]=='IF'){

	?>
	<div class="row">
	<div class="col-sm-2"><?php echo $formname[$i]; ?></div>
	<div class="col-sm-4"><input type="text" name="<?php echo $formid[$i]; ?>" required></div>
	</div>
	<?php

	}
?>
<?php 
	if($type[$i]=='RB'){
	?>	
	<br>
	<div class="row">
		<div class="col-sm-1"><?php echo $formname[$i]; ?> : </div>
		<div class="col-sm-4">
		<?php
		$op = explode(',', $options[$i]);
		for($j=0;$j<sizeof($op);$j++){
			?>
				<label><input type="radio" name="<?php echo $formid[$i]; ?>" value="<?php echo $op[$j]; ?>" required>
			<?php
			echo $op[$j].'</label>';
		}
		?>
		</div>
	</div>
	<?php
	}

?>


<?php 
	if($type[$i]=='CB'){
	?>	
	<br>
	<div class="row">
		<div class="col-sm-1"><?php echo $formname[$i]; ?> : </div>
		<div class="col-sm-4">
		<?php
		$op = explode(',', $options[$i]);
		for($j=0;$j<sizeof($op);$j++){
			?>
				<label><input type="checkbox" name="<?php echo $formid[$i].'[]'; ?>" value="<?php echo $op[$j]; ?>">
			<?php
			echo $op[$j].'</label>';
		}
		?>
		</div>
	</div>
	<?php
	}

?>


<?php 
	if($type[$i]=='DD'){
	?>	
	<br>
	<div class="row">
		<div class="col-sm-1"><?php echo $formname[$i]; ?> : </div>
		<div class="col-sm-4"><select name="<?php echo $formid[$i]; ?>" required>
		<?php
		$op = explode(',', $options[$i]);
		for($j=0;$j<sizeof($op);$j++){
			?>
			
			<option><?php echo $op[$j]; ?></option>

			<?php
			echo $op[$j];
		}
		?>
		</select>
		</div>
	</div>
	<?php
	}

?>

<?php
	if($type[$i]=='TF'){
	?>
	<br>
	<div class="row">
		<div class="col-sm-1"><?php echo $formname[$i]; ?></div>
		<div class="col-sm-4"><textarea name="<?php echo $formid[$id]; ?>" required></textarea></div>
		
	</div>
	<?php

	}

?>


<?php
}
echo '<br><br><center><button type="submit" class="btn btn-success"  name="submit" value="submit">Submit</button></center>';
echo '<hr></div></form>';
}

?>