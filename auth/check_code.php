<?php

include '../config/conncet.php';
session_start();

    if(isset($_POST['check'])){
        $code = $_POST['code'];
        $code = filter_var($code, FILTER_SANITIZE_STRING);
      
        $check_code = $conn->prepare("SELECT * FROM forgot WHERE code = ?");
        $check_code->execute([$code]);

        if($check_code->rowCount() > 0){
            $success_msg[] = 'successfully  code!';
            header("location: update_password.php");
        }else{
            $warning_msg[] = 'incorrect code!';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    

    </header>


    <div class="container">

        <form action="#" method="post" class="box">
            <div class="flex">
                <img src="../icons/logo.png" alt="">
                <h2>check code</h2>
            </div>

            <div class="line"></div>


            <label for="email"> Your Code:</label>
            <input type="number" id="code" name="code" required>
            <input type="submit" value="Next" name="check" class="btn">
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