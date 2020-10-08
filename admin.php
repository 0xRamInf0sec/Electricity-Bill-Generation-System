<?php
session_start();
$uname=$dbpass= $pass ="";
			 
			 if ($_SERVER["REQUEST_METHOD"] == "POST") {
               $uname= test_input($_POST["Uname"]);
               $pass = test_input($_POST["Password"]);
            }
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
		if(isset(($_POST['Login'])))
		{
			    if($pass=="admin" && $uname=="admin")
				  {
					  $_SESSION['adminname']=$uname;
					  echo "<link rel='icon' href='logo.png' type='image/png'><div style='background-color:green;text-align:center;padding:10px'>
  <h4 style='color:white'>Login Success,Wait For Redirecting...</h4>
  </div>";
					 header( "refresh:6;url=adminpanel.php" );
				  }
				  else
				  {
					  echo "<link rel='icon' href='logo.png' type='image/png'><div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>Invalid Crededntials!Try Again</h3>
  </div>";
  
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
<style>
.navbar-nav{
	margin-left:auto;
}
input[type=submit] {
  background-color: #0760f0;
  color: white;
  position: 10px 100 px;
  padding: 8px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: center;
}
#head1{
	background-color:red;
	color:white;
}
.jumbotron {
 background-image: linear-gradient(to bottom, rgba(255,255,255,0.3) 0%,rgba(255,255,255,0.2) 100%), url("https://wallpapercave.com/wp/wp2508260.jpg");
  margin: 10px auto;
  height:500px;
  justify-content: center;

//  border: 0.08em solid black;
}

.bg-cover {
    background-attachment: static;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
body
{
	 background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-image:url("https://wallpapercave.com/wp/wp2508260.jpg");
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
      <a class="nav-link" style="color:white" href="Billcalculator.php">Bill Calculator</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="quickpay.php">Quick Pay</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="consumerlogin.php">Login</a>
    </li>
  </ul>
</nav>
<p style="color:#f6f30a;text-align:center"><b>*Admin Portal</b></p>
<div class="jumbotron bg-cover" style="width:50%">
<div  id="head1">
<p style="text-align:center"><b>Payment / Consumer Complaints Gateway</b></p>
</div>
<form action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="form-group">
<label for="Username" style="color:white"><b>UserName</b></label>
<input type="text" name="Uname" class="form-control input-lg" id="uname" placeholder="Enter Username">
</div>
<div class="form-group">
<label for="Pass" style="color:white"><b>Password</b></label>
<input type="password" name="Password" class="form-control input-lg" id="pass" placeholder="Enter Password">
</div>
<input type="Submit" value="Login" name="Login" id="btn-log">
</form>
</div>


</body>
</html>