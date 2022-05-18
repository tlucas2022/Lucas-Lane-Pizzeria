<!DOCTYPE html>
<html>

<head>
     <title> Lucas Lane Pizzeria - Home Page </title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
       
     <link href= "css/admin.css" rel="stylesheet"> <!-- reference CSS file for admin pages -->

<style>
       
  h1 {
     font-size: 2.5em;
     font-family: Georgia, Times, serif;
  }

  table tr td {
    font-size: 20px;
    font-weight: bold;
  }

  input[type="submit"], .btn-cancel{
    padding: 2%;
  }

  .tbl-small{
    width:43%;
  }
  
</style>

</head>

<?php include('partials/admin_navbar.php'); ?>
<!-- uses admin navigation bar -->

<div class="main-content">
  <div class="wrapper">
    <h1>Add About Page Content</h1>


    <?php
       if(isset($_SESSION['upload'])) //Check if session is set
       {
          echo $_SESSION['upload']; //Display session message
          unset($_SESSION['upload']); //Remove message
       }
    ?>

    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-small">
        <tr>
          <td>Heading: </td>
          <td>
              <textarea name="heading" cols="30" rows="2" placeholder="Heading"></textarea>
          </td>
        </tr>
        
        <tr>
          <td>About Text: </td>
          <td>
              <textarea name="about" cols="35" rows="6" placeholder="About"></textarea>
          </td>
        </tr>

        <tr>
          <td>Image: </td>
          <td>
             <input type="file" name="image">
          </td>
        </tr>
        
        <tr>
           <td>Image Description: </td>
           <td>
             <textarea name="description" cols="30" rows="3" placeholder="Description"></textarea>
           </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Content" class="btn-primary">
             <a href="Manage_About.php" style="text-decoration: none; color:white;"><button class = "btn-cancel" style="font-size: 19px; padding: 1.7%;">
               Cancel </a>
          </td>
        </tr>

     </table>

    </form>

    <?php
       //CHeck whether the button is clicked or not
       if(isset($_POST['submit']))
       {
          //Get form data           
          $heading = mysqli_real_escape_string($conn, $_POST['heading']);
          $about = mysqli_real_escape_string($conn, $_POST['about']);
          $image = $_FILES['image']['name'];
          $description = mysqli_real_escape_string($conn, $_POST['description']);

          $source_path = $_FILES['image']['tmp_name'];
          $destination_path = "../Images/".$image;

          //Upload image to destination folder            
          $upload = move_uploaded_file($source_path, $destination_path);

          //Insert into database
          $sql = "INSERT INTO ll_about SET
             heading = '$heading',
             about = '$about',
             image = '$image',
             image_desc = '$description'
          ";

          //Execute the Query
          $res = mysqli_query($conn, $sql);

          //Check is query is successful
          if($res == true)
          {
            //Query Successfull
            $_SESSION['add'] = "<div class='success'>Content Added Successfully.</div>";
            header('location:Manage_About.php'); //Redirect to Manage About page             
          }
          else
          {
            //Query Failure
            $_SESSION['add'] = "<div class='error'>Failed to add content.</div>";
            header('location:Manage_About.php'); //Redirect to Manage About page
          }
       }

     ?>


    </div>
</div>
  
<?php include('partials/admin_footer.php'); ?>
<!-- use footer -->
