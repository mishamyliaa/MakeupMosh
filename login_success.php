<?php  
include_once 'database.php';
include_once 'session.php';
  
 	if(isset($_SESSION["email"]))  
 	{  

     	echo '<script type="text/javascript">'; 
		echo 'alert("Welcome '.$name.'! Your position is: '.$level.'");';
		echo 'window.location.href = "index.php";';
		echo '</script>';
 	}  
 	else  
 	{  
	   	echo '<script type="text/javascript">'; 
		echo 'alert("Please login First!");'; 
		echo 'window.location.href = "login.php";';
		echo '</script>';
 	}  
 ?> 
