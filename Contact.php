<DOCTYPE html>
<html>
  
<head>
    <title>Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
 
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet"> <!-- importing google fonts to use Oleo Script font -->
   
     <link href= "css/navbar.css" rel="stylesheet"> <!-- import CSS file for navigation bar -->

 <style>
   body {
    background-image: url('Images/background2.jpg');
  }

 .map-responsive{
    overflow:hidden;
    position:relative;
  }

@media only screen and (max-width: 768px) {
  /* For mobile phones: */
  .map-responsive iframe {
    width: 100%;
  }
}
   
.map-responsive iframe{
  display: block;
  margin-left: auto;
  margin-right: auto;
  }

.p1 {
 font-family: 'Oleo Script', cursive;
  font-size: 35px;
  font-weight: bold;
}

h1 {
  font-size: 3.7em;
  font-family: 'Oleo Script', cursive;
}

h4{
  font-size: 2.2em;
  font-family: 'Oleo Script', cursive;
}

.col-md-3 a {
 font-family: 'Oleo Script', cursive;
}

.wrapper{
    padding: 1%;
    width: 90%;
    margin: 0 auto;
}

@media (max-width: 991px) {
  .column-margin {
    margin: 24px 0;
  }
}
   
</style>
  
</head>

<body>

<?php include("partial/topnav.php"); ?> <!-- uses top navigation bar -->

<div class="container-fluid p-5 bg-danger text-white text-center">
  <h1>Contact Us</h1><p></p>
  <h4>Give Us a Call or Email!!!</h4>
</div>

<?php include("partial/navbar.php"); ?> <!-- uses navigation bar -->

  
 <pre>

 </pre>


<div class="wrapper">
 <div class="row">
  <div class="row text-center">

    <div class="col-md-3 column-margin">
       <i class="fa fa-map-marker" style='font-size:48px;color:red'></i>
       <p></p>

       <?php

        //Query to get all contact page content         
        $sql = "SELECT * FROM ll_contact";
        $res = mysqli_query($conn, $sql); //excute        

        $count = mysqli_num_rows($res);

        // If there are results, retrieve them      
        if($count>0)
        {
           $rows=mysqli_fetch_assoc($res);
           $id = $rows['id'];
           $address = $rows['rest_address'];
           $phone = $rows['phone'];
           $email = $rows['email'];
           $social = $rows['social'];
           $map = $rows['map'];
      ?>

      <p class="p1"><?php echo $address; ?></p>
    </div>

    <div class="col-md-3 column-margin">
      <i class="fa fa-phone" style='font-size:48px;color:red'></i>
      <p></p>
      <a href="tel:<?php echo $phone; ?>" style="font-size:35px;color:black;font-weight:bold;"><?php echo $phone; ?></a>
    </div>

    <div class="col-md-3 column-margin">
      <i class="fa fa-envelope" style='font-size:48px;color:red'></i>
      <p></p> <a href="mailto:<?php echo $email; ?>" style="font-size:35px;color:black;font-weight:bold;"><?php echo $email; ?></a>
    </div>

    <div class="col-md-3 column-margin">
      <i class="fa fa-instagram" style='font-size:48px;color:red'></i>
      <p></p> <a href="<?php echo $social; ?>" target="_blank" rel="noopener noreferrer"
         style="font-size:35px;color:black;font-weight:bold;">Follow us on social media!!</a>
    </div>

  </div>
 </div>

 <br><br><br>

 <!--Google map-->
 <div class="container-fluid">
   <div class="map-responsive">
    <iframe src="<?php echo $map; ?>" width="700" height="389" frameborder="0" style="border: 0" allowfullscreen=""></iframe>

    <?php
     }

     else{}
    ?>

   </div>
 </div>
</div>
</div>

<?php include('partial/user_footer.php'); ?> <!-- use footer -->
  
</body>

</html>
