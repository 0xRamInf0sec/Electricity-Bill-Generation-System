<?php

			  $mail = $cno="";
			 
			 if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
               $cno = test_input($_POST["Uname"]);	
        }
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
		 
$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
if(isset(($_POST['Reset'])))
{
if(mysqli_connect_errno())
{
	echo "error";
}
$sql_stmt="select email_id from reg_db where consumer_no='".$cno."'";
$result=mysqli_query($con,$sql_stmt);

if(mysqli_num_rows($result)>0)
{
	while($row = mysqli_fetch_assoc($result)) {
    $mail=$row["email_id"];
  }
}
else
{
	echo '<script>alert("Not valid Consumer number")</script>';
}
function writeMsg() {
     return rand(100000,999999);
}
$pass=writeMsg();
$query="update reg_db set Password='{$pass}' where email_id='{$mail}'";
$res=mysqli_query($con,$query);
$body="This is your New Password ".$pass." Thank You ";

if(mail($mail,"Password Reset",$body,"From:tngovtepass@gmail.com"))
{
	echo "<div style='background-color:green;text-align:center;padding:10px'>
  <h4 style='color:white'>Reset Successfull,Password Has Sent To your Email</h4>
  </div>";
	header( "refresh:5;url=consumerlogin.php" );
}
else{
	echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>Password Reset  UnsuccessFull</h3>
  </div>";
  header( "refresh:5;url=consumerlogin.php" );
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
body
{
	 background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-image:url("https://media1.giphy.com/media/eKsRdjnIsc91UcB1NI/giphy.gif");
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
<p style="color:#f6f30a;text-align:center"><b>*Pay early to avoid unexpected network / connectivity issues on the last date</b></p>
<div class="jumbotron bg-cover" style="width:50%">
<div  id="head1">
<p style="text-align:center"><b>RESET PASSWORD</b></p>
</div>
<form action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="form-group">
<label for="Username"><b>Consumer No</b></label>
<input type="text" name="Uname" class="form-control input-lg" id="uname" placeholder="Enter UserID/Conumer No" required>
</div>

<input type="Submit" value="Reset" name="Reset" id="btn-log">
</form>

</div>


</body>
</html>