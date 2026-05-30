<?php 
include 'header.php';

// جلب بيانات المستخدم الحالية من قاعدة البيانات
$sql = "SELECT * FROM users WHERE id = $userId";
$result = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($result);
?>

<br>
<br>

<section class="section min-section">
   <!-- تغيير العنوان من Login إلى My Account -->
   <h1 class="section-title">My Account</h1> 
  
        <div class="div" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 10px; border: 1px solid #f6a019;">
   <!-- تغيير الأكشن ليكون التعديل مثلاً (update.php) أو تركه للعرض فقط -->
   <form action="../php/update_account.php" method="POST">

     <div class="form-row">
            <div class="form-group">
                <label>Name:</label>
                <!-- إضافة القيمة من قاعدة البيانات باستخدام value -->
                <input type="text" id="name" name="name" value="<?php echo $user_data['name']; ?>" required>
            </div>
     </div>

     <div class="form-row">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
            </div>
     </div>

     <div class="form-row">
            <div class="form-group">
                <label>Password:</label>
                <!-- كلمة المرور نتركها فارغة للأمان أو نعرضها مشفرة -->
                <input type="password" name="password" placeholder="Enter new password to change">
            </div>
     </div>

     <br/>
     
    <?php 
    if(isset($_SESSION['success'])){
        echo '<div id="success" style="color: #f6a019; margin-bottom:10px;">';
        echo $_SESSION['success'];
        unset($_SESSION['success']);
        echo '</div>';
    }
    if(isset($_SESSION['error'])){
        echo '<div id="error" style="color: red; margin-bottom:10px;">';
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        echo '</div>';
    }  ?>

    <br>
    <!-- تغيير نص الزر إلى Save Changes -->
    <input type="submit" name="submit" value="Update Profile" class="form-button">
    
    <br>
    <br>
    <div class="row">
        <!-- تغيير الرابط ليكون تسجيل خروج بما أنه داخل حسابه -->
        <a class="form-link" href="../php/logout.php">
           Logout from this account?
        </a>
    </div>
    </form>
  </div>
</section>

<br>
<br>

</body>
</html>