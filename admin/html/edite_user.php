<?php 
include '../php/check_admin.php'; // حماية: للأدمن فقط
include 'header.php'; 

// جلب بيانات المستخدم المطلوب تعديله
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $res = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($res);

    if(!$user) {
        die("User not found.");
    }
} else {
    header("Location: users_list.php");
    exit();
}
?>

<br><br>

<section class="min-section"  style="justify-self: center; width: 100%; max-width: 500px;">
    <h2 class="section-title">Edit User Role</h2>

    <div class="div" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 10px; border: 1px solid #f6a019;">
        <form action="../php/edite_user.php" method="POST">
            
            <!-- إرسال الـ ID بشكل مخفي -->
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

            <div class="form-row">
                <div class="form-group">
                    <label>User Name:</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['name']); ?>" disabled 
                           style="background: #222; color: #888; border: 1px solid #444;">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" value="<?php echo htmlspecialchars($user['email']); ?>" disabled 
                           style="background: #222; color: #888; border: 1px solid #444;">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="role">Select New Role:</label>
                    <select id="role" name="role" required 
                            style="width: 100%; padding: 12px; background: #1a1a1a; color: #fff; border: 1px solid #f6a019; border-radius: 4px;">
                        <option value="user" <?php if($user['role'] == 'user') echo 'selected'; ?>>Standard User</option>
                        <option value="admin" <?php if($user['role'] == 'admin') echo 'selected'; ?>>Administrator</option>
                    </select>
                </div>
            </div>

            <?php 
            if(isset($_SESSION['error'])){
                echo '<div style="color: #ff4d4d; margin-top: 10px; font-size: 13px;">'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }  
            ?>

            <br>
            <input type="submit" name="submit" value="Update Role" class="form-button" style="width: 100%;">
            
            <div style="text-align: center; margin-top: 15px;">
                <a href="users_list.php" style="color: #f6a019; text-decoration: none; font-size: 13px;">← Back to Users List</a>
            </div>
        </form>
    </div>
</section>

</body>
</html>