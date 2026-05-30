<?php
    require '../database/connection.php';


  unset($_SESSION["userId"]);
 
  header("Location:../html/login.php");
  


?>

