<?php

    include '../config/conncet.php';

   
    if(isset($_POST['register'])){
        $id = create_unique_id();
        $fname = $_POST['fname'];
        $fname = filter_var($fname, FILTER_SANITIZE_STRING);
        $lname = $_POST['lname'];
        $lname = filter_var($lname, FILTER_SANITIZE_STRING);
        $phone = $_POST['phone'];
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);
        $counrty = $_POST['country'];
        $counrty = filter_var($counrty, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $password = sha1($_POST['password']);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        $password_confirm = sha1($_POST['confirm-password']);
        $password_confirm = filter_var($password_confirm, FILTER_SANITIZE_STRING);

        $verify_email = $conn->prepare("SELECT * FROM users WHERE email= ? AND phone = ?");
        $verify_email->execute([$email, $phone]);

        if($verify_email->rowCount() > 0) {
            $warning_msg[] = "You have already registered!";
        }else {
            if($password != $password_confirm) {
                $warning_msg[] = "Passwords do not match!";
            }else {
                $insert_email = $conn->prepare("INSERT INTO users (id,fname, lname, phone, country, email, password) VALUES (?,?,?,?,?,?,?)");
                $insert_email->execute(array($id,$fname, $lname, $phone, $counrty, $email, $password));
                $success_msg[] = "registered successfully!";
                header("location: login.php");
            }
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

        <div class="shop">
            <a href="#"><img src="../icons/shopping-bag.png" alt=""></a>
            <p>2</p>
        </div>

    </header>


    <div class="container">
        
        <form action="#" method="post" class="box">
            <div class="flex">
                <img src="../icons/logo.png" alt="">
                <h2>Registration</h2>
            </div>

            <div class="line"></div>

            <div class="full-name">
                <div class="f">
                    <p>First Name: </p>
                    <input type="text" id="fname" name="fname" required>
                </div>
                <div class="l">
                    <p>Last Name:</p>
                    <input type="text" id="lname" name="lname" required>
                </div>
            </div>
            <label for="phone">Phone:</label>
            <input type="number" id="phone" name="phone" required>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="password">Confirm Password:</label>
            <input type="password" id="password" name="confirm-password" required>
            <input type="submit" value="Register" name="register" class="btn">
            <p>Have an account? <a href="login.php">Login Now</a></p>
        </form>
    </div>

        <!-- like sweetalert js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php
        include '../alerts.php';
    ?>
</body>
</html>