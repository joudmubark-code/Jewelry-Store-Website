<?php 
include '../php/check_admin.php'; // حماية الصفحة - الأدمن فقط يدخل
include 'header.php'; 
?>

<?php
// 1. جلب عدد المنتجات
$sql_products = "SELECT COUNT(id) AS total FROM products";
$result_products = mysqli_query($conn, $sql_products);
$row_products = mysqli_fetch_assoc($result_products);
$num_products = $row_products['total'];

// 2. جلب عدد المستخدمين
$sql_users = "SELECT COUNT(id) AS total FROM users";
$result_users = mysqli_query($conn, $sql_users);
$row_users = mysqli_fetch_assoc($result_users);
$num_users = $row_users['total'];
?>

<section class="section">
    <h1 class="section-title">Admin Dashboard</h1> 

    <div class="container">
        <!-- قسم الكروت الإحصائية -->
        <div style="display: flex; gap: 20px; justify-content: center; margin-bottom: 40px;">
            
            <!-- كرت المنتجات -->
            <div style="background: rgba(255,255,255,0.05); border: 1px solid #f6a019; padding: 30px; border-radius: 8px; width: 250px; text-align: center;">
                <h3 style="color: #f6a019; text-transform: uppercase; font-size: 14px; margin-bottom: 10px; letter-spacing: 1px;">Total Products</h3>
                <p style="font-size: 36px; font-weight: bold; color: #fff; margin: 0;">
                    <?php echo $num_products; ?>
                </p>
            </div>

            <!-- كرت المستخدمين -->
            <div style="background: rgba(255,255,255,0.05); border: 1px solid #f6a019; padding: 30px; border-radius: 8px; width: 250px; text-align: center;">
                <h3 style="color: #f6a019; text-transform: uppercase; font-size: 14px; margin-bottom: 10px; letter-spacing: 1px;">Total Users</h3>
                <p style="font-size: 36px; font-weight: bold; color: #fff; margin: 0;">
                    <?php echo $num_users; ?>
                </p>
            </div>

        </div>

        <!-- أزرار التنقل -->
        <div class="center-div" style="max-width: 500px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
            
            <a href="products.php" class="form-button" style="text-decoration: none; display: block; text-align: center; background: #f6a019; color: #000; font-weight: bold; padding: 15px; text-transform: uppercase;">
                Manage Products List
            </a>

            <a href="users.php" class="form-button" style="text-decoration: none; display: block; text-align: center; border: 1px solid #f6a019; background: transparent; color: #f6a019; padding: 15px; text-transform: uppercase;">
                Manage Users List
            </a>
 <br>
          <a href="../php/logout.php" style="color: #666; text-decoration: none; font-size: 13px; text-align: center;">Logout from Dashboard</a>
        </div>
    </div>
</section>

<footer style="margin-top: 60px; text-align: center; color: #666; font-size: 12px;">
    <p>&copy; 2026 Jewelry Store | Secure Admin Area</p>
</footer>
</body>
</html>
       