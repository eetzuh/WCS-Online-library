<?php
include 'db_connection.php';
session_start();

if(isset($_POST['borrow'])){
    $isBorrowed='SELECT * FROM book_user WHERE book_id='.$_POST['borrow'];
    $isBorrowedQuery=mysqli_query($DBConnect, $isBorrowed);
    if(count(mysqli_fetch_all($isBorrowedQuery, MYSQLI_ASSOC))==0){
            $borrowBookQuery='INSERT INTO `book_user`(`id`, `book_id`, `user_id`,`quantity`) VALUES (null,'.$_POST['borrow'].',( SELECT users.id FROM users WHERE users.username = \''.$_SESSION['user'].'\'), 1)';
        mysqli_query($DBConnect,$borrowBookQuery);
    }else{
        $timesBorrowedQuery='UPDATE book_user SET book_user.quantity = book_user.quantity+1 where book_id='.$_POST['borrow'].' AND user_id=(SELECT users.id from users where users.username="'.$_SESSION['user'].'")';
        mysqli_query($DBConnect,$timesBorrowedQuery);
    }
    $availabilityQuery="UPDATE books SET books.quantity = books.quantity-1 where books.id=".$_POST['borrow'];
    mysqli_query($DBConnect, $availabilityQuery);
}


if(isset($_POST['return'])){
    $availabilityQuery="UPDATE books SET books.quantity = books.quantity+1 where books.id=".$_POST['return'];
    mysqli_query($DBConnect, $availabilityQuery);
    $borrowedQuantity="UPDATE `book_user` SET book_user.quantity= book_user.quantity-1 where book_id=".$_POST['return'].' AND user_id=(SELECT users.id from users where users.username="'.$_SESSION['user'].'")';
    mysqli_query($DBConnect, $borrowedQuantity);
    $timesBorrowed='SELECT quantity FROM book_user WHERE book_id='.$_POST['return'];
    $timesBorrowedQuery=mysqli_query($DBConnect, $timesBorrowed);
    $timesBorrowedArray=mysqli_fetch_all($timesBorrowedQuery, MYSQLI_ASSOC);
    if($timesBorrowedArray[0]['quantity']==0){
        $deleteBookQuery='DELETE FROM book_user WHERE book_id='.$_POST['return'];
        mysqli_query($DBConnect,$deleteBookQuery);
    }  
}

header('location:./mainpage.php')

?>