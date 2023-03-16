<?php
include './db_connection.php';
session_start();

$bookId=$_SESSION['bookID'];
if(isset($_POST['selected_category'])){
    foreach($_POST['selected_category'] as $category){
    print_r($category);
    }
}

$name=$_POST['bookName'];
$numberOfPages=$_POST['number_of_pages'];
$publicationDate=$_POST['publication_date'];
$quantity=$_POST['quantity'];
$description=$_POST['description'];
function deleteElem($elem){
    global $bookId;
    global $DBConnect;
    
    $left=$_POST["previous_$elem"];
    $original=$_POST["compare_previous_$elem"];
    
    if(isset($_POST["previous_$elem"])){
        $deletedElems=array_diff($original, $left);
        foreach($deletedElems as $deletedElem){
            if($elem=='author'){
                $deleteAuthorQuery="DELETE book_author FROM book_author LEFT JOIN authors on authors.id= author_id WHERE author= '$deletedElem' AND book_id='$bookId'";
                mysqli_query($DBConnect, $deleteAuthorQuery);
            }else{
                $deleteCategoryQuery="DELETE book_category FROM book_category LEFT JOIN categories on categories.id= category_id WHERE categories.name= '$deletedElem' AND book_id='$bookId'";
                mysqli_query($DBConnect, $deleteCategoryQuery);
            }
        }
    }else{
        foreach($original as $deletedElem){
            if($elem=='author'){
                $deleteAuthorQuery="DELETE book_author FROM book_author LEFT JOIN authors on authors.id= author_id WHERE author= '$deletedElem' AND book_id='$bookId'";
                mysqli_query($DBConnect, $deleteAuthorQuery);
            }else{
                $deleteCategoryQuery="DELETE book_category FROM book_category LEFT JOIN categories on categories.id= category_id WHERE categories.name= '$deletedElem' AND book_id='$bookId'";
                mysqli_query($DBConnect, $deleteCategoryQuery);
            }
        }
    }
}

if($_POST['previous_author']!=$_POST['compare_previous_author']){
    deleteElem('author');
}
if($_POST['previous_category']!=$_POST['compare_previous_category']){
    deleteElem('category');
}


$editBookQuery="UPDATE books SET books.name ='$name' , number_of_pages='$numberOfPages' , publication_date= '$publicationDate' ,  quantity= '$quantity' , description= '$description' WHERE books.id=$bookId";
mysqli_query($DBConnect, $editBookQuery);
print($editBookQuery);

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

header('location: ./mainpage.php')
?>