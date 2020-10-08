<?php

$cno="";
 $region="";
        if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
			
               $cno = test_input($_POST["consumer_no"]);
			   $region=$_POST['country'];
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
#country
{
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
      <a class="nav-link" style="color:white" href="Region.html">Know your Region</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="consumerID.html">Know your Consumer ID</a>
    </li>
    
  </ul>
</nav>
<p style="color:#f6f30a;text-align:center"><b>*Pay early to avoid unexpected network / connectivity issues on the last date</b></p>
<div class="jumbotron bg-cover" style="width:50%">
<div  id="head1">
<p style="text-align:center"><b>Details Checking</b></p>
</div>

<form action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="form-group">
<label for="consumer_no:"><b>Consumer No(without region code):</b></label>
<input type="text" name="consumer_no" placeholder="Enter consumer no" required pattern="[0-9]{10}" class="text-line">
</div>
<div class="form-group">
<label for="Region"><b>Region : </b></label>
      <select id="country" name="country">
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
<input type="submit" name="form" value="check details">
</div>
<div>
<?php
session_start();
if(array_key_exists('form',$_POST))
{
$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query="SELECT consumer_no, service_status,address,user_name,region FROM govt_db where consumer_no='{$cno}' && region='{$region}'";
$res=mysqli_query($con,$query);
if(mysqli_num_rows($res)>0)
{
  while($rs=mysqli_fetch_assoc($res))
{
	$no=$rs["consumer_no"];
	$ureg=$rs["region"];
	$add=$rs["address"];
	$_SESSION["address"]=$add;
	$_SESSION["region"]=$ureg;
	$_SESSION["consumerno"]=$no;
    echo "<b>Consumer No : </b>".$no."<br>";
    echo "<b>Service Status : </b>".$rs["service_status"]."<br>";
    echo "<b>Address : </b>".$add."<br>";
    echo "<b>Region : </b>".$ureg."<br>";
}
echo '<h4 style="color:red">Details Found!!</h4>';
$con1=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query1="select consumer_no from reg_db where consumer_no='{$_SESSION['consumerno']}'";
$result=mysqli_query($con1,$query1);
if(mysqli_num_rows($result)>0)
{
  echo "<div style='background-color:#000000;padding:10px;text-align:center'>
  <h6 style='color:white'>Account Already Associated with this Consumer Number</h6>
  </div>";
}
else
{
 echo "<div style='background-color:#000000;text-align:center;padding:10px'>
  <h4><a href='Registerdetails.php'  style='color:white'>Click Here To Make a Account</a></h4>
  </div>";
} 
}
else
{
	echo "<div style='background-color:red;padding:10px;text-align:center'>
  <h3 style='color:white'>No Data's Found</h3>
  </div>";
}
}

?>
</div>
</form>
</div>
</body>
</html>