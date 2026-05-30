<?php include 'header.php';?>


  
<br>
<br>




  
  
<section class="section min-section">
   <h1 class="section-title">Login</h1> 
  
        <div class="div" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 10px; border: 1px solid #f6a019;">
   <form action="../php/login.php" method="POST" id="loginForm">


     <div class="form-row">
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
 </div>
                 <div class="form-row">

            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
        </div>




<?php 

if(isset($_SESSION['error'])){
    echo '<div id="error">';
    echo $_SESSION['error'];
    unset($_SESSION['error']);
    echo '</div>';
}  ?>


<br>
      <input type="submit" name="submit"  value="Login" class="form-button">

         <br>
        <br>

 <div class="row " >
 <a  class="form-link" href="Regisetr.php">
  Dont Have an account ? Regisetr</a>

        </div>
    </form>
</div>
  </section>
  
</div>
<br>
  <br>
 
</body>
</html>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    // استخدام trim() لإزالة أي مسافات زائدة قبل أو بعد الإيميل
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    
    // التعبير النمطي (Regex) للتحقق من صحة هيكلة البريد الإلكتروني
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    let errorMessage = "";

    // 1. الفحص الخاص بالبريد الإلكتروني
    if (!email) {
        errorMessage += "Email is required.\n";
    } else if (!emailPattern.test(email)) {
        errorMessage += "Please enter a valid email address (e.g., name@example.com).\n";
    }

    // 2. الفحص الخاص بكلمة المرور
    if (password.length < 4) {
        errorMessage += "Password must be at least 4 characters.\n";
    }

    // 3. إذا وجد أي خطأ، امنع الإرسال واعرض التنبيه
    if (errorMessage !== "") {
        alert(errorMessage);
        e.preventDefault(); 
    }
});
</script>