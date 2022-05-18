<!DOCTYPE html>
<html>
  
<head>
  <title>LL Pizza Cart</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"><!-- import bootstrap package -->
  
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' /> <!-- import font awesome icons -->
  
  <link href= "css/cart.css" rel="stylesheet"> <!-- import CSS file for cart page -->

<style>

  .footer{
    position: absolute;
  }

  @media screen and (max-width: 600px){
    
    .content-wrapper {
      width: 90%;
    }

    main .cart table thead td:nth-child(2) {
      display:none;
    }
   
    main .cart table thead td:nth-child(1){
      width: 39%;
    }

    main .cart table tbody td:nth-child(3) {
      display: none;
    }

    main .cart .subtotal{
      text-align:center;
    }

    main .cart table input[type="number"] {
      width: 55px;
      text-align: center;
    }
   
    main .cart .button, main .cart .buttons{
     text-align: center;
     padding-bottom: 50px;
    }
  }

  @media screen and (max-width: 600px){
  
    .badge {
      margin-top: 13.5%!important;
    }
  }
  
</style>

</head>

<body>

  <?php include("partial/cartTop.php"); ?>  //uses top navigation bar for cart page 

  <main>
     <div class="cart content-wrapper">
      <h1>Shopping Cart</h1>
       <div style="display:
                   <?php if (isset($_SESSION['showAlert'])) { 
                      echo $_SESSION['showAlert'];
                    }
                    else {
                      echo 'none';
                    }

                    unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>
                              <?php if (isset($_SESSION['message'])) {
                                echo $_SESSION['message']; //show message
                              }
                              unset($_SESSION['showAlert']); ?>
                            </strong>
      </div>

      <br>

      <div class="buttons">
        <a href="action.php?clear=all" class="btn btn-danger" onclick="return confirm('Are you sure want to clear your cart?');">
          <i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
          <!-- Button to remove all cart items -->
      </div>

      <table>
        <thead>
           <tr>
             <td width="40%">Product</td>
             <td>Price</td>
             <td>&nbsp;&nbsp;&nbsp;QTY</td>
             <td></td>
             <td>Total</td>
           </tr>
        </thead>
        <tbody>
              <?php
                  require 'config.php'; // uses configuration page to process commands

                  $user = session_id(); //set session id variable to differentiate carts for users 
                  $stmt = $conn->prepare('SELECT * FROM cart WHERE user_id = ?'); // Query for specific user cart
                  $stmt->bind_param('s',$user);
                  $stmt->execute(); //Execute
                  $result = $stmt->get_result(); // Retrieve results
                  $grand_total = 0; //set total to 0
                  while ($row = $result->fetch_assoc()):
              ?>
              <tr> //Show cart items 
                 <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                 <td><?= $row['product_size']?> <?= $row['product_name'] ?> </td>
                 <td>$<?= $row['product_price'] ?></td>
                 <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">

                 <td>
                    <input type="number" class="form-control itemQty" min="1" max="4" value="<?= $row['qty'] ?>">
                 </td>

                 <td>
                    <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');">
                    <i class="fas fa-trash-alt" style="font-size: 25px;"></i></a> 
                    <!-- Button to remove individual cart items -->
                   
                 </td>

                 <td>$<?= $row['total_price'] ?></td>
              </tr>
              
              <?php $grand_total += $row['total_price']; ?>
      
              <?php endwhile; ?>
        </tbody>
      </table>

      <div class="subtotal">
         <span class="text">Subtotal:</span>
         <span class="price">$<?= number_format($grand_total, 2); ?></span>
      </div>

      <br><br>

      <div class="button">
        <div class="col-md-12">
           <a href="Online Ordering.php" class="btn btn-success"><i class="fas fa-cart-plus" style="font-size:27px;"></i>&nbsp;&nbsp;Continue Shopping</a>
        </div>
      </div>

      <div class="buttons">
        <div class="col-md-12">
          <a href="checkout.php" class="btn btn-info <?= ($grand_total >= 0.01) ? '' : 'disabled'; ?>">
            <i class="far fa-credit-card" style="font-size:25px;"></i>&nbsp;&nbsp;Checkout</a>
        </div>
      </div>
     </div>
  </main> <!-- End main content -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script> <!-- Import ajax jquery package -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
        }
      });
    });

    // Display number of total # of cart items in the navbar
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
  </script>
  
</body>

</html>
