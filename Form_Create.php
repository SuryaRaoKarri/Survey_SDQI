<?php

session_start();
$id 	=	$_SESSION['id'];
$name	=	$_SESSION['name'];

	if($id !=	''){

		if($_REQUEST['location'] !='' && $_SESSION['position']=='Client'){
			$location = $_REQUEST['location'];
			$lat = $_REQUEST['lat'];
			$lng = $_REQUEST['lng'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>

  <style>

  	.button_color{
    background-color: #008060;
  	}

  	.vertical{
		border-right: 3px solid black;
		height: 100%

	}
	.left-space{
		margin-left: 20px;
	}
  
  </style>
</head>

<body>
  <nav class= "navbar navbar-inverse navbar-fixed-top button_color" padding="20px">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-inline">
          <li><a  style="color: black;">Home</a></li>
         <li><a  style="color: black;"><select class="button_color" onchange="Redirect_mainpage(this.value)">
          											<option>Forms</option>
          											<option>View</option>
          											<option>Create</option>
          											<option>Edit</option>
          											<option>Delete</option>
          									</select></a></li>
          <li><a href="" style="color: black;">Stats</a></li>
          <li><a href="" style="color: black;">Credits</a></li>
          <li><a href="" style="color: black;">User Feedback</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a><select class="button_color" onchange="Profile(this.value);">
          			<option><?php echo $name; ?></option>
          			<option>View Profile</option>
          			<option>Settings</option>
          			<option>LogOut</option>
          		</select></a></li>
        </ul>
      </div>
    </div>
  </nav>
<br><br>
<div class="container"><br><br>
<div class="row">
	
	<div class="col-sm-4" >
		<div class="vertical">
		<div class="row">
			<div class="col-sm-4"> 
				Question:<textarea type="textarea" name="question" id="question" cols="30" rows="5"></textarea>
				<br>
				Select : <select id="choose" onchange="FormCreate(this.value);">
							<option value="se">Select</option>
							<option value="IF">Input Field</option>
							<option value="RB">Radio buttons</option>
							<option value="CB">Check Boxes</option>
							<option value="DD">Dropdown</option>
							<option value="TF">Text Field</option>
						</select>
			</div>
			</div>
			<div class="row">
				<req class='left-space'><br>
					Required:
					Yes<input type="radio" value="yes" name="ans" id="ans"  checked>
					No<input type="radio" value="no" name ="ans" id="ans" class="left-space"><br>
				</req>
				<add></add>
			</div>
		</div>

	</div>

	<div class="col-sm-8">
	<br>
	<center>
	<h4>Form Name : <input type="text" name="formname" id="formname">
	Form Description :<input type="text" id="formdes" placeholder="Short Note"></h4>
	</center>
	<br>
	<hr>
	<br>
	<input type="hidden" name="location" value="<?php echo $location; ?>">
	<input type="hidden" name="lat" value="<?php echo $lat; ?>">
	<input type="hidden" name="lng" value="<?php echo $lng;  ?>">
	<create class="left-space"></create><br><hr><br>
	<center><button class="btn btn-success" onclick="Redirect();">SUBMIT</button></center>
	</div>

</div>
</div>	


<script type="text/javascript">
var i,j,m,n,ti=0,rb=0, cb=0,dd=0,tf=0,count=0,req,dec,track,question,record_option,field,rb_record,cb_record,dd_recoed,tf_record,rb_type='rb',cb_type='cb',dd_type='dd',arr=0; 
var record_type 	= new Array();
var record_id		= new Array();
var record_name 	= new Array();
var record_value 	= new Array();
var record_req 		= new Array();

function FormCreate(val){
		
		track=val;
		 
		//hide required field when select is choosen in dropdown
			if(val=='se'){
				$('req').hide();
			}
			else $('req').show();
		//
		//Get the checked radio button value  in req tag
		 dec=$('input[name="ans"]:checked').val();
		//

		//IF(Input Field) Operation only button added
			if(val=='IF' || val=='TF'){
				$('req').show();
				$('rem').remove();
				$('add').append('<rem><button onclick="Create();">Apply</button</rem>');
			}
		//

		//Radio button fields to the user to add
			if(val=='RB'){
				$('req').show();
				$('rem').remove();
				$('add').append('<rem><br>Options : <select id="rb_id" onchange="AddOptions(this.value,rb_type);"><option value="0">0</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></rem>');
			}
		//
			
		//CheckBoxs fields to the user to add
			if(val=='CB'){
				$('req').show();
				$('rem').remove();
				$('add').append('<rem><br>Options : <select id="cb_id" onchange="AddOptions(this.value,cb_type);"><option value="0">0</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></rem>');
			}
		//

		//Drop Down fields to the user to add
			if(val=='DD'){
				$('req').hide();
				$('rem').remove();
				$('add').append('<rem><br>Options : <select id="dd_id" onchange="AddOptions(this.value,dd_type);"><option value="0">0</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></rem>');
			}
		//
		}

	function Create(){
		question=document.getElementById('question').value;

		//IF(Input Field) main operation
		if(track=='IF'){
				var ti_id=ti+'IF';
				var ti_in=ti+'IF'+'IN';
			if(dec=="yes"){
				$('create').append('<div id="'+ti_id+'" name="'+ti_id+'"><br>'+question+' :  '+'<input type="text" name="'+ti_in+'" id="'+ti_in+'" required>*<label class="left-space"><i class="fa fa-window-close" aria-hidden="true" id="'+ti_id+'" onclick="Remove(this.id,track);"></i></label><br></div>');
				Record(track,ti_id,question,'0',dec,'store');
				ti = ti+1;
			}
			else if(dec=="no"){
				$('create').append('<div id="'+ti_id+'" name="'+ti_id+'"><br>'+question+' :  '+'<input type="text" name="'+ti_in+'" id="'+ti_in+'"><label class="left-space"><i class="fa fa-window-close" aria-hidden="true" id="'+ti_id+'" onclick="Remove(this.id,track);"></i></label><br></div>');
				Record(track,ti_id,question,'0',dec,'store');
				ti=ti+1;
			}
			
		}
		//


		//Radio button main operation
		if(track=='RB'){
			var rb_id=rb+'RB';
			var rb_in=rb+'RB'+'IN';
			//var num_radio = $('#rb_id').val();
			var validate=0;
			$('input[eac="rb_in"]').each(function(){
				if(this.value==''){
					 m=parseInt(this.id)+1;
					alert("Option"+m+"should not be empty.");
				}
				else validate=validate+1;			
				
			});
			if(validate==i){
				//If it is mandatory (attach required)
				count =0;
				if(dec=='yes'){
					$('create').append('<div id="'+rb_id+'" name="'+rb_id+'"><br>'+question+' :</div>');
					for(var rb_i=0;rb_i<i;rb_i++){
						//alert($('#0rb_option').val());
						var option_id = '#'+rb_i+'rb_option';
						var rb_option = $(option_id).val();
						$('create').append('<a id="'+rb_id+'"><input type="radio" style="margin-left:20px;" id="'+rb_in+'" name="'+rb_in+'" required>'+rb_option+'</a>');
						
						if(count == 0){
							rb_record = rb_option;
							count++;
						}
						else rb_record = rb_record+','+rb_option;
					}
					$('create').append('<i class="fa fa-window-close" aria-hidden="true" id="'+rb_id+'" onclick="Remove(this.id,track);"></i>');
				}
				//Not mandatory()
				if(dec=='no'){
				
					$('create').append('<div id="'+rb_id+'" name="'+rb_id+'"><br>'+question+' :</div>');
					for(var rb_i=0;rb_i<i;rb_i++){
						//alert($('#0rb_option').val());
						var option_id = '#'+rb_i+'rb_option';
						var rb_option = $(option_id).val();
						$('create').append('<a id="'+rb_id+'"><input type="radio" style="margin-left:20px;" id="'+rb_in+'" name="'+rb_in+'" required>'+rb_option+'</a>');
						if(count == 0){
							rb_record = rb_option;
							count++;
						}
						else rb_record = rb_record+','+rb_option;
					}
					$('create').append('<i class="fa fa-window-close" aria-hidden="true" id="'+rb_id+'" onclick="Remove(this.id,track);"></i>');
				}
				
			}

			Record(track,rb_id,question,rb_record,dec,'store');
			rb++;

		}
		//

		//Checkbox button main operation
		if(track=='CB'){
			var cb_id=cb+'CB';
			var cb_in=cb+'CB'+'IN';
			var validate=0;
			$('input[eac="cb_in"]').each(function(){
				if(this.value==''){
					 m=parseInt(this.id)+1;
					alert("Option"+m+"should not be empty.");
				}
				else validate=validate+1;			
				
			});
			if(validate==i){
				//If it is mandatory (attach required)
				count=0;
				if(dec=='yes'){
					$('create').append('<div id="'+cb_id+'" name="'+cb_id+'"><br>'+question+' :</div>');
					for(var cb_i=0;cb_i<i;cb_i++){
						//alert($('#0rb_option').val());
						var cb_option_id = '#'+cb_i+'cb_option';
						var cb_option = $(cb_option_id).val();


					if(count == 0){
						cb_record = cb_option;
						count++;
					}
					else cb_record = cb_record+','+cb_option;
					$('create').append('<a id="'+cb_id+'"><input type="checkbox" style="margin-left:20px;" id="'+cb_in+'" name="'+cb_in+'" required>'+cb_option+'</a>');
						
					}

					
				}
				//Not mandatory()
				if(dec=='no'){
					$('create').append('<div id="'+cb_id+'" name="'+cb_id+'"><br>'+question+' :</div>');
					for(var cb_i=0;cb_i<i;cb_i++){
						//alert($('#0rb_option').val());
						var cb_option_id = '#'+cb_i+'cb_option';
						var cb_option = $(cb_option_id).val();
						$('create').append('<a id="'+cb_id+'"><input type="checkbox" style="margin-left:20px;" id="'+cb_in+'" name="'+cb_in+'" required>'+cb_option+'</a>');
					}

						if(count == 0){
							cb_record = cb_option;
							count++;
						}
						else cb_record = cb_record+','+cb_option;
					
				}
				$('create').append('<i class="fa fa-window-close" aria-hidden="true" id="'+cb_id+'" onclick="Remove(this.id,track);"></i>');
				Record(track,cb_id,question,cb_record,dec,'store');
				cb++;
			}
		}
		//


		//DropDown button main operation
		if(track=='DD'){
			var dd_id=dd+'DD';
			var dd_in=dd+'DD'+'IN';
			var validate=0;
			$('input[eac="dd_in"]').each(function(){
				if(this.value==''){
					 m=parseInt(this.id)+1;
					alert("Option"+m+"should not be empty.");
				}
				else validate=validate+1;			
				
			});
			if(validate==i){
					count=0;
					$('create').append('<div id="'+dd_id+'" name="'+dd_id+'"><br>'+question+' :</div>');
					$('create').append('<select id="'+dd_id+'" name="dd"></select>');
					for(var dd_i=0;dd_i<i;dd_i++){
						var dd_option_id = '#'+dd_i+'dd_option';
						var dd_option = $(dd_option_id).val();
						//var dd_sel = '#'+dd_id;
						$('select[name="dd"]').append('<option id="'+dd_id+'">'+dd_option+'</option>');
						if(count == 0){
							dd_record = dd_option;
							count++;
						}
						else dd_record = dd_record+','+dd_option;
					
					}
					$('create').append('<i class="fa fa-window-close" aria-hidden="true" id="'+dd_id+'" onclick="Remove(this.id,track);"></i>');
					Record(track,dd_id,question,dd_record,dec,'store');
					dd++;
			}
		}	
		//

		//TextField main operation
		if(track=='TF'){
				var tf_id=tf+'TF';
				var tf_in=tf+'TF'+'IN';
			if(dec=="yes"){
				$('create').append('<div id="'+tf_id+'" name="'+tf_id+'"><br>'+question+' : <br> '+'<textarea type="text" name="'+tf_in+'" id="'+tf_in+'" rows="7" cols="50" required></textarea>*<label class="left-space"><i class="fa fa-window-close" aria-hidden="true" id="'+tf_id+'" onclick="Remove(this.id,);"></i></label><br></div>');
				Record(track,tf_id,'0',dec,'store');
				tf = tf+1;
			}
			else if(dec=="no"){
				$('create').append('<div id="'+tf_id+'" name="'+tf_id+'"><br>'+question+' : <br> '+'<textarea type="text" name="'+tf_in+'" id="'+tf_in+'" rows="7" cols="50" ></textarea><label class="left-space"><i class="fa fa-window-close" aria-hidden="true" id="'+tf_id+'" onclick="Remove(this.id,track);"></i></label><br></div>');
				Record(track,tf_id,'0',dec,'store');
				tf = tf+1;
			}
		}

		//
	}

	//Remove Create Element.
	function Remove(element,di){
		var rem = '#'+element;
		$(rem).remove();
		Record(di,element,0,0,0,'del');
		/*$(rem).each(function(){
			$(this).remove();
		});*/
	}
	//

	//When the radio button options are changed
	function AddOptions(num_options,type){
		if(type=='rb'){
			$('rb_option').hide();
			$('cb_option').hide();
			$('dd_option').hide();
			for(i=0; i<num_options;i++){
				j=parseInt(i)+1;
				n=i+'rb_option';
				$('rem').append('<br><br><rb_option><label>Option '+j+' :</label><input type="text" id="'+n+'" name="'+n+'" eac="rb_in"></rb_option>');
			}
		}
		if(type=='cb'){
			$('rb_option').hide();
			$('cb_option').hide();
			$('dd_option').hide();
			for(i=0; i<num_options;i++){
				j=parseInt(i)+1;
				n=i+'cb_option';
				$('rem').append('<br><br><cb_option><label>Option '+j+' :</label><input type="text" id="'+n+'" name="'+n+'" eac="cb_in"></cb_option>');
			}
		}

		if(type=='dd'){
			$('rb_option').hide();
			$('cb_option').hide();
			$('dd_option').hide();
			for(i=0; i<num_options;i++){
				j=parseInt(i)+1;
				n=i+'dd_option';
				$('rem').append('<br><br><cb_option><label>Option '+j+' :</label><input type="text" id="'+n+'" name="'+n+'" eac="dd_in"></cb_option>');
			}
		}
			$('rem').append('<br><br><button onclick="Create();">Apply</button>');
	}	
	//


function Record(type,id,name,value,req,action){
	
	if(action=='store'){
		record_type[arr] = 	type;
		record_id[arr] 	 =	id; 
		record_name[arr] = 	name;
		record_value[arr]= 	value;
		record_req[arr]  = 	req;  
		arr++;

	}
	else if(action=='del'){
		var remove_index = record_id.indexOf(id);
		if(remove_index != '-1'){
			record_type.splice(remove_index,1);
			record_id.splice(remove_index,1);
			record_name.splice(remove_index,1);
			record_value.splice(remove_index,1);
			record_req.splice(remove_index,1);
			arr--;
		}
	}

}

function Redirect(){
	var decision = 0;
	if($('#formname').val()==''){

		alert("Form should have a Name");
		decision=1;
	}
	if($('#formdes').val()==''){
		alert("Form should have a Description");
		decision=1;
	}
	if(record_type.length=='0'){
		alert('No elements are created in the form....');
		decision=1;
	}
	
	if(decision==0){
		var record_value_update = record_value.join('%');
		window.location="Formstore.php?record_type="+record_type+"&record_id="+record_id+"&record_name="+record_name+"&record_value="+record_value_update+"&record_req="+record_req+"&location="+$('input[name="location"]').val()+"&lat="+$('input[name="lat"]').val()+"&lng="+$('input[name="lng"]').val()+"&formname="+$('#formname').val()+"&formdes="+$('#formdes').val();
	}
}

function Redirect_mainpage(red){
			window.location=red;
	}

//Log Out
function Profile(Session_page){
     
    if(Session_page=='LogOut'){
        window.location='Logout.php';
      }
}
//
</script>
</body>
</html>
<?php
	} else echo '<h3 style="color:red">Some Error Occured.</h3>';
}else echo '<h3 ><a href="mainpage_new1.html">Click Here To Login.</a></h3>'
?>