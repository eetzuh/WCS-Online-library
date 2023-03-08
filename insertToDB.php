<?php
include './addBook.php';
include 'db_connection.php';

$name=$_POST['bookName'];


header('location:./addBook.php');
?>