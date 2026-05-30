<?php 
include '../php/check_admin.php'; // حماية الصفحة - الأدمن فقط يدخل
include 'header.php'; 
?>

<br><br>

<section class="min-section" style="justify-self: center;">
    <h2>Add New Product</h2>
    <div class="div" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 10px; border: 1px solid #f6a019;">

    <form action="../php/add_product.php" method="POST" enctype="multipart/form-data">

     <div class="form-row">
            
            <div class="form-group">
        <label for="title">Product Title:</label>
        <input type="text" id="title" name="title" required>

</div>
</div>

         <div class="form-row">
            
            <div class="form-group">
 
        <label for="category">Category:</label>
        <select id="category" name="category" required 
                style="width: 100%; padding: 10px; background: #1a1a1a; color: #fff; border: 1px solid #f6a019; border-radius: 4px; cursor: pointer;">
            <option value="" disabled selected>Select a category</option>
            <option value="Watches">Watches</option>
            <option value="Rings">Rings</option>
            <option value="Necklaces">Necklaces</option>
            <option value="Bracelets">Bracelets</option>
            <option value="Earrings">Earrings</option>
        </select>
    
        </div>
</div>
     <div class="form-row">
            
            <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        </div>
</div>
     <div class="form-row">
            
            <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        </div>
</div>
     <div class="form-row">
            
            <div class="form-group">
        <label for="image1">Upload Image 1:</label>
        <input type="file" id="image1" name="img1" accept="image/*" required>

        </div>
</div>
     <div class="form-row">
            
            <div class="form-group">
        <label for="image2">Upload Image 2:</label>
        <input type="file" id="image2" name="img2" accept="image/*" required>

        </div>
</div>
     <div class="form-row">
            
            <div class="form-group">
        <label for="image3">Upload Image 3:</label>
        <input type="file" id="image3" name="img3" accept="image/*" required>

        </div>
</div>
    
        <br><br>

        <?php 
        if(isset($_SESSION['error'])){
            echo '<div id="error">';
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            echo '</div>';
        }  
        ?>

        <br>

        <input type="submit" name="submit" value="Add Product" class="btn">
<div style="text-align: center; margin-top: 15px;">
                <a href="products.php" style="color: #f6a019; text-decoration: none; font-size: 13px;">← Back to Products List</a>
            </div>
        <br><br>
    </form>
</div>
</section>

</div>

<br><br>


</body>
</html>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const price = document.getElementById('price').value;
    const description = document.getElementById('description').value.trim();
    const category = document.getElementById('category').value;
    
    let errorMessage = "";

    if (title.length < 3) {
        errorMessage += "Title must be at least 3 characters.\n";
    }
    if (price <= 0) {
        errorMessage += "Price must be a positive number.\n";
    }
    if (description.length < 10) {
        errorMessage += "Description is too short.\n";
    }
    if (category === "") {
        errorMessage += "Please select a category.\n";
    }

    if (errorMessage !== "") {
        alert(errorMessage);
        e.preventDefault(); // منع إرسال الفورم
    }
});
</script>