<!DOCTYPE html>
<html>

<head>
    <title>Order Tracker</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet"> <!-- importing google fonts to use Oleo Script font -->

    <link href= "css/navbar.css" rel="stylesheet"> <!-- import CSS file for navigation bar -->
    <link href= "css/tracker.css" rel="stylesheet"> <!-- import CSS file for tracker -->

<style>

  body {
     background-image: url('Images/background2.jpg');
 }

 .h1 {
     font-size: 3.7em;
     font-family: 'Oleo Script', cursive;
}

 .h4{
    font-size: 2.25em;
    font-family: 'Oleo Script', cursive;
}

 .link{
    text-align:center;
 }

@media screen and (max-width: 600px){
  input[type=submit] {
     width: 60%;
     margin-top: 24px;
     margin-right: 50px;
  }
}

@media screen and (max-width: 600px){
  input[type=number] {
     width: 50%;
     margin-top: 24px;
   }

.steps .step.completed .step-icon {
    border: solid 1.5px;
    border-color: inherit;
    outline:none;
}

 .btn-info{
   padding:2%;
   font-size:22px;
 }

.text-uppercase{
   font-size:27px;
 }
}

</style>

</head>

<body>

<?php include("partial/topnav.php"); ?> <!-- uses top navigation bar -->

  <div class="container-fluid p-5 bg-danger text-white text-center">
      <h class = "h1">Lucas Lane Pizzeria</h><p></p>
      <h class = "h4">New York City's Finest Pizza!</h>
  </div>

  <?php include("partial/navbar.php"); ?> <!-- uses navigation bar -->

  <div class="wrapper">
  
    <?php
    <!-- Diplay error message if track session is not successful -->
      if(isset($_SESSION['track']))
      {
          echo $_SESSION['track'];
          unset($_SESSION['track']);
      }
    ?>

    <h3 class ="text-center"><a href="Order_Finder.php">CLICK HERE TO RETRIEVE ORDER NUMBER</a></h3>

    <!-- Tracker Form Starts Here -->
    <form action="" method="POST" class="text">

      <h3 class="text-center">Track Your Order</h3>

      Order Number:     &nbsp;
      <input type="number" name="id" placeholder="Order #">

      <input type="submit" name="submit" value="Track" class="btn-login">

    </form>
    <!-- Form Ends Here -->

    <?php

    if(isset($_POST['submit']))
    {
        //1. Get the Order #
        $id = $_POST['id'];

        //2. Query to look for order with id
        $sql = "SELECT * FROM ll_orders WHERE id='$id'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows
        $count = mysqli_num_rows($res);

        if($count==1)
        {
          //Get all the data
          $row = mysqli_fetch_assoc($res);

          $type = $row['type'];
          $status = $row['status'];
    ?>

    <div class="container padding-bottom-3x mb-1">
      <div class="card mb-3">
        <div class="p-3 text-center text-white bg-dark rounded-top"><span class="text-uppercase">(<?php echo $type?>) Order # -
          </span><span class="text-uppercase">00<?php echo $id?></span>
        </div>

        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
           <div class="w-100 text-center py-1 px-2"><span class="text-large">Current Status: </span>
              <span class="text-larger"><?php echo $status?></span>
           </div>
        </div><br>

        <div class="card-body">
          <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">

             <?php include("tracker.php"); ?> <!-- uses tracker -->

          </div><br>

          <div class="link">
            <a href="orderinfo.php?id=<?php echo $id;?>" target="_blank" rel="noopener noreferrer" class="btn btn-info float-center">
             View Order Info</a>
          </div>
        </div>
      </div>
    </div>

    <?php
      }
      else
      {
           $_SESSION['track'] = "<div class='error text-center text-danger'>No Order Found!</div>";
           //REdirect to HOme Page/Dashboard
           header('location:order_tracker.php');
      }
    }

    ?>
   
    <br><br><pre></pre>

  </div>
  
  <?php include('partial/user_footer.php'); ?> <!-- uses footer -->
  
  </body>

  </html>
