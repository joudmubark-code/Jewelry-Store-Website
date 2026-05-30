<?php 
include '../php/check_admin.php'; // حماية الصفحة - الأدمن فقط يدخل
include 'header.php'; 
?>




  

  
<section class="section">
  <div style="
    display: flex;
    place-content: space-between;
">
   <h1 class="section-title">Products List</h1> 
<a href="add_product.php" class="section-title" style="
    BACKGROUND-COLOR: WHITE;
    COLOR: BLACK;
    PADDING: 20px;
    TEXT-DECORATION: NONE;
    BORDER-RADIUS: 10PX;
    align-self: center;
">Add New Product</a>
 <a href="dash.php" class="section-title" style="
        BACKGROUND-COLOR: orange;
        COLOR: BLACK;
        PADDING: 15px 25px;
        TEXT-DECORATION: NONE;
        BORDER-RADIUS: 10PX;
        font-size: 14px;
         align-self: center;
    ">Back to Dashboard</a>

</div>


   <div class="div" >
<div class="products-container">
<?php




$sql = "SELECT * FROM products ORDER BY id  ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_array($result)) { ?>
   


    <div class="product-card">
        <img src="../../img/<?php echo $row["img1"]?>" alt="Product 1" class="product-bg">
        <div class="product-overlay">
            <div class="text-content">
                <h3><?php echo $row["title"]?></h3>
                <p><?php echo $row["description"]?></p>
 <a href="../php/remove_product.php?id=<?php echo $row['id'] ?>" 
   class="btn" 
   onclick="return confirm('Are you sure you want to remove this product?');"
   style="background-color: #ff00008f;
    padding: 10px;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    font-size:10px;
    margin:0px 10px">Remove </a>
 
          <a href="edite_product.php?id=<?php echo $row['id'] ?>" class="btn" style="background-color: #008000a6;
    padding: 10px;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    font-size:10px">Edite </a>     
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

     