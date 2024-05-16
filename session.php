<?php
include_once 'process.php';

session_start(); 
	
	$email = $_SESSION['email'];
	
	$stmt = $conn->prepare("SELECT * FROM tbl_staffs_a186913_pt2 WHERE fld_staff_email = '$email'");

	$stmt->execute();
	
	$readrow = $stmt->fetch(PDO::FETCH_ASSOC);

	$sid = $readrow['fld_staff_num'];
	$name = $readrow['fld_staff_name'];
	$department = $readrow['fld_staff_department'];
	$phone = $readrow['fld_staff_phone'];
	$email= $readrow['fld_staff_email'];
	$level = $readrow['fld_user_level'];
	$pass = $readrow['fld_staff_password'];
		
if($email==''){
	header("location:login.php");
	}
	else {
	header("");
	}
?>