<?php include 'header.php';?>


  <?php



$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id=$id ;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_array($result)) { ?>
  
<section class="section">
  
   <div class=" center-div" style="    background-color: #fff;padding: 10px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
        <!-- العمود الأيسر: الصور -->
        <td width="60%" valign="top" style="    text-align: right;">
            <table  border="0" cellpadding="10" cellspacing="0" style="width:70% ;     float: right;">
                <tr>
                    <td colspan="2">
                                  <img src="../img/<?php echo $row["img1"]?>"  width="100%" alt="Main Watch View" style="background-color: #f6f6f6;">
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                                  <img src="../img/<?php echo $row["img2"]?>"  width="100%" alt="Main Watch View" style="background-color: #f6f6f6;">
                    </td>
                    <td width="50%">
                                  <img src="../img/<?php echo $row["img3"]?>"  width="100%" alt="Main Watch View" style="background-color: #f6f6f6;">
                    </td>
                </tr>
            </table>
        </td>

        <!-- العمود الأيمن: تفاصيل المنتج -->
        <td width="40%" valign="top" style="padding: 40px;     text-align: left;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <h1 style="font-size: 24px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px;">
                          <?php echo $row["title"]?></h1>
                        <p style="font-size: 14px; color: #666; line-height: 1.6;">
                          <?php echo $row["description"]?>... 
                            <!-- <a href="#" style="color: #000; font-weight: bold;">Read More</a> -->
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 20px;">
                        <div style="font-size: 12px; text-transform: uppercase; margin-bottom: 10px;">📦 Complimentary Shipping</div>
                        <div style="font-size: 12px; text-transform: uppercase;">🔄 Complimentary Returns and Exchanges</div>
                    </td>
                </tr>
               
                <!-- السعر والزر -->
                <tr>
                    <td style="padding-top: 30px;">
                        <div style="font-size: 20px; font-weight: bold; margin-bottom: 20px;">SAR <?php echo $row["price"]?></div>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="85%">

                                 <?php if (isset($_SESSION['userId']))   { ?>
<form action="../php/cart.php" method="POST">
<input type="" id="product_id" name="product_id" value="<?php echo $row["id"]?>" style="display:none">
<input name="submit" type="submit"  value="Add to Cart " style="width: 100%; background: #111; color: #fff; padding: 15px; border: none; text-transform:
                                       uppercase; cursor: pointer;"> 
</form>
<?php 
 }
        else { ?>
        <a href="login.php" class="button"> login to add to cart</a>
       <?php  }
        ?>
                                  
                                </td>
                                <!-- <td width="15%" align="right">
                                    <button style="width: 45px; height: 45px; background: #fff; border: 1px solid #ccc; cursor: pointer;">♡</button>
                                </td> -->
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- الروابط السفلية -->
                <tr>
                    <td style="padding-top: 40px; font-size: 12px; text-transform: uppercase; color: #333; line-height: 2.5;">
                        📞 Order by Phone 800 891 2020<br>
                        📍 Find in Boutique<br>
                        🎧 Contact an Ambassador<br>
                        📅 Book an Appointment
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
   
    


    

   
      
     
</div>  
     
    
    </section>
   <?php
}
} else {
echo "0 results";
}
mysqli_close($conn);
?>
 

 <footer>
    <img src="../img/logo.webp" style="height: 100px;
    margin-bottom: 20px;">
    <p>&copy; 2025 Brilliant Store. All rights reserved.</p>
  </footer>
</body>
</html>