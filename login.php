<?php

include_once 'database.php';
session_start();
if (isset($_SESSION["email"]))
	{
		header ("location:index.php");
	}

	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["login"])) {
        $query = "SELECT * FROM tbl_staffs_a186913_pt2 WHERE fld_staff_email = :email";
        $stmt = $conn->prepare($query);
        $stmt->execute(['email' => $_POST["email"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && md5($_POST["password"]) === $user["fld_staff_password"]) {
            $_SESSION["email"] = $_POST["email"];
            header("location:login_success.php");
        } else {
            echo '<script>alert("Invalid User. Please try again.")</script>';
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}

 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <title>Makeup Mosh: Login</title>


    
</head>
<body>

<div class="container" id="container">
    <div class="form-container log-in-container">
        <form  method="post" class ="form-horizontal">
        <h1>Login</h1> <br><br><br>

        
        <input type="text" name="email" id = "email" placeholder="Enter Email" required><br><br>

        
        <input type="password" name="password" id = "password" placeholder = "Enter Password" required><br><br>

        <button type = "submit" name = "login">Login</button>

        </form>
    </div>
    <div class="slider-container">
    <div class="slider">
        <div class="slide">
            <img src="login4.jpg" alt="Image 1">
        </div>
        <div class="slide">
            <img src="login3.jpg" alt="Image 2">
        </div>
        <div class="slide">
            <img src="login6.jpg" alt="Image 3">
        </div>
        <div class="slide">
            <img src="login7.jpg" alt="Image 4">
        </div>
        </div>
    </div>
    </div>
</div>
    <script>
    // JavaScript for automatic sliding
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlider();
    }

    function updateSlider() {
        const newTransformValue = -currentIndex * 100 + '%';
        document.querySelector('.slider').style.transform = 'translateX(' + newTransformValue + ')';
    }

    setInterval(nextSlide, 5000); // Change slide every 5 seconds
    </script>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>


	
