<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// التحقق: إذا لم يكن هناك ID مستخدم أو إذا كانت الرتبة ليست 'admin'
if (!isset($_SESSION['userId']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    
    // مسح السيشين للأمان
    session_unset();
    session_destroy();
    
    // التوجيه لصفحة تسجيل الدخول
    header("Location: ../html/login.php");
    exit();
}
?>