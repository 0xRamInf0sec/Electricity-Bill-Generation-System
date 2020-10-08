<?php
session_start();
session_destroy();
 echo "<script>alert('Logout Successfull')</script>";
 header( "refresh:1;url=consumerlogin.php" );
?>