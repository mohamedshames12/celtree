<?php

    include './config/conncet.php';
    session_start();
    
    if(isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }else {
        $user_id = "";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="admin/assets/img/favicon/favicon.ico" />
    <!-- link cdnjs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- link file css -->
    <link rel="stylesheet" href="css/style.css">
    <title>celtree</title>
</head>
<body>
<header class="header">
    <a href="index.php"><img src="icons/logo.png" alt="logo" class="logo"></a>

    <div class="search">
        <input type="search" placeholder="search anything..." class="input-cearch">
        <i class="fas fa-light fa-magnifying-glass"></i>
    </div>

    <?php

    $profile = $conn->prepare("SELECT * FROM `users` WHERE id_user = ?");
    $profile->execute([$user_id]);

    if ($profile->rowCount() > 0) {
        $fetch_profile = $profile->fetch(PDO::FETCH_ASSOC);
    ?>
        <div class="auth logout">
            <a href="auth/logout.php" style="padding: 2px 15px;"> LogOut</a>
        </div>
    <?php
    } else {
    ?>

        <div class="auth">
            <a href="auth/register.php"> <img src="icons/user.png" alt=""> Login && Register</a>
        </div>
    <?php
    }

    ?>

    <div class="shop">
        <a href="#"><img src="icons/shopping-bag.png" alt=""></a>
        <p>2</p>
    </div>


</header>

    
</body>
</html>