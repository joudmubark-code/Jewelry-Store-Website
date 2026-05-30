<?php
$servername = "localhost";
$username = "root";
$password = " ";
$database="brilliant";

// connection
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
session_start();



  if (isset($_SESSION['userId']))
  {
      $userId=$_SESSION['userId'];
  
  }
  else {
      $userId=0;
  } 
    $user_id =  $userId;
?>