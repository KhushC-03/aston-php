<?php
session_start();
if (!empty(trim($_SESSION['username']))){
    $email = '';
    header("Location:https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/home.php",302);
}
else{
    unset($_SESSION['username']);
    $email = '';
    session_destroy();
    header("Location:https://210081093.cs2410-web01pvm.aston.ac.uk/cvs/home.php",302);
}




?>
