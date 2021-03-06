<!DOCTYPE html>
<html>
    
<head>
    <title> Menu Gallery </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
         
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> <!-- import font awesome icons -->
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet"> <!-- importing google fonts to use Oleo Script font -->
    
    <link href= "css/navbar.css" rel="stylesheet"> <!-- import CSS file for navigation bar -->

<style>
  
body {
  background-image: url('Images/background2.jpg');
}

h1 {
  font-size: 3.9em;
  font-family: 'Oleo Script', cursive;
}

.h4{
  font-size: 2.25em;
  font-family: 'Oleo Script', cursive;
}

h4{
  font-size: 2.75em;
  font-family: 'Oleo Script', cursive;
}

.gallery a{
  font-size: 40px;
  color:#bd5700;
  font-family: 'Oleo Script', cursive;
}

/* The grid: Four equal columns that floats next to each other */
.column {
  float: left;
  width: 18%;
  padding: 10px;
}

/* Style the images inside the grid */
.column img {
  opacity: 0.8;
  cursor: pointer;
}

.column img:hover {
  opacity: 1;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.row {
--bs-gutter-x:0;
justify-content: center;
}

/* The expanding image container */
.container {
  position: relative;
  display: none;
}

/* Expanding image text */
#imgtext {
  position: absolute;
  left: 45px;
  color: white;
  font-size: 30px;
  background-color: black;
}

/* Closable button inside the expanded image */
.closebtn {
  position: absolute;
  right: 2.5em;
  height: 100%;
  color: white;
  font-size: 55px;
  cursor: pointer;
}

 @media screen and (max-width: 1250px) and (min-width: 730px) {
  .closebtn {
    right: 1.5em;
 }
}

 @media screen and (max-width: 650px){
.closebtn {
    right: -0.15em;
    color: black;
    font-size: 40px;
 }
}

@media screen and (max-width: 562px) {
 #imgtext {
  position: static;
  font-size: 25px;
 }
}

</style>

</head>

<body>

   <?php include("partial/topnav.php"); ?>

    <div class="container-fluid p-5 bg-danger text-white text-center">
      <h1>Menu Gallery</h1><p></p>
    </div>

    <?php include("partial/navbar.php"); ?>
  
    <div style="text-align:center">
       <h3>Click on the Images Below:</h3><br>
    </div>

    <div class="row">
      <?php
        //Query to get all menu item photos
        $sql = "SELECT product_name, photo FROM ll_food WHERE photo!=''";

        //Execute
        $res = mysqli_query($conn, $sql);

        //Count Rows 
        $count = mysqli_num_rows($res);

        if($count>0)
        {
          //If there are results, retrieve them 
          while($row=mysqli_fetch_assoc($res))
          {
            //get the values from individual columns
            $names = $row['product_name'];
            $images = $row['photo'];
      ?>

      <div class="column">
         <img <?php echo "src='Images/".$images."'";?> alt="<?php echo $names;?>" style="width:90%; height:65%; border-radius: 10%;" onclick="myFunction(this);">
      </div>

      <?php
        }
      }

      else
      {}
      ?>

  </div>

  <div class="container" style="margin:auto; width:50%">
    <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
      <img id="expandedImg" style="width:70%; display:block; margin-left:auto; margin-right:auto">
        <div id="imgtext"></div>
  </div>

  <?php include('partial/user_footer.php'); ?>

 <script>
   
  function myFunction(imgs) {
    var expandImg = document.getElementById("expandedImg");
    var imgText = document.getElementById("imgtext");
    expandImg.src = imgs.src;
    imgText.innerHTML = imgs.alt;
    expandImg.parentElement.style.display = "block";
  }
   
</script>
 
</body>

</html>
