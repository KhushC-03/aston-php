<?php
  $db_host = "localhost";
  $db_name = "";
  $username = "";
  $password = "";

  // Create connection
  try{
    $db = new PDO("mysql:dbname=$db_name;host=$db_host",$username, $password);
  }
  catch(PDOException $e){
    echo("Error creating database connection ".$e->getMessage());
  }
  
  // Check connection
?>