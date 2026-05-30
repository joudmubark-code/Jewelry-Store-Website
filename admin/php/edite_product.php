<?php
include "../../database/connection.php";

if (isset($_POST['submit'])) {

    // 1. التطهير والتحقق من النصوص
    $id          = mysqli_real_escape_string($conn, $_POST['id']);
    $title       = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['title']));
    $description = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['description']));
    $price       = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $category    = mysqli_real_escape_string($conn, $_POST['category']);

    // 2. جلب الأسماء القديمة للصور في حال لم يتم تغييرها
    $sqlOld = "SELECT img1, img2, img3 FROM products WHERE id = '$id'";
    $resOld = mysqli_query($conn, $sqlOld);
    $oldData = mysqli_fetch_assoc($resOld);

    $upload_dir = "../../img/";
    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
    $final_images = [];

    // 3. حلقة معالجة الصور الثلاث
    for ($i = 1; $i <= 3; $i++) {
        $input_name = "img$i";
        
        if (!empty($_FILES[$input_name]['name'])) {
            $file_tmp = $_FILES[$input_name]['tmp_name'];
            $file_name = $_FILES[$input_name]['name'];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // التحقق من النوع
            if (in_array($ext, $allowed_ext)) {
                $new_name = time() . "_edit_$i." . $ext;
                move_uploaded_file($file_tmp, $upload_dir . $new_name);
                $final_images[$i] = $new_name;
                
                // (اختياري) حذف الصورة القديمة من السيرفر لتوفير المساحة
                // unlink($upload_dir . $oldData["img$i"]); 
            } else {
                $_SESSION['error'] = "Invalid format for Image $i.";
                header("Location: ../html/edite_product.php?id=$id");
                exit();
            }
        } else {
            // لم يتم رفع صورة جديدة -> احتفظ بالقديمة
            $final_images[$i] = $oldData["img$i"];
        }
    }

    // 4. تحديث البيانات باستخدام القيم المطهّرة
    $sql = "UPDATE products 
            SET 
                title = '$title',
                category = '$category',
                description = '$description',
                price = '$price',
                img1 = '{$final_images[1]}',
                img2 = '{$final_images[2]}',
                img3 = '{$final_images[3]}'
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "Product Updated Successfully!";
        header("Location: ../html/products.php");
    } else {
        $_SESSION['error'] = "Update Failed: " . mysqli_error($conn);
        header("Location: ../html/edite_product.php?id=$id");
    }
    exit();
}
?>