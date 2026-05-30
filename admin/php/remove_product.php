<?php
include '../../database/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // احذف المنتج بناءً على الـ id
    $sql = "DELETE FROM products WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // رجوع للصفحة السابقة أو صفحة عرض المنتجات
        header("Location: ../html/products.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No product ID provided.";
}
?>
