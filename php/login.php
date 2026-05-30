<?php
    require '../database/connection.php';



if (isset($_POST['submit']))
{
    
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $required_role = "user";
    // Server-side Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       die("Invalid email format");
    }

    if (strlen($password) < 4) {
        die("Password must be at least 4 characters");
    }



   
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $res = $stmt->get_result();
            if (mysqli_num_rows($res) > 0) 
            {
                // output data of each row]
                //   $row = mysqli_fetch_assoc($res);
                // if($email==$row['email'] && $password==$row['password'])
                //   {
                //     $_SESSION['userId']=$row['id'];
                //     header("Location:../html/home.php");
                //   }
                //   else {
                //     $_SESSION['error']="Email or Password not valid";
                //     header("Location:../html/login.php");
                //   }


// ------------------- weak session
//                 $row = mysqli_fetch_assoc($res);
// if($email == $row['email'] && password_verify($password, $row['password']) && $row['role'] == $required_role) {
    
//     // --- بداية الجزء الضعيف (Weak Session ID) ---
//     // بدلاً من رقم عشوائي،  MD5 لـ ID المستخدم كمعرف للجلسة
//     //  يعني  أي شخص يعرف الـ ID    توقع الـ Session ID
//     $weak_token = md5($row['id']); 
    
    // session_write_close();
    // session_id($weak_token); // تعيين المعرف الضعيف يدوياً
    // session_start();         // بدء الجلسة بهذا المعرف
    // --- نهاية الجزء الضعيف ---


    // ------------------- weak session

$row = mysqli_fetch_assoc($res);

if($email == $row['email'] && password_verify($password, $row['password']) && $row['role'] == $required_role) {

    session_start();
    session_regenerate_id(true);

    $_SESSION['userId'] = $row['id'];

    header("Location:../html/home.php");
    exit();

} else {
    $_SESSION['error'] = "Email or Password not valid";
    header("Location:../html/login.php");
}

    $_SESSION['userId'] = $row['id'];
    header("Location:../html/home.php");
} else {
    $_SESSION['error'] = "Email or Password not valid";
    header("Location:../html/login.php");
}

// ------------------- weak session




           } 
           else
           {
            $_SESSION['error']=" Email not valid  ";
            header("Location:../html/login.php");
           }

          
 
           mysqli_close($conn);
   

?>
