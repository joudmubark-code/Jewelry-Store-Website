<?php
require '../database/connection.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = "user";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
   }

   if (strlen($password) < 4) {
    die("Password must be at least 4 characters");
  } 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, role)
            VALUES ('$name', '$email', '$hashed_password', '$role')";

    if (mysqli_query($conn, $sql)) {
        header("Location:../html/login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>