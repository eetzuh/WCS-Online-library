<?php

$loginDBConnect = mysqli_connect('localhost', 'root', '', 'library_db');
 if (mysqli_connect_errno()) {
 echo "Failed to connect to database";
 exit();
}

 ?>