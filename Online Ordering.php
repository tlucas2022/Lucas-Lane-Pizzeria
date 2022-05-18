<!DOCTYPE html>
<html>
  
<head>
    <title>Online Ordering</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- import font awesome icons -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet"><!-- importing google fonts to use Oleo Script font -->

    <link href= "css/navbar.css" rel="stylesheet"><!-- import CSS file for navigation bar -->
    <link href= "css/olo.css" rel="stylesheet"><!-- import CSS file for Onlibe Ordering page -->
    <link href= "css/topnav.css" rel="stylesheet"><!-- import CSS file for top navigation bar -->

<style>
  
  body {
    background-image: url('Images/background2.jpg');
    /* plain background on all pages */
  }

  .tracker{
    margin-right:50%;
  }

  .mt-4 {
    position: relative;
    font-size: 18px;
    font-weight:550;
  }

  .content-wrapper-footer {
    width: 1050px;
    margin: 0 auto;
    margin-top: 12px;
    text-align: center;
  }

  footer {
   bottom: 0;
   border-top: 1px solid #EEEEEE;
   padding: 10px 0;
   width: 100%;
   font-weight: bold;
   font-size: 18px;
   color: white;
   background-color: #3D3938;
  }

  @media only screen and (max-width: 600px) {
  /*  For screens with a smaller width than 600px  */
   
   .form-control {
     width: 25%!important;
     text-align: center;
     margin-left: 5px;
   }
  }

</style>

</head>

<body>

 <?php include("partial/topnav.php"); ?>
 <!-- uses top navigation bar -->

 <div class="container-fluid p-5 bg-danger text-white text-center">
   <h class = "h1">Lucas Lane Pizzeria</h><p></p>
   <h class = "h4">New York City's Finest Pizza!</h>
 </div>

 <?php include("partial/navbar.php"); ?>
 <!-- uses navigation bar -->

 <div class="container mt-3">
   <h1>Online Ordering</h1>
     <pre></pre>

   <div id="message"></div> <!-- Diplay message of successful/unsuccessful addition to cart -->

  <?php

   //Query Online Ordering information
   $sql = "SELECT * FROM ll_olo";

      //Execute Query
      $res = mysqli_query($conn, $sql);

      //Count Rows
      $count = mysqli_num_rows($res);

      //If there are any results, retrieve values
      if($count>0)
      {
        while($row=mysqli_fetch_assoc($res))
        {
          $id = $row['id'];
          $text = $row['description'];

  ?>

   <div class="row">
     <div class="col-sm-8">
        <p1>
          <?php echo $text; ?><!-- Display Online Orderimg text -->
        </p1>

  <?php
       }
     }

     else{}
  ?>
       
    </div>
  </div>
      
  <br><br>

  <div class="gallery"><a href="menu_gallery.php">Menu Gallery</a></div> <!-- Link to menu item photo gallery -->

  <br><br>

  <?php

    //Query active categories 
    $sql = "SELECT * FROM ll_category WHERE active='Yes'";

      //Execute Query
      $res = mysqli_query($conn, $sql);

      //Count Rows
      $count = mysqli_num_rows($res);

      //If there are any results, retrieve values
      if($count>0)
      {
        while($row=mysqli_fetch_assoc($res))
        {
          $id = $row['id'];
          $category = $row['category'];
          $active = $row['active'];

 ?>
   
      <h2><?php echo $category; ?></h2> <!-- Display all active catgeories  -->
      
      <br>

 <?php
 
      //Query active food items
      $sql1 = "SELECT * FROM ll_food WHERE active='Yes' AND category_id=$id";

        //Execute Query
        $res1 = mysqli_query($conn, $sql1);

        //Count Rows
        $count1 = mysqli_num_rows($res1);

        //If there are any results, retrieve values
        if($count1>0)
        {
?>
     
   <div class="row">

<?php
     
    while($row=mysqli_fetch_assoc($res1))
    {
       $fid = $row['id'];
       $food = $row['product_name'];
       $description = $row['product_desc'];
       $size = $row['product_size'];
       $price = $row['product_price'];
       $active = $row['active'];
       $qty = $row['product_qty'];
       $code = $row['product_code'];
?>

       <div class="col-sm-4">
         
        <!-- Menu item card -->
        <div class="card">
         <div class="card-body z-depth-2">
           <h3 class="card-title"><?php echo $food; ?></h3> <!-- Display item name -->
             <h5 class="card-text" style="font-size:26px;"><?php if($size!="") { ?> (<?php echo $size; ?>) <?php } ?> $<?php echo $price; ?></h5><!-- Display item size (if applicable) & price -->
               <button type ="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#myModal-<?php echo $fid; ?>"> + </button>
         </div>
        </div>
         
       </div>

       <!-- Menu Item Modal -->
       <div class="modal" id="myModal-<?php echo $fid; ?>">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

           <!-- Modal Header -->
           <form action="" class="form-submit">
              <div class="modal-header">
                <h4 class="modal-title"><?php echo $food; ?></h4> <!-- Display item name -->
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body"><?php if($description!="") {  ?> "<?php echo $description; ?>" <br><br> <?php } ?><!-- Display item description -->
                 
                <div class="container mt-3">
                  &nbsp; QTY:<input type="number" class="form-control pqty" value="<?php echo $qty; ?>" min="1" max="4" required> <!-- Item quantity selector -->
                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" style='font-size: 20px;' data-bs-dismiss="modal">Cancel</button>
                  
                <input type="hidden" class="pid" value="<?= $fid ?>">
                <input type="hidden" class="pname" value="<?= $food ?>">
                <input type="hidden" class="pprice" value="<?= $price ?>">
                <input type="hidden" class="psize" value="<?= $size ?>">
                <input type="hidden" class="pcode" value="<?= $code ?>">
                  
                <button class="btn btn-info addItemBtn" data-bs-dismiss="modal">Add to cart</button>
              </div>
           </form>
          </div>
        </div>
      </div>

<?php
    }
?>

     </div>
     <br><br><br>

<?php
   }
  }
 }
  else{} 
?>

<pre>

</pre>

</div> <!-- Closes div from page setup -->

<pre>

</pre>

<br><br><br><br><br><br>
<?=template_footer()?>

<?php
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT

<div class="mt-4 p-2 bg-dark text-white text-center">
<p></p>
<p style="font-size:19px; font-weight:500;"><p>&copy; $year, All rights reserved, Lucas Lane Enterprises. Developed By - T. Lucas</p>
 </div>

<script src="script.js"></script>
EOT;
}

   session_destroy();
?>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details to the cart
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var psize = $form.find(".psize").val();
      var pcode = $form.find(".pcode").val();

      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          psize: psize,
          pcode: pcode
        },

        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
        }

      });
    });

    // Load total # of items in the cart and display in the top navbar
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
