<?php
include './db_connection.php';
session_start();

$deleteBookQuery="DELETE books FROM books WHERE books.id=". $_SESSION['bookID'];
mysqli_query($DBConnect, $deleteBookQuery);

header('location:./mainpage.php');
?>