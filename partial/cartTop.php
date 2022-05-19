<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- import font awesome icons -->
<link href= "css/topnav.css" rel="stylesheet"><!-- import CSS file for top navigation bar -->


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
      <span id="cart-item" class="position-absolute top-50 start-95 translate-middle badge rounded-pill bg-secondary"></span><i class="fa fa-shopping-cart"></i></span></a>
  </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">

 // Load total # of items added in the cart and display in the navbar
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

</script>
