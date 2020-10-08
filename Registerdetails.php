<?php
session_start();
$loginErr="";
	if (!isset($_SESSION["consumerno"])) { 
    $loginErr = "You have to log in first"; 
	header('location: consumerlogin.php');
	}
	$username="";
	$email="";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
			
               $username = test_input($_POST["username"]);
			   $_SESSION["user_name"]=$username;
			   $email=test_input($_POST["email"]);
			   $_SESSION["email"]=$email;
            }
			function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
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
#head1{
	background-color:red;
	color:white;
}
.jumbotron {
 background-image: linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.9) 100%), url("https://media1.giphy.com/media/eKsRdjnIsc91UcB1NI/giphy.gif");
  margin: 10px auto;
  height:500px;
  justify-content: center;

  border: 0.08em solid black;
}

.bg-cover {
    background-attachment: static;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
input[type=submit] {
  background-color: #3c53e7;
  color: white;
  position: 10px 100 px;
  padding: 8px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: center;
}
body
{
	 background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-image:url("https://media1.giphy.com/media/eKsRdjnIsc91UcB1NI/giphy.gif");
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
<img src="logo.png" alt="" style="width:55px">
</a>
<h2 style="color:white">Electric Bill<br>
 Generation System</h2>
 <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="Billcalculator.php">Know Your Region</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="consumerID.html">Know Your Consumer ID</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="consumerlogin.php">Login</a>
    </li>
  </ul>
</nav>
<p style="color:#f6f30a;text-align:center"><b>*Pay early to avoid unexpected network / connectivity issues on the last date</b></p>
<div class="jumbotron bg-cover" style="width:50%">
<div  id="head1">
<p style="text-align:center"><b>New Registartion</b></p>
</div>

<form action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<div class="form-group">
<label for="Email Id:"><b>Email Id:</b></label>
<input type="email" name="email" placeholder="Enter mail Id" class="text-line" required="" pattern="/^[a-z0-9]++@[a-z]+(.com/.in)$/">
</div>
<div class="form-group">
<label for="User Name"><b>User Name:</b></label>
<input type="text" name="username" placeholder="Enter user name" required="" class="text-line">
</div>

<div class="form-group">
<label for="register"><b>Do you want to</b> <br><b>register your claim?</b></label>
<input type="submit" name="form" value="Register" >
</div>
</form>
<?php 
if(isset($_POST["form"]))
{
	function Createpass()
	{
		return rand(100000,999999);
	}
	$password="";
	$password=Createpass();
	$body="This is your Password ".$password." for Electricity Bill.\n\r Thank You ";

                 if(mail($email,"Password",$body,"From:tngovtepass@gmail.com"))
                 {
					 
                 }
                else
				 {
	              echo '<script>alert("Check Your Internet COnnection!!")</script>';
                }
	$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
	$query="insert into reg_db(user_name,email_id,consumer_no,region,Password,Address)values('{$_SESSION['user_name']}','{$_SESSION['email']}','{$_SESSION['consumerno']}','{$_SESSION['region']}','{$password}','{$_SESSION["address"]}')";
	$result=mysqli_query($con,$query);
	if($result==FALSE)
	{
		echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>Account Created UnsuccessFull</h3>
  </div>";
	}
	else
	{
		echo "<div style='background-color:green;text-align:center;padding:10px'>
  <h4 style='color:white'>Account Created,Password Has Sent To your Email</h4>
  </div>";
	}
}
?>
</div>
</body>
</html>