<?php
include './db_connection.php';
include('./login.php');
if (!$loggedUser) {
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
                <form action='./mainpage.php' method='get'>
                    <div class='flex-js-center'>
                        <input type="text" name="searchBook" id='search-field' placeholder="Pretraži knjigu, autora...">
                        <button type='submit' class='search-button'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
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
                    <button class='sort-button' name='submit'>Sortiraj</button>
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

                    $booksQuery = "SELECT books.id, books.name as name, books.number_of_pages, books.publication_date, books.quantity, books.description FROM books ORDER BY $sort";
                    $booksDataQuery = mysqli_query($DBConnect, $booksQuery);
                    $booksData = mysqli_fetch_all($booksDataQuery, MYSQLI_ASSOC);

                    if (isset($_GET['searchBook'])) {
                        $_SESSION['search']=$_GET['searchBook'];
                    }

                    if(isset($_SESSION['search'])){
                        $searchTerm = $_SESSION['search'];
                        if ($searchTerm != "") {
                            $booksQuery = "SELECT books.id, books.name as name, books.number_of_pages, books.publication_date, books.quantity, books.description FROM books, authors, book_author where (name LIKE '%$searchTerm%' OR author like '%$searchTerm%') AND authors.id=book_author.author_id AND book_author.book_id= books.id  ORDER BY $sort";
                            $booksDataQuery = mysqli_query($DBConnect, $booksQuery);
                            $searchedBooks = mysqli_fetch_all($booksDataQuery, MYSQLI_ASSOC);
                            $booksData = $searchedBooks;
                        }
                    }

                    if (count($booksData) > 0) {
                        $id = 1;
                        foreach ($booksData as $book) {
                            //u kolonu autor dodajem sve autore vezane za odredjenu knjigu, uzimajući iz baze grupirane autore 
                            $authorsQuery = "SELECT GROUP_CONCAT( DISTINCT author) as author from authors, book_author where authors.id=book_author.author_id AND book_author.book_id=" . $book['id'];
                            $authorsDataQuery = mysqli_query($DBConnect, $authorsQuery);
                            $authors = mysqli_fetch_all($authorsDataQuery, MYSQLI_ASSOC);

                            //isto važi i za kolonu žanr
                            $categoryQuery = "SELECT GROUP_CONCAT(DISTINCT categories.name) as category_name from categories, book_category where categories.id=book_category.category_id AND book_category.book_id=" . $book['id'];
                            $categoryDataQuery = mysqli_query($DBConnect, $categoryQuery);
                            $categories = mysqli_fetch_all($categoryDataQuery, MYSQLI_ASSOC);
                            $availability = "Posuđeno";
                            //čitajući kolonu quantity iz tabele books, u kolonu dostupnost dodajem odgovarajuću
                            if ($book['quantity'] > 0) {
                                $availability = "Dostupno<br>Ukupno:" . $book['quantity'];
                                $available='available';
                            } else {
                                $availability = "Posuđeno";
                                $available='not-available';
                            }
                            $borrowed='not-borrowed';
                            $borrowedBookQuery="SELECT * FROM book_user WHERE book_id=".$book['id'];
                            $borrowedBooks=mysqli_query($DBConnect, $borrowedBookQuery);
                            $borroewdBooksArray=mysqli_fetch_all($borrowedBooks, MYSQLI_ASSOC);
                            if(count($borroewdBooksArray)>0){
                                $borrowed='is-borrowed';
                            }
                            if (strlen($book['description']) > 90) {
                                $description = substr($book['description'], 0, 90) . "...";
                            } else {
                                $description = $book['description'];
                            }
                            echo "<tr> <td onclick='edit(". $book['id'].")'>" . $book['name'] . "</td>" .
                                "<td onclick='edit(". $book['id'].")'>" . $authors[0]['author'] . "</td>" .
                                "<td onclick='edit(". $book['id'].")'>" . $book['number_of_pages'] . "</td>" .
                                "<td onclick='edit(". $book['id'].")'>" . $categories[0]['category_name'] . "</td>" .
                                "<td onclick='edit(". $book['id'].")'>" . $book['publication_date'] . "</td>" .
                                "<td onclick='edit(". $book['id'].")' id='availability-$id'>" . $availability . "</td>" .
                                "<td onclick='edit(". $book['id'].")'  class='description-col'>" . $description . "</td>" .
                                '<td style="display:none"><form action="./editBook.php" id="editBook'.$id.'" method="get"><input type="text" name="edit_book" style="display:none" value="'.$book['id'].'"/><button>Uredi</button></form></td>' .
                                '<td class="buttonsCol">
                                <div class="flex-col flex-js-center">
                                <form action="./userBook.php" method="post" id="borrow-form-'.$book['id'].'">
                                <input style="display:none" type="text" name="borrow" id="borrow-'.$book['id'].'">
                                <button type="button" class="'.$available.'" onclick="useBook(\'borrow\', '.$book["id"].')">Pozajmi</button>
                                </form>
                                <form action="./userBook.php" method="post" id="return-form-'.$book['id'].'">
                                <input style="display:none" type="text" name="return" id="return-'.$book['id'].'"">
                                <button type="button" class="'.$borrowed.'" onclick="useBook(\'return\', '.$book["id"].')">Vrati</button>
                                </form><div></td>'.
                                "</tr>";
                            $id++;
                        }
                    } else {
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