<?php
include './addBook.php';
include 'db_connection.php';

$name=$_POST['bookName'];
$numberOfPages=$_POST['number_of_pages'];
$publicationDate=$_POST['publication_date'];
$quantity=$_POST['quantity'];
$description=$_POST['description'];

$newBookData="INSERT INTO `books`(`id`, `name`, `number_of_pages`, `publication_date`, `quantity`, `description`) VALUES (null,'$name','$numberOfPages','$publicationDate','$quantity','$description')";
mysqli_query($DBConnect, $newBookData);

if(isset($_POST['new_author'])){
    $newAuthor=$_POST['new_author'];
    foreach($newAuthor as $author){
       $newAuthorQuery="INSERT INTO authors(`id`, `author`) VALUES (null, '$author')";
       mysqli_query($DBConnect,$newAuthorQuery);
    }
}

if(isset($_POST['new_category'])){
    $newCategory=$_POST['new_category'];
    foreach($newCategory as $category){
        $newCategoryQuery="INSERT INTO categories (`id`, `name`) VALUES (null, '$category')";
        mysqli_query($DBConnect,$newCategoryQuery);
     }
}

if(isset($_POST['selected_author'])){
    $selectedAuthor=$_POST['selected_author'];
    foreach($selectedAuthor as $author){
        $selectedAuthorQuery="INSERT INTO `book_author`(`id`, `book_id`, `author_id`) VALUES (null,(SELECT books.id FROM books WHERE books.name = '$name'), (SELECT authors.id FROM authors WHERE authors.author  = '$author'))";
        mysqli_query($DBConnect, $selectedAuthorQuery);
    }
}

if($_POST['selected_category']){
    $selctedCategory=$_POST['selected_category'];
    foreach($selectedCategory as $category){
        $selectedCategoryQuery="INSERT INTO `book_category`(`id`, `book_id`, `category_id`) VALUES (null,(SELECT books.id FROM books WHERE books.name = '$name'), (SELECT categories.id FROM categories WHERE categories.name = '$category'))";
       mysqli_query($DBConnect, $selectedCategoryQuery);
    }
}



// header('location:./addBook.php');
?>