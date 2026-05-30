<?php include '../database/connection.php';?>



<!DOCTYPE html>
<html>
<head>
  <title>Brilliant Store</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <!-- <script src="script.js"></script> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<nav >

<div class="navbar">
    <div class="nav-left">
        <!-- <button class="menu-toggle" id="mobile-menu">
            <span></span>
            <span></span>
        </button> -->
        <div class="nav-icons pc-only">
            <!-- <a href="#"><i class="search-icon">🔍</i></a> -->
               <?php if (!isset($_SESSION['userId'])){ ?>
                   <a href="login.php" class="nav-link">Login</a>

        <?php } ?>
        </div>
    </div>

    <div class="nav-logo">
        <img src="../img/logo.webp" style="
    height: 100px;" alt="Cartier"> </div>

    <div class="nav-right">
        <div class="nav-icons pc-only">
           
         <?php  if (isset($_SESSION['userId'])){?>
            <a href="cart.php"><i class="nav-icons fa-solid fa-bag-shopping"></i></a>
                 <a href="orders.php"><i class="nav-icons fa-solid fa-box"></i></a>

            <a href="account.php"><i class="nav-icons fa-regular fa-user"></i></a>


            <a href="../php/logout.php" title="Logout">
    <i class="nav-icons fa-solid fa-right-from-bracket"></i>
</a>

<?php } ?>
        

            <!-- <a href="#"><i class="fa-regular fa-user"></i></a> -->
            <!-- <a href="#"><i class="fa-regular fa-heart"></i></a> -->
        </div>
    </div>
</div>





<div class="sub-nav pc-only">
    <a href="products.php?category=ring">Ring</a>
    <a href="products.php?category=bracelet">Bracelet</a>
    <a href="products.php?category=earrings">Earrings</a>
    <a href="products.php?category=watch">Watch</a>

</div>
</nav>

