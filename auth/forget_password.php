<?php

include '../config/conncet.php';
include_once '../mail.php';
session_start();

    if(isset($_POST['check'])){
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $code = rand(10000,90000);
        $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $check_email->execute([$email]);

        if($check_email->rowCount() > 0){
            $insert_code = $conn->prepare("INSERT INTO `forgot`( email, code) VALUES(?,?)");
            $insert_code->execute([$email,$code]);
            
            send_mail($email,'Password reset',"Your code is " . $code);
            $success_msg[] = 'successfully!';
            header("location: check_code.php");
        }else{
            $warning_msg[] = 'Email not found!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../admin/assets/img/favicon/favicon.ico" />
    <!-- link cdnjs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- link file css -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- login css file -->
    <link rel="stylesheet" href="../css/login_register.css">
    <title>celtree || Login && Register</title>
</head>

<body>


    <header class="header">
        <a href="../index.php"><img src="../icons/logo.png" alt="logo" class="logo"></a>

        <div class="search">
            <input type="search" placeholder="search anything..." class="input-cearch">
            <i class="fas fa-light fa-magnifying-glass"></i>
        </div>

        <div class="auth">
            <a href="register.php"> <img src="../icons/user.png" alt=""> Login && Register</a>
        </div>

        <div class="shop">
            <a href="#"><img src="../icons/shopping-bag.png" alt=""></a>
            <p>2</p>
        </div>

    </header>


    <div class="container">

        <form action="#" method="post" class="box">
            <div class="flex">
                <img src="../icons/logo.png" alt="">
                <h2>forget password</h2>
            </div>

            <div class="line"></div>


            <label for="email"> Your email:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Check" name="check" class="btn">
            <br>
            <div class="line"></div>
            <a href="register.php" class="create">Create new account</a>
        </form>
    </div>

    <!-- like sweetalert js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include '../alerts.php';
    ?>
</body>
</html>