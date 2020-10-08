<?php
session_start();
        if(!isset($_SESSION["consumernumber"]))
		{
		 header( "location:consumerlogin.php" );
		}
		$units="";
		$NetAmount="";
		$subsidary ="";
		$currcharge ="";
		$e_tax="";
		$fix_charge="";
		$error="";
		$flag="";
		$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query="SELECT * from bill_due where consumer_no='{$_SESSION["consumernumber"]}'";
$result=mysqli_query($con,$query);

if(mysqli_num_rows($result)>0)
{
	$flag=1;
	while($row=mysqli_fetch_assoc($result))
	{
		$units=$row["Consumed_units"];
		$dates=$row["Date"];
	}
	if($units<=100){
		$NetAmount=0.0;
		$subsidary =0.0;
		$currcharge =0.0;
		$e_tax=0.0;
		$fix_charge=0.0;
	}
	else if($units>=200 && $units<=500 ){
		$e_tax=101.0;
		$fix_charge = 10;
		$subsidary =10.0;
		$prunit=2.5;
		$currcharge = $prunit * $units;
	    $NetAmount = ($units-100)*2.5 + $fix_charge+$currcharge-$subsidary;
	}
	else if($units>500){
		$e_tax=101.0;
		$fix_charge = 30;
		$subsidary =10.0;
		$prunit=2.5;
		$currcharge = $prunit * $units;
		$NetAmount= ($units-100)*5;
		$NetAmount= $NetAmount +$fix_charge+$currcharge-$subsidary;
	}
	echo "<div style='background-color:green;text-align:center;padding:10px'>
  <h4 style='color:white'>PAYMENT AVAILABLE !! PAY SOON</h4>
  </div>";
}
else
{
	echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>NO DUE PAYMENTS</h3>
  </div>";
}
if(isset($_POST["Pay"]))
{
	$dates=date("Y/m/d");
	$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query="insert into bill_payed values('{$_SESSION["consumernumber"]}','{$dates}','{$NetAmount}','{$units}')";
$result=mysqli_query($con,$query);
if($result==FALSE)
{
	echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>Transaction Failed</h3>
  </div>";
  header( "refresh:1;url=consumerdash.php" );
}
else
{
	$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query="delete from bill_due where consumer_no='{$_SESSION["consumernumber"]}' ORDER BY Consumed_units DESC LIMIT 1";
$result=mysqli_query($con,$query);
if($result==TRUE)
{
	$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query="SELECT * from reg_db where consumer_no='{$_SESSION["consumernumber"]}'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
	while($row=mysqli_fetch_assoc($result))
	{
		$mail=$row["email_id"];
	}
}
$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>Payment for this connection number ".$_SESSION["consumernumber"]." has paid Successfully.\n\r  Thank You\n\r</p>
<table>
<tr>
<th>Consumer Number</th>
<th>Amount</th>
<th>Units Consumed</th>
</tr>
<tr>
<td>".$_SESSION['consumernumber']."</td>
<td>".$NetAmount."</td>
<td>".$units."</td>
</tr>
</table>
</body>
</html>
";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

mail($mail,"Payment Successfull",$message,$headers);
	echo "<div style='background-color:green;text-align:center;padding:10px'>
  <h4 style='color:white'>Payment Successfull</h4>
  </div>";
  header( "refresh:1;url=consumerdash.php" );
}
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
      <a class="nav-link" style="color:white" href="Billarchieve.php">Bill Archieve</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="Logout.php">LOGOUT</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="Account.php"><?php echo '<b> Connection no <br>'.$_SESSION["consumernumber"].'</b>'?></a>
	  
    </li>
  </ul>
</nav>
<p style="color:#2545c1;text-align:center"><b>*Pay early to avoid unexpected network / connectivity issues on the last date</b></p>
<div class="jumbotron bg-cover" style="width:50%">
<div style="padding:5px;color:white">
<h6 style="color:black;text-align:center">Mr/Ms. <b><?php echo $_SESSION["username"]; ?> </b>your Payment Details.</h6>
</div>
<?php
if($flag==1)
{
	echo '<table>
  <tr>
    <td>Consumed Units</td>
    <td> '.$units.'</td>
    
  </tr>
  
  <tr>
    <td>Current Charges (Rs)</td>
    <td> '.$currcharge.'</td>
    
  </tr>
  <tr>
    <td>Fixed Cost (Rs)</td>
    <td>'.$fix_charge.'</td>
  </tr>
  <tr>
    <td>E.Tax (Rs)</td>
    <td>'.$e_tax.'</td>    
  </tr>
  <tr>
    <td>Subsidy (Rs)</td>
    <td>'. $subsidary.'</td>
  </tr>
  <tr>
    <th>Net Amount (Rs)</th>
    <th>'.$NetAmount.'</th>
    
  </tr>
</table>';
echo '
<div class="center">
<form method ="post">
<input type="submit" value="pay" name="Pay">
</form>
</div>';

}
else
{
	echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>NO DUE PAYMENTS</h3>
  </div>";
  $con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query="SELECT * from bill_payed where consumer_no='{$_SESSION["consumernumber"]}'";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
	while($row=mysqli_fetch_assoc($result))
	{
		$lastdate=$row["Date"];
	}
	echo '<p> Your Last Payment on : <b>'.$lastdate.'<b></p>';
}
else
{
	 echo '<p> No payments Done</p>';
}
 
}
?>

</div>


</body>
</html>