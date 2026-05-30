<?php
$servername = "localhost";
$username = "root";
$password = " "; // تأكد من كلمة المرور الخاصة بسيرفرك (MAMP غالباً root)
$database = "brilliant"; // اسم قاعدة البيانات المراد إنشاؤها

// 1. الاتصال المبدئي بالسيرفر
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. إنشاء قاعدة البيانات إذا لم تكن موجودة
$sql = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// 3. اختيار قاعدة البيانات للعمل عليها
mysqli_select_db($conn, $database);

// --- إنشاء الجداول وإدخال البيانات ---

// جدول المستخدمين (users)
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(3500) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    role VARCHAR(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($conn, $sql);

// إدخال مستخدمين (Admin و User)
mysqli_query($conn, "INSERT IGNORE INTO users (id, name, email, password, role) VALUES 
(1, 'Admin', 'admin@hotmail.com', 'admin', 'admin'),
(2, 'User 1', '2@hotmail.com', '2', 'user'),
(5, 'Admin 2', 'admin2@hotmail.com', '2', 'admin')");

// جدول المنتجات (products) - يدعم 3 صور والتصنيف
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description VARCHAR(200) NOT NULL,
    img1 VARCHAR(200) NOT NULL,
    img2 VARCHAR(200) DEFAULT NULL,
    img3 VARCHAR(200) DEFAULT NULL,
    price INT NOT NULL,
    category VARCHAR(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($conn, $sql);

// إدخال المنتجات من ملف الـ SQL الخاص بك
mysqli_query($conn, "INSERT IGNORE INTO products (id, title, description, img1, img2, img3, price, category) VALUES 
(1, 'Trinity ring', 'cushion-shaped', 'img1-1.avif', 'img1-2.avif', 'img1-3.avif', 4100, 'ring'),
(2, 'Trinity bracelet', 'cushion-shaped', 'img2-1.avif', 'img2-2.webp', 'img2-3.avif', 4100, 'bracelet'),
(3, 'Trinity earrings', 'classic model', 'img3-1.avif', 'img3-2.avif', 'img3-3.avif', 4100, 'earrings'),
(5, 'La Panthère de Cartier Watch', 'Cartier Watch', 'img5-1.avif', 'img5-2.avif', 'img5-3.avif', 4100, 'watch'),
(6, 'Panthère de Cartier bracelet', 'Cartier bracelet', 'img6-1.avif', 'img6-2.avif', 'img6-3.webp', 4100, 'bracelet')");

// جدول السلة (cart)
$sql = "CREATE TABLE IF NOT EXISTS cart (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($conn, $sql);

// جدول التواصل (contact)
$sql = "CREATE TABLE IF NOT EXISTS contact (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    title VARCHAR(200) NOT NULL,
    message VARCHAR(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($conn, $sql);

// جدول الطلبات (orders)
$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total INT NOT NULL,
    quntity INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($conn, $sql);

// إدخال بيانات تجريبية للطلبات
mysqli_query($conn, "INSERT IGNORE INTO orders (id, user_id, total, quntity) VALUES 
(1, 2, 8200, 2),
(2, 2, 4100, 1)");

// جدول عناصر الطلب (ordersItem)
$sql = "CREATE TABLE IF NOT EXISTS ordersItem (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
mysqli_query($conn, $sql);

// إدخال عناصر الطلبات
mysqli_query($conn, "INSERT IGNORE INTO ordersItem (id, order_id, product_id) VALUES 
(1, 1, 1),
(2, 1, 6),
(3, 2, 6)");

echo "<br>All tables created and data inserted successfully!";

mysqli_close($conn);

// التحويل لصفحة الهوم بعد الانتهاء (اختياري)
 header("Location: ../html/home.php");
?>