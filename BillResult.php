<?php

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
 
  margin: 10px auto;
  height:500px;
  justify-content: center;

  border: 0.08em solid black;
}
<?php

?>
<html>
<head>
<title>Electric Board Online Payment</title>
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
  height:400px;
  justify-content: center;

  border: 0.08em solid black;
}
table, td, th {
  border: 1px solid black;
  margin-top:50px;
  margin-left:100px;
}

table {
  border-collapse: collapse;
  width: 50%;
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
<?php
session_start();

if($_SESSION["tarrif"]=="domestic"){
	if($_SESSION['units']<=100){
		$_SESSION['NetAmount']=0.0;
		$_SESSION['subsidary'] =0.0;
		$_SESSION['currcharge'] =0.0;
		$_SESSION['e_tax']=0.0;
		$_SESSION['fix_charge'] =0.0;
	}
	else if($_SESSION['units']>=200 && $_SESSION['units']<=500 ){
		$_SESSION['e_tax']=101.0;
		$_SESSION['fix_charge'] = 10;
		$_SESSION['subsidary'] =10.0;
		$_SESSION['prunit']=2.5;
		$_SESSION['currcharge'] = $_SESSION['prunit'] * $_SESSION['units'];
	    $_SESSION['NetAmount'] = ($_SESSION['units']-100)*2.5 + $_SESSION['fix_charge']+$_SESSION['currcharge']-$_SESSION['subsidary'];
	}
	else if($_SESSION['units']>500){
		$_SESSION['e_tax']=101.0;
		$_SESSION['fix_charge'] = 30;
		$_SESSION['subsidary'] =10.0;
		$_SESSION['prunit']=2.5;
		$_SESSION['currcharge'] = $_SESSION['prunit'] * $_SESSION['units'];
		$_SESSION['NetAmount']= ($_SESSION['units']-100)*5;
		$_SESSION['NetAmount'] = $_SESSION['NetAmount'] +$_SESSION['fix_charge']+$_SESSION['currcharge']-$_SESSION['subsidary'];
	}
	
}
if($_SESSION['tarrif']!="domestic"){
$conn = new mysqli("localhost", "Projectphp", "php123!@#","electricbillgeneration");

if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
$sql_tarrif = "SELECT fix_charge,prunit,e_tax,subsidary FROM lt_tarrif WHERE tarrif= ". "'".$_SESSION['tarrif']."'";
$result_tarrif = $conn->query($sql_tarrif);
//print_r($result_tarrif);

  $obj = $result_tarrif -> fetch_object();
	$_SESSION['fix_charge'] = $obj->fix_charge;
	$_SESSION['prunit'] = $obj->prunit;
	$_SESSION['e_tax'] = $obj->e_tax;
	$_SESSION['subsidary'] = $obj->subsidary;
  
  $_SESSION['currcharge'] = $_SESSION['prunit'] * $_SESSION['units'];
  $_SESSION['NetAmount'] = $_SESSION['currcharge']+$_SESSION['fix_charge']+$_SESSION['e_tax']-$_SESSION['subsidary'];
}
?>

<body>
<nav class="navbar navbar-expand-sm bg-dark">
<a class="navbar-brand" href="#">
<img src="logo.png" alt="" style="width:55px">
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
<p style="text-align:center"><b>Bill Calculation</b></p>
</div>
<table>
  <tr>
    <td>Consumed Units</td>
    <td><?php  echo $_SESSION['units']; ?></td>
    
  </tr>
  
  <tr>
    <td>Current Charges (Rs)</td>
    <td><?php echo $_SESSION['currcharge'];?></td>
    
  </tr>
  <tr>
    <td>Fixed Cost (Rs)</td>
    <td><?php echo $_SESSION['fix_charge']?></td>
  </tr>
  <tr>
    <td>E.Tax (Rs)</td>
    <td><?php echo $_SESSION['e_tax']?></td>    
  </tr>
  <tr>
    <td>Subsidy (Rs)</td>
    <td><?php echo $_SESSION['subsidary'];?></td>
    
  </tr>
  <tr>
    <th>Net Amount (Rs)</th>
    <th><?php echo $_SESSION['NetAmount']?></th>
    
  </tr>
</table>

</body>
</html>

