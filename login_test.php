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
    <title>Makeup Mosh: Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-image: url("login.gif");
            background-color: #000000;
            font-family: 'Serif';
            overflow: hidden;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        .card-title {
            padding: 20px;
            background: linear-gradient(to right, #ff66b2, #ffb366);
            border-radius: 15px 15px 0 0;
            text-align: center;
            color: #fff;
        }

        .brand-logo {
            max-width: 80px;
            margin-right: 10px;
        }

        .brand-name {
            font-weight: bold;
            font-size: 1.5em;
            margin-bottom: 0;
        }

        .card-body {
            padding: 20px;
            background: #fff;
            border-radius: 0 0 15px 15px;
        }

        .form-control {
            height: 40px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .login-btn {
            font-weight: bold;
            color: #fff;
            background-color: #FF6E9E;
            border: none;
            border-radius: 5px;
            height: 40px;
            cursor: pointer;
        }

        .login-btn:hover {
            background: linear-gradient(to right, #ffb366, #ff66b2); }

            @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        <style>
    .input-container {
        position: relative;
    }

    .input-gif {
        position: absolute;
        top: 50%;
        right: 10px; /* Adjust the value based on your preference */
        transform: translateY(-50%);
        max-width: 20px; /* Adjust the width based on your GIF size */
        max-height: 20px; /* Adjust the height based on your GIF size */
    }

    </style>
</head>
<body>

<div class="login-container">
    <div class="card">
        <div class="card-title text-center">
            <!--<img src="makeupmoshicon.png" alt="Makeup Mosh Logo" class="brand-logo"> <br><br>-->
            <h1 class="brand-name">Makeup Mosh</h1>
        </div>

        <div class="card-body">
            <form method="post">
                <input type="text" name="email" class="form-control" placeholder="Enter your email" required="">
                <img src="loginemail.gif" alt="Email GIF" class="input-gif">
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required="">
                <button type="submit" name="login" class="btn btn-block login-btn">Login</button>
            </form>
        </div>
    </div>
</div>


<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>


    
