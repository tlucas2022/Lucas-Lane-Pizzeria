<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  
	<link href="css/admin.css" rel="stylesheet"> <!-- reference CSS file for admin pages -->

	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}

	table tr td {
		font-size: 20px;
		font-weight: bold;
	}

	.error {
		font-size: 24px;
	}
	</style>

<?php include('partials/admin_navbar.php'); ?> <!-- uses admin navigation bar -->
  
	<div class="main-content">
		<div class="wrapper">
			<h1>Add Menu Images</h1>

			<br>

			<?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

			<br><br>

			<form action="" method="POST" enctype="multipart/form-data">

				<table class="tbl-small" style="width:43%">

					<tr>
						<td>Image 1: </td>
						<td>
							<input type="file" name="file[]" id="file" multiple>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Menu Images" class="btn-primary">
							<a href="manage_menuimages.php" style="text-decoration: none; color:white;"><button class="btn-cancel" style="font-size: 19px; padding: 1.7%;">
									Cancel </a>
						</td>
					</tr>

				</table>

			</form>

			<?php    
        if(isset($_POST['submit']))   
        {
          // Count total uploaded files   
          $totalfiles = count($_FILES['file']['name']);

          // Looping over all files         
          for($i=0;$i<$totalfiles;$i++) 
          {                    
            $filename = $_FILES['file']['name'][$i];
                  
            // Upload files and store in database
            if(move_uploaded_file($_FILES["file"]["tmp_name"][$i],"../Images/".$filename))       
            {                           
              // Image insert sql              
              $insert = "INSERT into ll_menu SET image='$filename'              
              ";
              
              if(mysqli_query($conn, $insert))              
              {              
                $_SESSION['upload'] = "<div class='success'>Menu Added Successfully.</div>";                
                header('location:manage_menuimages.php');                
              }  
              else              
              {              
                echo 'Error: '.mysqli_error($conn);              
              }             
            }              
            else            
            {            
              $_SESSION['upload'] = "<div class='error'>Failed to Add Menu.</div>";              
              //header('location:add_menuimages.php'); 
            }
            
          }         
        }
        
      ?>

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
  
