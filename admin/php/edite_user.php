<?php
include "../../database/connection.php";

// حماية إضافية: التأكد أن من ينفذ الطلب هو أدمن فعلي
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access.");
}

if (isset($_POST['submit'])) {

    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $new_role = mysqli_real_escape_string($conn, $_POST['role']);
    $current_admin_id = $_SESSION['userId'];

    // قفل أمان: منع الأدمن من تغيير رتبته الشخصية
    if ($user_id == $current_admin_id) {
        $_SESSION['error'] = "Security Alert: You cannot change your own role.";
        header("Location: ../html/edite_user.php?id=$user_id");
        exit();
    }

    // تحديث الرتبة في قاعدة البيانات
    $sql = "UPDATE users SET role = '$new_role' WHERE id = '$user_id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "User role updated successfully.";
        header("Location: ../html/users.php");
    } else {
        $_SESSION['error'] = "Database Error: " . mysqli_error($conn);
        header("Location: ../html/edite_user.php?id=$user_id");
    }
    exit();
} else {
    header("Location: ../html/users.php");
    exit();
}
?>