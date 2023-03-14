<?php
include './db_connection.php';
session_start();

$name=$_POST['bookName'];
$numberOfPages=$_POST['number_of_pages'];
$publicationDate=$_POST['publication_date'];
$quantity=$_POST['quantity'];
$description=$_POST['description'];

$newBookData="INSERT INTO `books`(`id`, `name`, `number_of_pages`, `publication_date`, `quantity`, `description`) VALUES (null,'$name','$numberOfPages','$publicationDate','$quantity','$description')";
mysqli_query($DBConnect, $newBookData);

if(isset($_POST['new_author'])){
    $newAuthors=$_POST['new_author'];
    foreach($newAuthors as $newAuthor){
        if($newAuthor!=null){
            $newAuthorQuery="INSERT INTO authors(`id`, `author`) VALUES (null, '$newAuthor')";
            mysqli_query($DBConnect, $newAuthorQuery);
            $bookAuthorQuery="INSERT INTO `book_author`(`id`, `book_id`, `author_id`) VALUES (null,(SELECT books.id FROM books WHERE books.name = '$name'), (SELECT authors.id FROM authors WHERE authors.author = '$newAuthor'))";
            mysqli_query($DBConnect, $bookAuthorQuery);
        }
    }
}

if(isset($_POST['new_category'])){
    $newCategories=$_POST['new_category'];
    foreach($newCategories as $newCategory){
        if($newCategory!=null){
            $newCategoryQuery="INSERT INTO categories (`id`, `name`) VALUES (null, '$newCategory')";
            mysqli_query($DBConnect, $newCategoryQuery);
            $bookCategoryQuery="INSERT INTO `book_category`(`id`, `book_id`, `category_id`) VALUES (null,(SELECT books.id FROM books WHERE books.name = '$name'), (SELECT categories.id FROM categories WHERE categories.name = '$newCategory'))";
            mysqli_query($DBConnect, $bookCategoryQuery);
        }
     }
}

if(isset($_POST['selected_author'])){
    $selectedAuthors=$_POST['selected_author'];
    foreach($selectedAuthors as $selectedAuthor){
        if($selectedAuthor!=null){
            $selectedAuthorQuery="INSERT INTO `book_author`(`id`, `book_id`, `author_id`) VALUES (null,(SELECT books.id FROM books WHERE books.name = '$name'), (SELECT authors.id FROM authors WHERE authors.author  = '$selectedAuthor'))";
            mysqli_query($DBConnect, $selectedAuthorQuery);
        }
    }
}

if(isset($_POST['selected_category'])){
    $selectedCategories=$_POST['selected_category'];
    foreach($selectedCategories as $selectedCategory){
        if($selectedCategory!=null){
            $selectedCategoryQuery="INSERT INTO `book_category`(`id`, `book_id`, `category_id`) VALUES (null,(SELECT books.id FROM books WHERE books.name = '$name'), (SELECT categories.id FROM categories WHERE categories.name = '$selectedCategory'))";
           mysqli_query($DBConnect, $selectedCategoryQuery);
        }
    }
}


header('location:./mainpage.php');
?>