<?php
session_start();
        if(!isset($_SESSION["consumernumber"]))
		{
		 header( "location:consumerlogin.php" );
		}
				$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query="SELECT * from reg_db where consumer_no='{$_SESSION["consumernumber"]}'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
	while($row=mysqli_fetch_assoc($result))
	{
		$email=$row["email_id"];
		$region=$row["region"];
		$password=$row["Password"];
		$address=$row["Address"];
	}
	
}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

               $pass = test_input($_POST["Password"]);
			   $reg = test_input($_POST["region"]);
			   $mail = test_input($_POST["mail"]);
			   $user = test_input($_POST["user"]);
			    $address=test_input($_POST["add"]);
			   
            }
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
		if(isset($_POST["update"]))
		{
			$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
			$query="UPDATE reg_db SET Password='{$pass}',region='{$reg}',email_id='{$mail}',user_name='{$user}',Address='{$address}' where consumer_no='{$_SESSION["consumernumber"]}'";
			$query1="UPDATE govt_db SET region='{$reg}',Address='{$address}' where consumer_no='{$_SESSION["consumernumber"]}'";
			$r1=mysqli_query($con,$query1);
			$r=mysqli_query($con,$query);
			if($r==TRUE && $r1==TRUE)
			{
				echo "<div style='background-color:green;text-align:center;padding:10px'>
  <h4 style='color:white'>Updated SuccessFully</h4>
  </div>";
   header( "refresh:2;url=Account.php" );
			}
			else
			{
				echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>Something Went Wrong!!</h3>
  </div>";
 header( "refresh:1;url=Account.php" );
			}
		}
?>
<html>
<head>
<title>Electric Board Online Payment</title>
<link rel="icon" href="logo.png" type="image/png">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<script>
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<style>
.navbar-nav{
	margin-left:auto;
}
.dash
{
	padding:10px;
	background-color:white;
}
.center
{
	display: flex;
  justify-content: center;
  align-items: center;
  height: 100px;
  
}
input[type=submit] {
  background-color:#f23b3b;
  color: white;
  position: 10px 100 px;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  float=center;
}

#head1{
	background-color:red;
	color:black;
}
table, td, th {
  border: 2px solid black;
  margin-top:50px;
  margin-left:100px;
}

table {
	color:black;
  border-collapse: collapse;
  width: 70%;
}
.jumbotron {
background-color:white;
  margin: 10px auto;
  height:100%;
  justify-content: center;
   background-size: cover;

 // border: 0.08em solid black;
}

.bg-cover {
    background-attachment: static;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
.text-line {
    background-color: transparent;
    color:solid #000000;
    outline: none;
    outline-style: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid #000000 1px;
    padding: 3px 10px;
}
.text-line:focus
{
	    background-color: transparent;
}

</style>
<body>
<nav class="navbar navbar-expand-sm bg-dark">
<a class="navbar-brand" href="#">
<img src="logo.png" alt="" style="width:45px">
</a>
<h2 style="color:white">Electric Bill<br>
 Generation System</h2>
 <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="Billarchieve.php">Bill Archieve</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="consumerdash.php">DashBoard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="Account.php"><?php echo '<b> Connection no <br>'.$_SESSION["consumernumber"].'</b>'?></a>
	  
    </li>
  </ul>
</nav>
<p style="color:#2545c1;text-align:center"><b>*Pay early to avoid unexpected network / connectivity issues on the last date</b></p>
<div class="jumbotron bg-cover" style="width:50%">
<div style="padding:5px;color:white">
<h6 style="color:black;text-align:center">Mr/Ms. <b><?php echo $_SESSION["username"]; ?> </b>your Account Details.</h6>
</div>
<form action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="form-group">
<label for="Username"><b>UserID/Consumer No</b></label>
<input type="text" name="conno" class="form-control input-lg" id="uname" value="<?php echo $_SESSION["consumernumber"] ?>" readonly>
</div> 
<div class="form-group">
<label for="Region"><b>Region</b></label>
      <select id="country" name="region" class="text-line" >
	  <option value="<?php echo $region ?>"selected><?php echo $region ?></option>
        <option value="01-chennai-south">01-chennai-south</option>
        <option value="02-Villupuram">02-Villupuram</option>
        <option value="03-Coimbatore">03-Coimbatore</option>
        <option value="04-Erode">04-Erode</option>
        <option value="05-madurai">05-madurai</option>
        <option value="06-trichy">06-trichy</option>
        <option value="07-tirunelveli">07-Tirunelveli</option>
        <option value="08-vellore">08-vellore</option>
        <option value="09-chennai-north">09-chennai-north</option>
        </select>
</div>
<div class="form-group">
<label for="Pass"><b>Password</b></label>
<input type="password" name="Password" class="form-control input-lg" id="pass" value="<?php echo $password ?>" required>
<input type="checkbox" onclick="myFunction()"> Show Password
</div>
<div class="form-group">
<label for="Pass"><b>Username</b></label>
<input type="text" name="user" class="form-control input-lg" id="user" value="<?php echo $_SESSION["username"] ?>" required>
</div>
<div class="form-group">
<label for="Pass"><b>email</b></label>
<input type="text" name="mail" class="form-control input-lg" id="mail" value="<?php echo $email ?>" required>
</div>
<div class="form-group">
<label for="Pass"><b>Address</b></label>
<input type="text" name="add" class="form-control input-lg" id="address" value="<?php echo $address ?>" required>
</div>
<input type="Submit" value="Update Info" name="update" id="btn-upd">
</form>

</div>


</body>
</html>