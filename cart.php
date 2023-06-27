<?php
//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart || RinTech</title>
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet"/>

<style>
  .row{
    width:90%;
    margin-left: auto;
    margin-right: auto;
  }
</style>
  </head>
  <body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="landing.php">
        <img
          src="images/BlueStore.png"
          height="40"
          alt="RinTech"
          loading="lazy"
        />
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="1porto/index.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contacts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="text-reset me-3" href="orders.php">
        <i class="fas fa-shopping-cart"></i>
      </a>
      <!-- Avatar -->
      <div class="dropdown">
        <a
          class="dropdown-toggle d-flex align-items-center hidden-arrow"
          href="#"
          id="navbarDropdownMenuAvatar"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
        <i class="fa fa-user-circle" aria-hidden="true"></i>
        </a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
        <?php

if(isset($_SESSION['username'])){
  echo '<li><a class="dropdown-item" href="account.php">My Account</a></li>';
  echo '<li><a class="dropdown-item" href="logout.php">Log Out</a></li>';
}
else{
  echo '<li><a class="dropdown-item" href="login.php">Log In</a></li>';
}
?>
        </ul>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->


<div class="row" style="margin-top:10px;">
  <div class="col-lg-12">
    <?php
    echo '<div class="table-responsive">';
    echo '<h3>Your Shopping Cart</h3>';
    if (isset($_SESSION['cart'])) {
      $total = 0;
      echo '<table class="table align-middle mb-0 bg-white">';
      echo '<thead class="bg-light">';
      echo '<tr>';
      echo '<th>Name</th>';
      echo '<th>Title</th>';
      echo '<th>Quantity</th>';
      echo '<th>Cost</th>';
      echo '<th>Total</th>';
      echo '<th>Actions</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $result = $mysqli->query("SELECT product_code, product_name, product_desc, qty, price FROM products WHERE id = " . $product_id);

        if ($result) {
          while ($obj = $result->fetch_object()) {
            $cost = $obj->price * $quantity; //work out the line cost
            $total = $total + $cost; //add to the total cost

            echo '<tr>';
            echo '<td>' . $obj->product_code . '</td>';
            echo '<td>' . $obj->product_name . '</td>';
            echo '<td>' . $quantity . '</td>';
            echo '<td>' . $obj->price . '</td>';
            echo '<td>' . $cost . '</td>';
            echo '<td>';
            echo '<a class="btn btn-sm btn-secondary" href="update-cart.php?action=add&id=' . $product_id . '">+</a>&nbsp;';
            echo '<a class="btn btn-sm btn-secondary" href="update-cart.php?action=remove&id=' . $product_id . '">-</a>';
            echo '</td>';
            echo '</tr>';
          }
        }
      }

      echo '<tr>';
      echo '<td colspan="4" align="right">Total</td>';
      echo '<td>' . $total . '</td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td colspan="6" align="right">';
      echo '<a href="update-cart.php?action=empty" class="btn btn-sm btn-danger">Empty Cart</a>&nbsp;';
      echo '<a href="products.php" class="btn btn-sm btn-secondary">Continue Shopping</a>';

      if (isset($_SESSION['username'])) {
        echo '<a href="orders-update.php" class="btn btn-sm btn-primary float-right">COD</a>';
      }

      echo '</td>';
      echo '</tr>';
      echo '</tbody>';
      echo '</table>';
    } else {
      echo "You have no items in your shopping cart.";
    }

    echo '</div>';
    ?>
  </div>
</div>


    <div class="row" style="margin-top:10px;">
      <div class="small-12">




        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;clear:both;">&copy; RinTech. All Rights Reserved.</p>
        </footer>


      </div>
    </div>





    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
