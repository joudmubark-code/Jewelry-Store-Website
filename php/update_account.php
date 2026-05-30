<?php
    require '../database/connection.php';

if (isset($_POST['submit'])) {
    // 1. استقبال البيانات وتطهيرها من الثغرات
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $userId = $_SESSION['userId']; 

    // 2. التحقق من صحة البيانات
    if (empty($name) || empty($email)) {
        $_SESSION['error'] = "Name and Email are required!";
        header("Location: ../html/account.php"); // العودة لصفحة الحساب
        exit();
    }

    // 3. بناء استعلام التحديث
    // إذا كانت كلمة المرور غير فارغة، نقوم بتحديثها أيضاً
    if (!empty($password)) {
        // تشفير كلمة المرور الجديدة (يفضل استخدام password_hash)
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
        // سأستخدم التشفير العادي إذا كنت تستخدمه في مشروعك، لكن الأفضل هو hash
        $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$userId";
    } else {
        // تحديث الاسم والإيميل فقط دون لمس كلمة المرور
        $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$userId";
    }

    // 4. تنفيذ الاستعلام
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Account updated successfully!";
        header("Location: ../html/account.php"); // العودة لصفحة الحساب
    } else {
        $_SESSION['error'] = "Error updating record: " . mysqli_error($conn);
        header("Location: ../html/account.php"); // العودة لصفحة الحساب
    }
} else {
        header("Location: ../html/account.php"); // العودة لصفحة الحساب
}

mysqli_close($conn);
?>