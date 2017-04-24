
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACfEfHmWBvJhO4c_yz5CdkJi-TDbRLXhg&libraries=places"></script>

  <style>

  	.button_color{
    background-color: #008060;
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
          											<option value="Form_Table.php">View</option>
                                <option value="Filled_Forms.php">Filled Forms</option>
          									</select></a></li>
          <li><a href="Credits.php" style="color: black;">Credits</a></li>
          <li><a href="Coupons.php" style="color: black;">Coupons</a></li>
          <li><a href="EarnedCoupons.php" style="color: black;">Earned Coupons</a></li>

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

<script type="text/javascript">
	function Redirect_mainpage(redir){
			window.location=redir;
	}

  function Profile(Session_page){
      if(Session_page=='LogOut'){
        window.location='Logout.php';
      }
  }
</script>
</body>
</html>