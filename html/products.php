<?php include 'header.php';?>




  
<section class="section">
   <h1 class="section-title">Collection</h1> 
  
   <div class=" center-div" >
<div class="products-container">
<?php

 
if (isset($_GET['category'])) {
    $category = mysqli_real_escape_string($conn, $_GET['category']);
    
    // 2. استعلام يجلب المنتجات التابعة لهذه الفئة فقط
    $sql = "SELECT * FROM products WHERE category = '$category' ORDER BY id DESC";
} else {
    // 3. إذا لم يوجد فئة في الرابط، يجلب كل المنتجات
    $sql = "SELECT * FROM products ORDER BY id DESC";
}
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_array($result)) { ?>
   


    <div class="product-card">
        <img src="../img/<?php echo $row["img1"]?>" alt="Product 1" class="product-bg">
        <div class="product-overlay">
            <div class="text-content">
                <h3><?php echo $row["title"]?></h3>
                <p><?php echo $row["description"]?></p>
                <a  href="product.php?id=<?php echo $row['id'] ?>" class="btn-discover">Discover</a>
            </div>
        </div>
    </div>
    

  

   <?php
}
} else {
echo "0 results";
}
?>
</div>
</div>
  </section>
  
 
</body>
</html>