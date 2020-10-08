<?php
session_start();
        if(!isset($_SESSION["adminname"]))
		{
		 header( "location:admin.php" );
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
  margin-left:70px;
}

table {
	color:black;
  border-collapse: collapse;
  width: 70%;
}
.jumbotron {
background-color:transparent;
  margin: 10px auto;
  height:100%;
  justify-content: center;

  //border: 0.08em solid black;
}

.bg-cover {
    background-attachment: static;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
#date
{
	display:none;
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
      <a class="nav-link" style="color:white" href="adminpanel.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="Logout.php">LOGOUT</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="#"><?php echo $_SESSION["adminname"] ?> </a></a>
    </li>
  </ul>
</nav>
<p style="color:#2545c1;text-align:center"><b>*Pay early to avoid unexpected network / connectivity issues on the last date</b></p>
<div class="jumbotron bg-cover" style="width:50%">
<div style="padding:5px;color:white">
<h6 style="color:black;text-align:center">User's Payment Archieve</h6>
</div>
<table>
<tr>
<th>Consumer Number</th>
<th>Amount Paid</th>
<th>Date Of Payment</th>
<th>Consumed Units</th>
<th>Bill</th>
 
<?php
$con=mysqli_connect("localhost","Projectphp","php123!@#","electricbillgeneration");
$query="SELECT * from bill_payed ";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
	while($row=mysqli_fetch_assoc($result))
	{
		$dates=$row["Date"];
		$amount=$row["Amount"];
		$unitscon=$row["units"];
		$cono=$row["consumer_no"];
		echo '<tr>
        <td>'.$cono.'</td>
        <td> '.$amount.'</td>
	    <td>'.$dates.'</td>
		<td>'.$unitscon.'</td>
		<td><form action="adminbill.php" method="post">
		<input type="text" id="date" name="date" value='.$dates.'>
		<input type="text" id="date" name="conno" value='.$cono.'>
		<input type="submit" name="bill"  value="Bill"></form>
		</td>		
		</tr>
  ';
	}
}
else
{
	echo "<div style='background-color:blue;text-align:center;padding:10px'>
  <h4 style='color:white'>No Payments Done here !!</h4>
  </div>";
}


?>

</table>

</div>


</body>
</html>