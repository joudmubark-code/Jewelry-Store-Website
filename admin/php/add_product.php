<?php
include '../../database/connection.php';

if (isset($_POST['submit'])) {

    // 1. التطهير (Sanitization) لمنع الـ XSS والرموز الضارة
    $title       = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['title']));
    $description = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['description']));
    $price       = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $category    = mysqli_real_escape_string($conn, $_POST['category']);

    // 2. التحقق (Validation)
    if (empty($title) || empty($price) || $price <= 0 || empty($category)) {
        $_SESSION['error'] = "Invalid input data.";
        header("Location: ../html/add_product.php");
        exit();
    }

    // 3. معالجة الصور بأمان
    $upload_dir = "../../img/";
    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
    $img_names = [];

    for ($i = 1; $i <= 3; $i++) {
        $file = $_FILES["img$i"];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // التحقق من الامتداد
        if (!in_array($ext, $allowed_ext)) {
            $_SESSION['error'] = "Invalid file type for Image $i. Only JPG, PNG, WEBP allowed.";
            header("Location: ../html/add_product.php");
            exit();
        }

        // توليد اسم فريد للصورة لمنع التكرار أو استبدال ملفات هامة
        $new_name = time() . "_$i." . $ext;
        if (move_uploaded_file($file['tmp_name'], $upload_dir . $new_name)) {
            $img_names[$i] = $new_name;
        } else {
            $_SESSION['error'] = "Failed to upload Image $i.";
            header("Location: ../html/add_product.php");
            exit();
        }
    }

    // 4. إدخال البيانات باستخدام الاستعلام المجهز (يفضل) أو المطهّر
    $sql = "INSERT INTO products (title, description, price, category, img1, img2, img3)
            VALUES ('$title', '$description', '$price', '$category', '{$img_names[1]}', '{$img_names[2]}', '{$img_names[3]}')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Product Added Successfully!";
        header("Location: ../html/products.php");
    } else {
        $_SESSION['error'] = "Database Error: " . mysqli_error($conn);
        header("Location: ../html/add_product.php");
    }
    exit();
}
?>