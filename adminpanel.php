<?php
session_start();
        if(!isset($_SESSION["adminname"]))
		{
		 header( "location:admin.php" );
		}
		$units="";
		    if($_SERVER["REQUEST_METHOD"]=="POST")
			{
				$units=test_input($_POST["units"]);
				$conno=test_input($_POST["cno"]);
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
.navbar-nav{
	margin-left:auto;
}
input[type=submit] {
  background-color: #000000;
  color: white;
  position: 10px 100 px;
  padding: 3px 20px;
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
 background-color:transparent;
  margin: 5px auto;
  height:500px;
  justify-content: center;

 // border: 0.08em solid black;
}

.bg-cover {
    background-attachment: static;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
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
      <a class="nav-link" style="color:white" href="adminarchieve.php">Bill Archieve</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="quickpay.php">Quick Pay</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="#"><?php echo $_SESSION["adminname"] ?> </a>
    </li>
  </ul>
</nav>
<p style="color:red;text-align:center"><b>*Admin Portal</b></p>
<div class="jumbotron bg-cover" style="width:50%;">
<div style="padding:10px;color:white">
<h6 style="color:black;text-align:center;background-color:#4791e3">Add Units to the Consumers</h6>
</div>
<form action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<div class="form-group">
<label for="Consumer_number :"><b>CONSUMER NUMBER :</b></label>
<input type="text" name="cno" placeholder="Enter consumer number" class="text-line" required="">
</div>
<div class="form-group">
<label for="units"><b>CONSUMED UNITS:</b></label>
<input type="text" name="units" placeholder="Enter consumed units" required="" class="text-line">
</div>

<div class="form-group">
<label for="register"><b>Confirm : </b></label>
<input type="submit" name="form" value="Add Bill" >
</div>
</form>
<?php 
if(isset($_POST["form"]))
{
	$dates=date("Y/m/d");
	$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
	$q="SELECT * from reg_db where consumer_no='{$conno}'";
	$r=mysqli_query($con,$q);
	if(mysqli_num_rows($r)>0)
	{
		while($row=mysqli_fetch_assoc($r))
		{
			$mail=$row["email_id"];
		}
		$query="insert into date_units(consumer_no,Date,Consumed_units)values('{$conno}','{$dates}','{$units}')";
		$query2="insert into bill_due(consumer_no,Date,Consumed_units)values('{$conno}','{$dates}','{$units}')";
	$result=mysqli_query($con,$query);
	$result2=mysqli_query($con,$query2);
	if($result==FALSE && $result2==FALSE)
	{
		echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>Bill Added unsuccessFull</h3>
  </div>";
    header( "refresh:1;url=adminpanel.php" );
	}
	else
	{
		$body="Electricity Bill for this connection number ".$conno." has added\n\r Pay soon!!.\n\r  Thank You ";
mail($mail,"Electricity bill",$body,"From:tngovtepass@gmail.com");

		echo "<div style='background-color:green;text-align:center;padding:10px'>
  <h4 style='color:white'>Bill Added successFull</h4>
  </div>";
  header( "refresh:2;url=adminpanel.php" );
	}
	}
	else{
		echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>Consumer Number Not exists</h3>
  </div>";
    header( "refresh:2;url=adminpanel.php" );
		
	}
	
}
?>
</div>
</body>
</html>