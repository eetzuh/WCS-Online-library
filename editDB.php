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


?>