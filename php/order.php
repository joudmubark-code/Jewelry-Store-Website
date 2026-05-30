<?php
    require '../database/connection.php';


if (isset($_POST['submit']))
{

 

  $total = $_POST['total'];
  $quntity = $_POST['quntity'];
  $last_id=0;


$sqlInsertOrder = "INSERT INTO orders (user_id ,total)
          VALUES ('$user_id', '$total')";
          if (mysqli_query($conn, $sqlInsertOrder)) 
          {
            $last_id = $conn->insert_id;
          }
          else 
          {
            echo "Error: " . $sqlInsertOrder . "" . mysqli_error($conn);
          }



          $sql = "SELECT * FROM cart INNER JOIN users ON users.id=cart.user_id 
          INNER JOIN products ON products.id=cart.product_id WHERE cart.user_id=$userId;";
          $result = mysqli_query($conn, $sql);
          
          if (mysqli_num_rows($result) > 0) 
          {
          // output data of each row
                $quntity=mysqli_num_rows($result);
                $total=0;
                while($row = mysqli_fetch_array($result)) 
                { 
                  $product_id= $row["product_id"];

                      $sqlInsertOrderItem = "INSERT INTO ordersItem (order_id, product_id)
                      VALUES ('$last_id', '$product_id')";
                      if (mysqli_query($conn, $sqlInsertOrderItem)) 
                      {
                           // if insert to orderitem tabel , then delet from cart tabel
                           $sql = "DELETE FROM cart WHERE product_id=$product_id AND user_id=$userId";

                           if ($conn->query($sql) === TRUE) {
                            // echo "Record deleted successfully";
                           } else {
                             echo "Error deleting record: " . $conn->error;
                           }
                      }  
                      else 
                      {
                        echo "Error: " . $sqlInsertOrderItem . "" . mysqli_error($conn);
                      }
                }
                // if finsh insetin to orderitem then go to order cart
                header("Location:../html/confirm.php");
          }


   
      mysqli_close($conn);

     

       
  }
      

?>

