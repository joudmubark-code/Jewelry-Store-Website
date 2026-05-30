<?php
    require '../database/connection.php';


if (isset($_POST['submit']))
{


  $product_id = $_POST['product_id'];
  
      
      
       
          $sql = "INSERT INTO cart (user_id, product_id)
          VALUES ('$user_id', '$product_id')";
          if (mysqli_query($conn, $sql)) 
          {
          
            
            header("Location:../html/cart.php");

          } 
          else 
          {
            echo "Error: " . $sql . "" . mysqli_error($conn);
          }

       
   
      mysqli_close($conn);

     

       
  }
      

?>

