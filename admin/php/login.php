<?php
require '../../database/connection.php';

if (isset($_POST['submit'])) {
    
    // 1. تطهير المدخلات لمنع SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $required_role = "admin";

    // 2. البحث عن المستخدم بالإيميل فقط أولاً
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        // 3. التحقق من كلمة المرور والدور (Role)
        // ملاحظة: يفضل مستقبلاً استخدام password_verify() إذا كنت تشفر كلمات المرور
        if ($password == $row['password'] && $row['role'] == $required_role) {
            
            // تجديد معرف الجلسة للأمان (Prevent Session Fixation)
            session_regenerate_id(true);

            $_SESSION['userId'] = $row['id'];
            $_SESSION['userName'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            header("Location: ../html/dash.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid Password or Access Denied.";
            header("Location: ../html/login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email not found.";
        header("Location: ../html/login.php");
        exit();
    }

    mysqli_close($conn);
} else {
    header("Location: ../html/login.php");
    exit();
}
?>