<?php include 'header.php';?>


<section class="section">
   <h1 class="section-title">Cart List</h1> 
  
 

       
            <?php
            $quntity=0;
            $total=0;
            $sql = "SELECT * FROM cart INNER JOIN users ON users.id=cart.user_id 
            INNER JOIN products ON products.id=cart.product_id WHERE cart.user_id=$userId;";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $quntity=mysqli_num_rows($result);
                ?>
                <!-- بداية الجدول الجديد -->
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px; color: white; background: rgba(0,0,0,0.2);">
                    <thead>
                        <tr style="border-bottom: 2px solid #f6a019; text-align: left;">
                            <th style="padding: 15px;">Product</th>
                            <th style="padding: 15px;">Description</th>
                            <th style="padding: 15px;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($result)) { 
                        $total += $row["price"]; ?>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                            <td style="padding: 15px; display: flex; align-items: center; gap: 15px;">
                                <img src="../img/<?php echo $row["img1"]?>" alt="product image" style="width: 80px; height: 80px; object-fit: cover; border: 1px solid #f6a019;">
                                <span style="font-weight: bold;"><?php echo $row["title"]?></span>
                            </td>
                            <td style="padding: 15px; font-size: 0.9rem; color: #ccc;">
                                <?php echo $row["description"]?>
                            </td>
                            <td style="padding: 15px; font-weight: bold; color: #f6a019;">
                                <?php echo $row["price"]?> SAR
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <!-- نهاية الجدول -->

                <hr>
                <br>
                <br>
                <div style="display:flex; justify-content: space-around; color:#f39e9e">
                    <p class="shoppingcart">Number of Products : <?php echo $quntity ?></p>
                    <p class="shoppingprice">Total Number Price : <?php echo $total ?></p>
                </div>

                <form action="../php/order.php" method="POST" style="    justify-self: center;">
                    <input type="hidden" name="total" id="total" value="<?php echo $total ?>" ><br/>
                    <input type="hidden" name="quntity" id="quntity" value="<?php echo $quntity ?>" ><br/>
                    <input type="submit" name="submit" value="Confirm Order " style="cursor:pointer;" class="form-button">
                </form>

            <?php 
            } else {
                echo "<p style='color:white; padding:20px;'>Cart Empty</p>";
            }
            mysqli_close($conn);
            ?>
      
   
</section>
</body>
</html>