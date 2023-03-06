<?php
include './login.php';
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
        <div><?php print_r($userInfo)?></div>
        <div class='flex-end'>
            <form action="./logOut.php" method="post">
            <button type='sumbit' class='log-out-button'>Log Out</button>
        </form>
        </div>
        </div>
    </header>
            <!-- <div class='flex-js-center mt'>
                <div class='search'>
                    <form action="./mainpage.php">
                        <label for=""></label>
                        <input type="text" name="" id="">
                    </form>
                </div>
            </div> -->
                <?php
                if(isset($_SESSION['count'])){
                    print_r($_GET);
                    $_SESSION['count']+=1;
                }else{
                    $_SESSION['count']=1;
                }
                print($_SESSION['count']);
                ?>
    <div class='flex-js-center'>
        <div class='table mt'>
            <div class='flex-end sort-buttons'>
                <form action="./mainpage.php" method='GET'>
                    <button class='sort-button' name='sortASC'>Sort by asc</button>
                    <button class='sort-button' name='sortDESC'>Sort by desc</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr class='thead-row'>
                        <th>Naziv knjige</th>
                        <th>Autor</th>
                        <th>Broj strana</th>
                        <th>Datum izdanja</th>
                        <th>Dostupnost</th>
                        <th>Opis</th>
                    </tr>
            </thead>
            <tbody>
                <?php
                    $booksQuery="SELECT books.name as name, books.number_of_pages, books.publication_date, books.quantity, books.description,author from books, authors, book_author WHERE books.id=book_author.book_id AND authors.id = book_author.author_id";
                    $booksDataQuery=mysqli_query($DBConnect, $booksQuery);
                    $booksData= mysqli_fetch_all($booksDataQuery, MYSQLI_ASSOC);
                    if(isset($_GET['sortASC'])){
                        $sortQuery=$booksQuery." ORDER BY name ASC";
                        $sortedBooksQuery=mysqli_query($DBConnect, $sortQuery);
                        $sortedBooks=mysqli_fetch_all($sortedBooksQuery, MYSQLI_ASSOC);
                        $booksData=$sortedBooks;
                    }else if(isset($_GET['sortDESC'])){
                        $sortQuery=$booksQuery." ORDER BY name DESC";
                        $sortedBooksQuery=mysqli_query($DBConnect, $sortQuery);
                        $sortedBooks=mysqli_fetch_all($sortedBooksQuery, MYSQLI_ASSOC);
                        $booksData=$sortedBooks;
                    }
                    foreach($booksData as $book){
                        $availability="Posuđeno";
                        if($book['quantity']>0){
                            $availability="Dostupno";
                        }
                        if(strlen($book['description'])>60){
                            $shortenedDescription=substr($book['description'],0,61);
                        }
                        echo "<tr><td>".$book['name']."</td>".
                        "<td>".$book['author']."</td>".
                        "<td>".$book['number_of_pages']."</td>".
                        "<td>".$book['publication_date']."</td>".
                        "<td>".$availability."</td>".
                        "<td class='description-col'>".$shortenedDescription."</td>".
                        "</tr>"
                        ;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>