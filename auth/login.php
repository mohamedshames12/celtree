<?php

include '../config/conncet.php';
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $password = sha1($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $verify_email = $conn->prepare("SELECT * FROM users WHERE email= ? AND password = ?");
    $verify_email->execute([$email, $password]);

    if ($verify_email->rowCount() > 0) {
        $fetch = $verify_email->fetch(PDO::FETCH_ASSOC);
        $verfiy_pass = password_verify($password, $fetch['password']);
            if ($verfiy_pass == 1) {
                $warning_msg[] = "your email or password is incorrect!";
            } else {
                if ($fetch['user-type'] == 'user') {
                    $_SESSION["user_id"] = $fetch['id_user'];
                    header('location: ../index.php');
                } elseif ($fetch['user-type'] == 'admin') {
                    $_SESSION["admin_id"] = $fetch['id_user'];
                    header('location: ../admin/php/index.php');
                    $success_msg[] = "admin!";
                }
            }
        } else{
            $warning_msg[] = "Email or password is incorrect!";
        }
    } 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../admin/assets/img/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <h2>Logination</h2>
            </div>

            <div class="line"></div>


            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login" name="login" class="btn">
            <p><a href="forget_password.php">Forgotten password?</a></p>
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