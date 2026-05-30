<?php 
include '../php/check_admin.php'; // حماية الصفحة - الأدمن فقط يدخل
include 'header.php'; 
?>

<?php
// جلب المنتج المطلوب تعديله
$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
$res = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($res);
?>

<br><br>

<section class="min-section"  style="justify-self: center;">
    <h2>Edit Product</h2>
    <div class="div" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 10px; border: 1px solid #f6a019;">

    <form action="../php/edite_product.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">


     <div class="form-row">
            
            <div class="form-group">
        <label for="title">Product Title:</label>
        <input type="text" id="title" name="title" 
               value="<?php echo $product['title']; ?>" required>

</div>
</div>

    <div class="form-row">
    <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" name="category" required 
                style="width: 100%; padding: 10px; background: #1a1a1a; color: #fff; border: 1px solid #f6a019; border-radius: 4px; cursor: pointer;">
            
            <option value="Watches" <?php if($product['category'] == 'Watches') echo 'selected'; ?>>Watches</option>
            <option value="Rings" <?php if($product['category'] == 'Rings') echo 'selected'; ?>>Rings</option>
            <option value="Necklaces" <?php if($product['category'] == 'Necklaces') echo 'selected'; ?>>Necklaces</option>
            <option value="Bracelets" <?php if($product['category'] == 'Bracelets') echo 'selected'; ?>>Bracelets</option>
            <option value="Earrings" <?php if($product['category'] == 'Earrings') echo 'selected'; ?>>Earrings</option>
            
        </select>
    </div>
</div>


     <div class="form-row">
            
            <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php 
            echo $product['description']; 
        ?></textarea>


</div>
</div>
     <div class="form-row">
            
            <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" 
               value="<?php echo $product['price']; ?>" step="0.01" required>

</div>
</div>
     <div class="form-row">
            
            <div class="form-group">
        <label>Current Image 1:</label>
        <img src="../../img/<?php echo $product['img1']; ?>" 
             width="120" style="margin-bottom:10px;">

        <label for="image1">Upload New Image 1 (optional):</label>
        <input type="file" id="image1" name="img1" accept="image/*">

</div>
</div>
     <div class="form-row">
            
            <div class="form-group">
        <label>Current Image 2:</label>
        <img src="../../img/<?php echo $product['img2']; ?>" 
             width="120" style="margin-bottom:10px;">

        <label for="image2">Upload New Image 2 (optional):</label>
        <input type="file" id="image2" name="img2" accept="image/*">

</div>
</div>
     <div class="form-row">
            
            <div class="form-group">
                 <label>Current Image 3:</label>
        <img src="../../img/<?php echo $product['img3']; ?>" 
             width="120" style="margin-bottom:10px;">

        <label for="image3">Upload New Image 3 (optional):</label>
        <input type="file" id="image3" name="img3" accept="image/*">

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

        <input type="submit" name="submit" value="Update Product" class="btn">
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
    
    let errors = [];

    if (title.length < 3) errors.push("Title is too short.");
    if (price <= 0) errors.push("Price must be greater than 0.");
    if (description.length < 10) errors.push("Description should be more detailed.");

    if (errors.length > 0) {
        alert(errors.join("\n"));
        e.preventDefault();
    }
});
</script>