<?php include 'header.php';?>


  
<br>
<br>

  
<section class="section min-section">
   <h1 class="section-title">Login</h1> 
  
        <div class="div" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 10px; border: 1px solid #f6a019;">
   <form action="../php/regisetr.php" method="POST">

     <div class="form-row">
            
            <div class="form-group">
                <label>Name:</label>
                <input type="name" id="name" name="name" required>
            </div>
 </div>


     <div class="form-row">
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
 </div>
                 <div class="form-row">

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
        </div>

         
       
        <br/>
     
<?php 

if(isset($_SESSION['error'])){
    echo '<div id="error">';
    echo $_SESSION['error'];
    unset($_SESSION['error']);
    echo '</div>';
}  ?>


<br>
      <input type="submit" name="submit" value="Register" class="form-button">
   <br>
        <br>
 <div class="row " >
 <a  class="form-link" href="login.php">
   Have an account ? Login</a>

        </div>
    </form>
  </section>

</div>
<br>
  <br>
  
</body>
</html>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    
    // التعبير النمطي لفحص صحة الإيميل
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    let errorMessage = "";

    if (!email) {
        errorMessage += "Email is required.\n";
    } else if (!emailPattern.test(email)) {
        errorMessage += "Please enter a valid email address (e.g., name@domain.com).\n";
    }

    if (password.length < 4) {
        errorMessage += "Password must be at least 4 characters.\n";
    }

    if (errorMessage !== "") {
        alert(errorMessage);
        e.preventDefault(); // منع الإرسال إذا وجد خطأ
    }
});
</script>
