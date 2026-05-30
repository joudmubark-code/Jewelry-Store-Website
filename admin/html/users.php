<?php 
include '../php/check_admin.php'; // حماية الصفحة - الأدمن فقط يدخل
include 'header.php'; 
?>

<section class="section">
  <div style="display: flex; place-content: space-between; align-items: center;">
    <h1 class="section-title">Users List</h1> 
    <a href="dash.php" class="section-title" style="
        BACKGROUND-COLOR: orange;
        COLOR: BLACK;
        PADDING: 15px 25px;
        TEXT-DECORATION: NONE;
        BORDER-RADIUS: 10PX;
        font-size: 14px;
    ">Back to Dashboard</a>
  </div>

  <div class="div">
    <div class="products-container">
    <?php

    $current_logged_in_user = $_SESSION['userId'];
    // جلب المستخدمين من جدول users
    $sql = "SELECT * FROM users ORDER BY id DESC ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) { 
            // تحديد لون عشوائي للخلفية بما أنه لا توجد صورة
            $user_color = ($row['role'] == 'user') ? '#f6a019' : '#333';
        ?>
        
        <div class="product-card" style="width: 300px;"> 
            <!-- عرض بديل للصورة: أيقونة أو أول حرف من الاسم -->
            <div style="
                width: 100%; 
                height: 200px; 
                background: <?php echo $user_color; ?>; 
                display: flex; 
                align-items: center; 
                justify-content: center;
                font-size: 50px;
                color: white;
                font-weight: bold;
                border-bottom: 1px solid #444;
            ">
                <?php echo strtoupper(substr($row['name'], 0, 1)); ?>
            </div>

            <div class="product-overlay">
                <div class="text-content">
                    <h3><?php echo htmlspecialchars($row["name"]); ?></h3>
                    <p>Email: <?php echo htmlspecialchars($row["email"]); ?></p>
                    <p style="color: #f6a019; font-weight: bold;">Role: <?php echo $row["role"]; ?></p>
                    
                    <div style="margin-top: 15px;">
                        <?php if ($row['id'] != $current_logged_in_user){ ?>
                        <!-- زر الحذف مع التأكيد -->
                        <a href="../php/remove_user.php?id=<?php echo $row['id'] ?>" 
                           class="btn" 
                           onclick="return confirm('Are you sure you want to remove this user?');"
                           style="background-color: #ff00008f;
                            padding: 8px 12px;
                            border-radius: 8px;
                            color: white;
                            text-decoration: none;
                            font-size:10px;
                            display: inline-block;">
                            Remove User
                        </a>
                        <?php  } ?>
                        
                        <!-- زر التعديل -->
                        <a href="edite_user.php?id=<?php echo $row['id'] ?>" 
                           class="btn" 
                           style="background-color: #008000a6;
                            padding: 8px 12px;
                            border-radius: 8px;
                            color: white;
                            text-decoration: none;
                            font-size:10px;
                            display: inline-block;
                            margin-left: 5px;">
                            Edit Role
                        </a>     
                    </div>
                </div>
            </div>
        </div>

        <?php
        }
    } else {
        echo "<p style='color: white;'>No users found.</p>";
    }
    ?>
    </div>
  </div>
</section>

</body>
</html>