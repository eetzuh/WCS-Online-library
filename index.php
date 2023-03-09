<?php

session_start();
if (isset($_SESSION['user'])) {
    header('Location: ./mainpage.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>

<body>
    <div>
        <div class='flex-js-center'>
            <div class='flex-col'>
                <div class='flex-row mt30 shadow rounded-borders'>
                    <img src='images/bookshelf.jpg' class='image'>
                    <form action="./index.php" method="POST">
                        <div class='form-container flex-js-center'>
                            <label for="username">Username</label>
                            <div class='flex-js-center'>
                                <input type="text" name="username" id="username" required>
                            </div>

                            <label for="password">Password</label>
                            <div class='flex-js-center'>
                                <input type="password" name="password" id="password" required>
                            </div>
                            <div class='validation-message flex-js-center'>

                                <?php
                                include 'db_connection.php';

                                if (isset($_POST['username'])) {
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    
                                    $loginValidation = mysqli_query($DBConnect, "SELECT * from users where username = '$username' and password = '$password'");
                                    $result = mysqli_fetch_assoc($loginValidation);
                                    if ($result) {
                                        $_SESSION['user'] = $username;
                                        header('Location: ./mainpage.php');
                                    } else {
                                        print('Invalid username or password');
                                    }
                                }

                                ?>
                            </div>
                            <div class='flex-end'>
                                <button type='submit' class='login-button'>Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class='flex-end'>
                    <div class='bookmark'></div>
                </div>
            </div>
        </div>
</body>

</html>