<!DOCTYPE html>
<html>
  
<head>
    <title>About</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script&display=swap" rel="stylesheet">  <!-- importing google fonts to use Oleo Script font -->
    
    <link href= "css/navbar.css" rel="stylesheet"> <!-- import CSS file for navigation bar -->
    <link href= "css/about.css" rel="stylesheet"> <!-- import CSS file for about page -->

<style>

body {
  font-size: 100%;
  background-image: url('Images/background2.jpg');
}

</style>
  
</head>
  
<body>

  <?php include("partial/topnav.php"); ?> <!-- uses top navigation bar -->

  <div class="container-fluid p-5 bg-danger text-white text-center">
    <h1>About Us</h1><p></p>
    <h4>The Best Italian Food In NYC</h4>
  </div>

  <?php include("partial/navbar.php"); ?> // uses navigation bar

  <pre> //spacing


  </pre>
  
  <div class="container mt-5s">
    <div class="fade-in-text align-items-end">

    <?php
      
      //Query to Get all CAtegories from Database
      $sql = "SELECT * FROM ll_about";

      //Execute Query
      $res = mysqli_query($conn, $sql);

      //Count Rows
      $count = mysqli_num_rows($res);

      //If there are any results, retrieve values
      if($count>0)
      {
         $row=mysqli_fetch_assoc($res);
         $id = $row['id'];
         $heading = $row['heading'];
         $about_text = $row['about'];
         $image = $row['image'];
         $image_desc = $row['image_desc'];
    ?>

        <h2><?php echo $heading; ?></h2>
          <pre></pre>
            <p><?php echo $about_text; ?></p>
           <pre></pre>
    </div>

    <img <?php echo "src='Images/".$row['image']."'";?> class="center" alt="Owner Pic" width="384" height="306">

    <div class="row justify-content-center">
      <div class="col-sm-4 text-center">
        <p></p>
          <h class = "desc"><?php echo $image_desc; ?></h>
      
    <?php
     }
    ?>
    
      </div>
    </div>
  </div>


  <br><br><br><br><br>


  <?php include('partial/user_footer.php'); ?> <!-- use footer -->

</body>

</html>
