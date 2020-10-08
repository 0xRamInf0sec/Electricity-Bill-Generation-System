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


* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 90%;
  padding: 10 px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  font-size: 10 px;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #0760f0;
  color: white;
  position: 10px 100 px;
  padding: 8px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #0b07f0;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 15px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 0px;
  font-size:15px;
}

.col-75 {
  float: left;
  width: 70%;
  margin-top: 12px;
  font-size:15px;
}

.col-50 {
  float: left;
  width: 50%;
  margin-top: 0px;
  font-size:15px;
}
.jumbotron {
 background-image: linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.9) 100%), url("https://media1.giphy.com/media/eKsRdjnIsc91UcB1NI/giphy.gif");
  margin: 10px auto;
  height:400px;
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

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
 <?php
  session_start();
  if (isset($_POST['submit'])) { 
  
	print_r ($_POST);
  
  if(isset($_POST) & !empty($_POST)){

	   $_SESSION['tarrif'] = $_POST['tarrif'];
	   $_SESSION['month'] = $_POST['month'];
	   $_SESSION['load'] = $_POST['load'];
	   $_SESSION['units'] = $_POST['units'];
	   
	   header ("Location: BillResult.php");
  }
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
      <a class="nav-link" style="color:white" href="consumerlogin.php">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="quickpay.php">Quick Pay</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" style="color:white" href="#">Complaints</a>
    </li>
  </ul>
</nav>
<p style="color:#f6f30a;text-align:center"><b>*Pay early to avoid unexpected network / connectivity issues on the last date</b></p>
<form method = "post" action = "Billcalculator.php">
<div class="jumbotron bg-cover" style="width:50%">

<div  id="head1">
<p style="text-align:center"><b>Bill Calculation</b></p>
</div>
<div class="container">
  
  <div class="row">
    <div class="col-25">
       <label for="tarrif">Tarrif Check</label>
    </div>
    <div class="col-75">
      <select  name="tarrif">
        <option value="domestic">Domestic</option>
        <option value="commerical">Commerical</option>
		<option value="public">Public Lights Village & Public lights & Industrial metro</option>
		<option value="ltcommerical">Lt Commerical</option>
		<option value="workshop">Public Workshop</option>
		<option value="industries">Cottage & Tiny Industries</option>
		<option value="power">Power Looms</option>
		<option value="tempsup">Temporary Supply</option>
		<option value="lighttown">Public light Town</option>
		<option value="govt">Govt Institutions</option>
		<option value="private">Private Institutions</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="month">Billing Cycle</label>
    </div>
    <div class="col-75">
      <select  name="month">
        <option value="bimonthly">Bi-Monthly</option>
        <option value="monthly">Monthly</option>
        
      </select>
    </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="units">Consumed Units</label>
    </div>
    <div class="col-75">
      <input type="text"  name="units" required>
    </div>
  </div>
  
  <div class="row">
     <input type = "submit" name = "submit" value = "Calculate" style="font-family: cambria;">
  </div>
 </div> 
 </div>

  </form>

</body>

</html>