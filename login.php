<?php
include 'db_connection.php';

session_start();
$loggedUser= $_SESSION['user'];
$userInfoQuery=mysqli_query($DBConnect, "SELECT * from users where username = '$loggedUser'");
$userInfo=mysqli_fetch_assoc($userInfoQuery);

?>