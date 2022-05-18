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
      <link href= "css/tracker.css" rel="stylesheet"> <!-- import CSS file for order tracker -->


<style>
    body {
        background-image: url('Images/background2.jpg');
        /* plain background on all pages */
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

    form {
    width: 90%;
    border-radius: 4px;
    background-color: #d5d5d5;
    padding: 20px;
    margin: 10% auto;
    margin-top: 40px;
    }


@media only screen and (max-width: 600px) {
  form {
  width: 85%;
  }

 input[type=submit] {
    width: 100%;
  }

  input, textarea {
    margin-bottom: 25px;
    width: -webkit-fill-available;
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

  input[type=submit] {
    margin-left: 5px;
  }

  input, textarea {
    margin-bottom: 25px;
  }
</style>

</head>
  
<body>

    <?php include("partial/topnav.php"); ?> <!-- uses top navigation bar -->

      <div class="container-fluid p-5 bg-danger text-white text-center">
          <h class = "h1">Lucas Lane Pizzeria</h><p></p>
          <h class = "h4">New York City's Finest Pizza!</h>
      </div>

     <?php include("partial/navbar.php"); ?> // uses navigation bar 

     <div class="wrapper">
       <?php
         if(isset($_SESSION['track']))
         {
             echo $_SESSION['track'];
             unset($_SESSION['track']);
         }
       ?>

       <!-- Tracker Form -->
       <form action="" method="POST" class="text">
           <h2 class="text-center" style="margin-bottom:27px">Find My Order</h2>

           Order Date: &nbsp;
           <input type="date" id="order_date" name="date"><br>

           Name: &nbsp;
           <input type="text" name="name" placeholder="Enter Name On Order"><br>

           Email Address: &nbsp;
           <input type="email" id="email" name="email" placeholder="Enter Email On Order"><br>

           <input type="submit" name="submit" value="Track" class="btn-login">

       </form>

       <?php

          //If form is submitted
          if(isset($_POST['submit']))
          {
            //1. Get Order details
            $date = $_POST['date'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            //2. Query to find with matching information
            $sql = "SELECT o.id, o.type, o.status, c.cust_name FROM ll_orders o, ll_customer c WHERE o.cust_id = c.cust_id AND o.order_date ='$date' AND c.cust_name = '$name' AND c.cust_email = '$email' ";

            //3. Execute
            $res = mysqli_query($conn, $sql);

            //4. Count rows
            $count = mysqli_num_rows($res);

            //If there are any results, retrieve values
            if($count>0)
            {
              $row = mysqli_fetch_assoc($res);

              $id = $row['id'];
              $type = $row['type'];
              $status = $row['status'];
       ?>

      <!-- Order Tracker -->
       <div class="container padding-bottom-3x mb-1">
         <div class="card mb-3">

           <!-- Display order type and number -->
           <div class="p-3 text-center text-white bg-dark rounded-top"><span class="text-uppercase">(<?php echo $type?>) Order # -
              </span><span class="text-uppercase">00<?php echo $id?></span>
           </div>

           <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
             <div class="w-100 text-center py-1 px-2"><span class="text-large">Current Status: </span>
                 <span class="text-larger"><?php echo $status?></span> <!-- Display order status -->
             </div>
           </div><br>

           <div class="card-body">
             <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">

                <?php include("tracker.php"); ?> <!-- Link to order tracker -->

             </div><br>

             <div class="link">
                <a href="orderinfo.php?id=<?php echo $id;?>" target="_blank" rel="noopener noreferrer" class="btn btn-info float-center">
                  View Order Info</a> <!-- Link to order information -->
             </div>
           </div>
         </div>
       </div>

     <?php
           }    
           else
           {
              $_SESSION['track'] = "<div class='error text-center text-danger'>No Order Found!</div>";
              //Redirect to Order Tracker page
              header('location:order_tracker.php');
           }
       }

    ?>
    <br><br><pre></pre>

  </div>

  <?php include('partial/user_footer.php'); ?> <!-- Use footer -->
  
</body>

</html>
