<?php
  require 'config.php'; // uses configuration page to process commands
  
  $user = session_id(); // set session id variable to differentiate carts between users
        
  $grand_total = 0; // set grand total 
  $allItems = ''; 
  $items = [];

  // Query to select all cart items 
  $stmt = $conn->prepare("SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart WHERE user_id = ?");
  $stmt->bind_param('s',$user);
  $stmt->execute(); //Execute
  $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()) {
         $grand_total += $row['total_price'];
         $items[] = $row['ItemQty'];
      }
  
  $allItems = implode(', ', $items);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Checkout</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet"> <!-- importing google fonts to use Oleo Script font -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=PT+Sans" /> <!-- importing google fonts to use PT Sans font -->
  
  <link href= "css/checkout.css" rel="stylesheet"> <!-- import CSS file for checkout page -->

</head>

<style>
  .btn-danger {
     font-size: 30px;
     font-weight: 550;
     padding: 10px;
  }

  .box {
    display: none;
  }

  option {
   font-size: 25px;
  }

  .disabled {
    pointer-events: none;
  }

  @media only screen and (max-width: 600px) {
    .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
      width: 100%;
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
    }

    .p1{
      font-size: 50px;
    }

    .number {
      font-size: 65px;
    }

    .tab {
      width: 100%!important;
      margin-left: 0;
    }

    .panel-dark {
      left: 7%;
      width: 85%;
    }

    .container-print .panel-heading {
      margin-left: 0;
      font-size: 27px;
    }

    .p2 {
      line-height: 1.5;
    }

    .col-sm-12 {
      padding-left: 0!important;
    }

    .body {
      width:90%;
      margin-left: 5%;
    }

    .p5 {
    text-align: center;
    }
  }

  hr {
    width:100%;
  }

  @media only screen and (min-width: 1024px) {
    .fix{
      margin-right: 0;
    }
  }

</style>

<body>

<!-- Top navigation -->
<div class="topnav">

    <!-- Centered link -->
    <div class="topnav-left">
      <a href="index.php">HOME</a>
    </div>

  <!-- Centered link -->
  <div class="topnav-centered">
    <a href="order_tracker.php" class="active">Order Tracker</a>
  </div>

  <!-- Right-aligned links -->
  <div class="topnav-right">
    <a href="cart.php">
    <span id="cart-item" class="position-absolute top-50 start-95 translate-middle badge rounded-pill"></span><i class="fa fa-shopping-cart"></i></span></a>
  </div>

</div>

<br><br><br>

<div class="container" id="order"> //Pickup order
 <div class="container" id="orderD"> // Delivery order
  <div class="container">

    <br><br>

    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4">
        
        <h2 class="text-center text-info p-2">Select Your Order Method:</h2>
        <div class="jumbotron p-4 mb-2">
            <h5 class="lead" style=" font-size: 30px; font-weight:bold;">
              <form action="" method="post">
                <input type="radio" name="Type" class="big" value="Pickup">Pickup
                <input type="radio" name="Type" class="big" value="Delivery">Delivery
              </form>
            </h5>
        </div>
      </div>
    </div>
  </div>

  <br>
   
  <div class="Pickup box">
    <div class="container">
      <h2 class="text-center text-info p-2">Complete your order!</h2>

      <!-- Cart -->
      <div class="row mt-3">
        <div class="col-md-5 order-md-2 mb-4">
          <div class="jumbotron p-3 mb-2">
            <div class="col-25">
              <div class="container1">
                <h4><a href="cart.php">Cart</a>
                  <div class="price" style="color:black; font-size:35px;"><i class="fa fa-shopping-cart"></i></div></h4>
                  <br>

                  <?php
                    //Query to select items from cart                 
                    $stmt = $conn->prepare('SELECT * FROM cart WHERE user_id=?');
                    $stmt->bind_param('s',$user);
                    $stmt->execute(); //Execute
                    $result = $stmt->get_result();
                      while ($row = $result->fetch_assoc()) :
                        $item_total= $row['product_price'] * $row['qty'];
                  ?>

                  <br>
                  
                    <form action="" method="post" id="placeOrder">
                      <input type="hidden" class="Type" value="Pickup">
                      <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                        <p><h6 class="lead" style="font-size:23.5px;">
                     
                        <?php if ($row['product_size'] != "")
                         {
                        ?> 
                       
                        (<?= $row['product_size'] ?>)

                        <?php
                        }
                        else{}
                        ?>

                        <?= $row['product_name'] ?><span class="price">$<?= number_format($item_total,2) ?><span></h6></p>
                        
                        <small class="text-muted">Quantity: <?= $row['qty'] ?></small> <br><br>

                        <?php endwhile; ?>

              </div>
            </div>

           <br><br><br>
           
           <?php
              // Query to select fees             
              $stmt = $conn->prepare('SELECT * FROM fees');
              $stmt->execute(); //Execute
              $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) :
                  $tax= $row['tax_rate'] * $grand_total;
                  $total = $grand_total + $tax;
              ?>
                
              <br><br><br>
                
              <h6 class="lead" style="font-size:25px;"><b>Subtotal: </b><span class="price" style="color:black">$<?= number_format($grand_total,2) ?></span></h6>
              <h6 class="lead" style="font-size:25px;"><b>Tax:</b><span class="price" style="color:black">$<?= number_format($tax,2) ?></span></h6>
          </div>
          
                <?php endwhile; ?>
            
          <br><br>

          <div class="jumbotron p-3 mb-2">
              <h6 class="lead" style="font-size:38px; padding:6.5px;"><b>Total:</b><span class="price" style="color:black">$<?= number_format($total,2) ?></span></h6>
          </div>
      </div>

      <!-- Checkout Form -->
      <div class="col-md-7 order-md-1">
        <div class="jumbotron p-3 mb-2" style="margin-bottom:40px!important">
          <div class="row">
            <div class="col-25">
              <div class="container">

                 <input type="hidden" name="products" value="<?= $allItems; ?>">
                 <input type="hidden" name="total" value="<?= $total; ?>">
                 <br>  <br>
                
                 <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                 </div><br><br>
                  
                 <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" value="capstone@adelphi.edu" required>
                 </div><br><br>
                  
                 <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Enter Phone (No dashes)" value="1800335744" required>
                 </div><br><br><br><br>

                 <h6 class="text-center lead" style="font-size: 25px;">Select Payment Mode</h6><br>
                   <div class="form-group">
                    <select name="pmode" class="form-control">
                      <option value="" selected disabled>-Select Payment Mode-</option>
                      <option value="par" selected >Pay At Restaurant</option>
                      <option value="" disabled>Debit/Credit Card "COMING SOON"</option>
                    </select>
                   </div>
                
                   <br><br><br><br><br>

                   <div class="form-group">
                    <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block <?= ($grand_total >=0.01) ? '' : 'disabled'; ?>">
                   </div>
                
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Break  -->

<div class="Delivery box"> // Delivery order
  <div class="container">
    <h2 class="text-center text-info p-2">Complete your order!</h2>

    <div class="row mt-3">
      <div class="col-md-5 order-md-2 mb-4">
        <div class="jumbotron p-3 mb-2">
          <div class="col-25">
            <div class="container1">
              <h4><a href="cart.php">Cart</a>
              <div class="price" style="color:black; font-size:35px;"><i class="fa fa-shopping-cart"></i></div></h4>

              <br>

              <?php
                // Query to select from cart
                $stmt = $conn->prepare('SELECT * FROM cart WHERE user_id=?');
                $stmt->bind_param('s',$user);
                $stmt->execute(); //Execute
                $result = $stmt->get_result();
                  while ($row = $result->fetch_assoc()) :
                    $item_total= $row['product_price'] * $row['qty'];
              ?>

              <br>
              <form action="" method="post" id="placeDOrder">
                <input type="hidden" class="Type" value="Delivery">
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                  <p><h6 class="lead" style="font-size:23.5px;">
                
                  <?php if ($row['product_size'] != "")
                  {
                  ?> 
                   
                  (<?= $row['product_size'] ?>)

                  <?php
                  }
                  else{}
                  ?>

                  <?= $row['product_name'] ?><span class="price">$<?= number_format($item_total,2) ?><span></h6></p>
                  <small class="text-muted">Quantity: <?= $row['qty'] ?></small> <br><br>

                  <?php endwhile; ?>

            </div>
          </div>

          <br><br><br>
              
          <?php
              // Query to select fees
              $stmt = $conn->prepare('SELECT * FROM fees');
              $stmt->execute();
              $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) :
                  $tax= $row['tax_rate'] * $grand_total;
                  $total = $grand_total + $tax +  $row['delivery'];
              ?>
              
              <br><br><br>
              
              <h6 class="lead" style="font-size:25px;"><b>Subtotal: </b><span class="price" style="color:black">$<?= number_format($grand_total,2) ?></span></h6>
              <h6 class="lead" style="font-size:25px;"><b>Tax:</b><span class="price" style="color:black">$<?= number_format($tax,2) ?></span></h6>
              <h6 class="lead" style="font-size:25px;"><b>Delivery Fee:</b><span class="price" style="color:black">$<?= $row['delivery'] ?></span></h6>

        </div>
        
                <?php endwhile; ?>
            
        <br><br>

        <div class="jumbotron p-3 mb-2">
              <h6 class="lead" style="font-size:38px; padding:6.5px;"><b>Total:</b><span class="price" style="color:black">$<?= number_format($total,2) ?></span></h6>
        </div>
      </div>

      <!-- Checkout Form -->
      <div class="col-md-7 order-md-1">
        <div class="jumbotron p-3 mb-2" style="margin-bottom:40px!important">
          <div class="row">
            <div class="col-25">
              <div class="container">

                  <input type="hidden" name="products1" value="<?= $allItems; ?>">
                  <input type="hidden" name="total1" value="<?= $total; ?>">
                    <br>  <br>
                  
                    <div class="form-group">
                      <input type="text" name="name1" class="form-control" placeholder="Enter Name" required>
                    </div><br><br>
                  
                    <div class="form-group">
                      <input type="email" name="email1" class="form-control" placeholder="Enter E-Mail" required>
                    </div><br><br>
                  
                    <div class="form-group">
                      <input type="tel" name="phone1" class="form-control" placeholder="Enter Phone (No dashes/spaces)" required>
                    </div><br><br>
                  
                    <div class="form-group">
                      <textarea name="address" class="form-control" rows="2" placeholder="Enter Delivery Address Here..."></textarea>
                    </div><br><br><br><br>

                    <h6 class="text-center lead" style="font-size: 25px;">Select Payment Mode</h6><br>
                    
                    <div class="form-group">
                      <select name="pmode1" class="form-control">
                        <option value="" selected disabled>-Select Payment Mode-</option>
                        <option value="cod">Cash On Delivery</option>
                        <option value="" disabled>Debit/Credit Card "COMING SOON"</option>
                      </select>
                    </div>
                  
                    <br><br><br><br><br>

                    <div class="form-group">
                      <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block <?= ($grand_total > 1) ? '' : 'disabled'; ?>">
                    </div>
                
                </form>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://smtpjs.com/v3/smtp.js"></script>



  <script type="text/javascript">
  $(document).ready(function() {

    // Send form data to action page
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

     // Send form data to action page
     $("#placeDOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&place=orderD",
        success: function(response) {
          $("#orderD").html(response);
        }
      });
    });



    // Count number of items in cart and display in top navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });


$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});

</script>
</body>

</html>
