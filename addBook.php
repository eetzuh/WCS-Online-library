<?php
include 'db_connection.php';
include('./login.php');
if (!$loggedUser) {
    header('Location:./index.php');
}
$_SESSION['page']="addBook";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./mainpage.css" />
    <title>Add Book - Library</title>
</head>

<body>
    <header>
        <div class="nav">
            <a href="./mainpage.php">
                <input type="button" value='Home' class='header-button' />
            </a>
        </div>
    </header>
    <div class='mt flex-js-center'>
        <div class='add-book-div flex-js-center'>
            <form action="./insertToDB.php" class='add-book-form' id='addBook' method="post">
                <div class='flex-col'>
                    <label for="bookName">Naziv knjige</label>
                    <input type="text" name="bookName" id="text-input" class='mt-5' required>
                </div>
                <div class='flex-col inputs-div'>
                    <label for="selectAuthor">Autor</label>
                    <div class='selectedItems mt-5' onchange='checkFields()'>
                        <input list='select-author' form='none' onchange="chosenItem(this, 'add')" id="selectAuthor" placeholder='Izaberi autora'>
                        <datalist id="select-author">
                            <?php
                            $authorNameQuery = "SELECT author FROM authors";
                            $authorNameDataQuery = mysqli_query($DBConnect, $authorNameQuery);
                            $authorNameData = mysqli_fetch_all($authorNameDataQuery, MYSQLI_NUM);
                            foreach ($authorNameData as $author) {
                                echo "<option> $author[0]</option>";
                            }
                            ?>

                        </datalist>
                        <div id='selected-author' class='selectedItems wrap mt-5'></div>
                    </div>
                    <label onclick="toggleAddItem('author')" id="add-author" class='toggle'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id='author-input-button' class="bi bi-plus-square-dotted" viewBox="0 0 16 16">
                            <path class='author-button-path' d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg></label>
                    <div id='add-new-author' class='selectedItems'>
                        <input type="text" form='none' id="text-input" class='new-author' style='display:none'>
                        <button onclick="addItem('author', 'add')" type="button" id='author-btn' style='display:none'>Dodaj</button>
                    </div>
                </div>
                <div class='flex-col inputs-div'>
                    <label for="selectCategory" multiple>Žanr</label>
                        <div class='selectedItems mt-5' onchange='checkFields()'>
                            <input list='select-category' form='none' onchange="chosenItem(this, 'add')" id="selectCategory" placeholder='Izaberi žanr'>
                            <datalist id="select-category">
                                <?php
                                $categoryNameQuery = "SELECT name FROM categories";
                                $categoryNameDataQuery = mysqli_query($DBConnect, $categoryNameQuery);
                                $categoryNameData = mysqli_fetch_all($categoryNameDataQuery, MYSQLI_NUM);
                                foreach ($categoryNameData as $category) {
                                    echo "<option> $category[0]</option>";
                                }
                                ?>
    
                            </datalist>
                        <div id='selected-category' class='selectedItems wrap mt-5'></div>
                    </div>
                    <label onclick="toggleAddItem('category')" id="add-category" class='toggle'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id='category-input-button' class="bi bi-plus-square-dotted" viewBox="0 0 16 16">
                            <path class='category-button-path' d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg></label>
                    <div id='add-new-category' class='selectedItems mt-5'>
                        <input type="text" form='none' id="text-input" class='new-category' style='display:none'>
                        <button onclick="addItem('category', 'add')" type="button" id='category-btn' style='display:none'>Dodaj</button>
                    </div>
                    </div>
                    <div class='flex-js-center inputs-div mt-5'>
                        <label for="number_of_pages">Broj strana</label>
                        <input type="number" name="number_of_pages" max='9999' min='1' id="number_input" required>

                        <label for="publication_date">Datum izdanja</label>
                        <input type="date" name="publication_date" id="date_input" required>

                        <label for="quantity">Količina</label>
                        <input type="number" name="quantity" max='9999' min='1' id="number_input" required>
                    </div>
                    <div class='flex-col inputs-div mt-5'>
                        <label for="description">Opis</label>
                        <textarea class='book-description-field' name="description" cols="30" rows="8" placeholder="Add description" required> </textarea>
                    </div>
                    <?php


                    ?>
                    <div class='inputs-div flex-end'>
                        <button type='submit' onclick="checkFields('addBook')" id='add-book-button'>Dodaj knjigu</button>
                    </div>
                    <div class='inputs-div flex-end'>
                    <div id='inputWarning'></div>                   
                 </div>
                   
            </form>
        </div>

    </div>
    <script src='./addBook.js'></script>
</body>

</html>