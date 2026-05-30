<?php include 'header.php';?>

<section class="section" style="text-align: center;">
    <h1 class="section-title"> Order List</h1> 
    
   



    <div class="products">
        <div class="container">
            <?php
            $quntity=0;
            $total=0;
            $sql = "SELECT * FROM ordersItem 
            INNER JOIN products ON products.id=ordersItem.product_id 
            INNER JOIN orders ON orders.id=ordersItem.order_id
            WHERE orders.user_id=$userId;";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $quntity=mysqli_num_rows($result);
                ?>
                <!-- بداية جدول ملخص الطلب المؤكد -->
                <table style="width: 100%; border-collapse: collapse; margin-top: 20px; color: white; background: rgba(255,255,255,0.02); border: 1px solid rgba(246, 160, 25, 0.2);">
                    <thead>
                        <tr style="border-bottom: 2px solid #f6a019; text-align: left; background: rgba(246, 160, 25, 0.05);">
                            <th style="padding: 15px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Product</th>
                            <th style="padding: 15px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Description</th>
                            <th style="padding: 15px; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 1px;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while($row = mysqli_fetch_array($result)) { 
                        $total += $row["price"]; ?>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: 0.3s;">
                            <td style="padding: 15px; display: flex; align-items: center; gap: 20px;">
                                <img src="../img/<?php echo $row["img1"]?>" alt="product image" style="width: 70px; height: 70px; object-fit: cover; border: 1px solid rgba(246, 160, 25, 0.5);">
                                <span style="font-weight: 500;"><?php echo $row["title"]?></span>
                            </td>
                            <td style="padding: 15px; font-size: 0.9rem; color: #bbb; max-width: 300px;">
                                <?php echo $row["description"]?>
                            </td>
                            <td style="padding: 15px; font-weight: bold; color: #f6a019;">
                                <?php echo $row["price"]?> SAR
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <!-- تذييل الجدول لعرض الإجمالي -->
                    <tfoot>
                        <tr style="background: rgba(246, 160, 25, 0.1);">
                            <td colspan="2" style="padding: 15px; text-align: right; font-weight: bold; text-transform: uppercase;">Total Amount:</td>
                            <td style="padding: 15px; font-weight: bold; color: #f6a019; font-size: 1.1rem; border-left: 1px solid rgba(246, 160, 25, 0.2);">
                                <?php echo $total ?> SAR
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <!-- نهاية الجدول -->

            <?php
            } else {
                echo "<p style='color: white; padding: 20px; text-align: center;'>0 results</p>";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</section>
</body>
</html>