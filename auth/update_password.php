<?php

include '../config/conncet.php';
session_start();


    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $password = sha1($_POST['password']);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        $confirm_password = sha1($_POST['confirm-password']);
        $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);


      
            if($password !== $confirm_password){
                $warning_msg[]= 'Password does not match!';

            }else{
                $update_password = $conn->prepare("UPDATE users SET password = ? WHERE id_user = ?");
                $update_password->execute([$password, $id]);
                $success_msg[] = 'Password updated successfully!';
                header("location: login.php");
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

    

    </header>


    <div class="container">

        <form action="#" method="post" class="box">
            <div class="flex">
                <img src="../icons/logo.png" alt="">
                <h2>Update Password</h2>
            </div>

            <div class="line"></div>


            <label for="email"> Update Password:</label>
            <?php
                $select_user = $conn->prepare("SELECT * FROM users");
                $select_user->execute();
                $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);
            ?>
            <input type="password" id="password" name="password" placeholder="enter new password" required>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="confirm password" required>
            <input type="submit" value="update" name="update" class="btn">
            <input type="hidden" value="<?= $fetch_user['id_user']?>" name="id">
            <br>

        </form>
    </div>

    <!-- like sweetalert js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
    include '../alerts.php';
    ?>
</body>
</html>