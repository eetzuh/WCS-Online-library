<?php
include './db_connection.php';
if(!$loggedUser){
    header('Location:./index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./mainpage.css">
    <title>Online Library</title>
</head>
<body>
    <header>
        <div class='nav'>
            <div class='search-div'>
            <form action="./mainpage.php" method='get'>
                <div class='flex-js-center'>
                    <input type="text" name="searchBook" id='search-field'>
                    <button type='submit' class='search-button'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></button>
                </div>
            </form>
        </div>
        <div class='flex-end'>
            <form action="./logOut.php" method="post">
            <button type='sumbit' class='log-out-button header-button'>Log Out</button>
        </form>
            </div>
    </div>
    </header>
    <div class='flex-js-center'>
        <div class='table mt'>
            <div class='flex-end sort-buttons'>
                <form action="./mainpage.php" method='post'>
                    <select name="sort_table" id="sort-table">
                        <option value="selectSort">Sort by</option>
                        <option value="sortASC">ASC</option>
                        <option value="sortDESC">DESC</option>
                    </select>
                    <button class='sort-button' name='submit'>Sort</button>
                </form>
                <form action="./addBook.php">
                    <button class='sort-button'>Dodaj knjigu</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr class='thead-row'>
                        <th>Naziv knjige</th>
                        <th>Autor</th>
                        <th>Broj strana</th>
                        <th>Žanr</th>
                        <th>Datum izdanja</th>
                        <th>Dostupnost</th>
                        <th>Opis</th>
                    </tr>
            </thead>
            <tbody>
                <?php

                $sort = 'id';
                if (isset($_POST['sort_table'])) {
                    if ($_POST['sort_table'] == 'sortASC') {
                        $sort = ' name ASC';
                    } else if ($_POST['sort_table'] == 'sortDESC') {
                        $sort = ' name DESC';
                    } else {
                        $sort = 'id';
                    }
                }
                
                    $booksQuery="SELECT books.id, books.name as name, books.number_of_pages, category.name as category_name, books.publication_date, books.quantity, books.description,author FROM books, authors, category, book_author, book_category WHERE books.id=book_author.book_id AND authors.id = book_author.author_id AND category.id= book_category.category_id AND books.id = book_category.book_id ORDER BY $sort";
                    $booksDataQuery=mysqli_query($DBConnect, $booksQuery);
                    $booksData=mysqli_fetch_all($booksDataQuery, MYSQLI_ASSOC);
                    function removeDuplicates(){
                        global $booksData;
                        for($i=0;$i<count($booksData)-1;$i++){
                            if($i<count($booksData)){
                                if($booksData[$i+1]['name']==$booksData[$i]['name']){
                                    if($booksData[$i]['category_name']!=$booksData[$i+1]['category_name']){
                                        $booksData[$i]['category_name'].=", ".$booksData[$i+1]['category_name'];
                                    }
                                    if($booksData[$i]['author']!=$booksData[$i+1]['author']){
                                        $booksData[$i]['author'].=", ".$booksData[$i+1]['author'];
                                    }
                                    unset($booksData[$i+1]);
                                    $booksData=array_values($booksData);
                                }
                            }
                        }
                        return $booksData;
                    }
                    removeDuplicates();
                if (isset($_GET['searchBook'])) {
                    $searchTerm = $_GET['searchBook'];
                    if ($searchTerm != "") {
                        $booksQuery = "SELECT books.id, books.name as name, books.number_of_pages, category.name as category_name, books.publication_date, books.quantity, books.description,author FROM books, authors, category, book_author, book_category WHERE (books.id=book_author.book_id AND authors.id = book_author.author_id AND category.id= book_category.category_id AND books.id = book_category.book_id)  AND (books.name LIKE '%$searchTerm%' OR author like '%$searchTerm%') ORDER BY $sort";
                        $booksDataQuery = mysqli_query($DBConnect, $booksQuery);
                        $searchedBooks = mysqli_fetch_all($booksDataQuery, MYSQLI_ASSOC);
                        $booksData = $searchedBooks;
                        removeDuplicates();
                    }
                }
                        if(count($booksData)>0){
                            $id=1;
                        foreach($booksData as $book){
                            $availability="Posuđeno";
                            if($book['quantity']!=="0"){
                                $availability="Dostupno";
                            }else{
                                $availability="Posuđeno";
                            }
                            if(strlen($book['description'])>90){
                                $shortenedDescription=substr($book['description'],0,90)."...";
                            }
                            echo "
                            <tr style='display:none'><td>".$book['id']."</td>.
                            <tr><td>".$book['name']."</td>".
                            "<td>".$book['author']."</td>".
                            "<td>".$book['number_of_pages']."</td>".
                            "<td>".$book['category_name']."</td>".
                            "<td>".$book['publication_date']."</td>".
                            "<td id='availability-$id'>".$availability."</td>".
                            '<td class="description-col">'.$shortenedDescription."</td>".
                            "</tr>"
                            ;
                            $id++;
                        }

                    }else{
                        echo '<tr class="search-message"><td class="search-message">No matches found.</tr></td>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src='./mainpage.js'></script>
</body>
</html>