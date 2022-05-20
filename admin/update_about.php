<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/admin.css" rel="stylesheet"> <!-- import CSS file for admin pages -->

	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}

	img {
		width: 200px;
		height: 150px;
	}

	table tr td {
		font-size: 20px;
		font-weight: bold;
	}

	input[type="submit"],
	.btn-cancel {
		padding: 2%;
	}

	.tbl-small {
		width: 43%;
	}
	</style>

<?php include('partials/admin_navbar.php'); ?> <!-- use navigation bar -->
  
	<div class="main-content">
		<div class="wrapper">
			<h1>Update About Page Content</h1>

			<br><br>


			<?php               
        //Get id 
        $id = $_GET['id'];
      
        //Query to get data
        $sql = "SELECT * FROM ll_about WHERE id=$id";
      
        //Execute the Query
        $res = mysqli_query($conn, $sql);
      
          if($res==true)               
          {                    
            //Count Rows           
            $count = mysqli_num_rows($res);
            
            if($count==1)            
            {            
              //Get all the data              
              $row = mysqli_fetch_assoc($res);
              
              $heading = $row['heading'];              
              $about = $row['about'];              
              $current_image = $row['image'];              
              $image_desc = $row['image_desc'];              
            }            
            else            
            {            
              //redirect to manage about with session message              
              $_SESSION['no-content-found'] = "<div class='error'>Content not Found.</div>";              
              header('location:Manage_About.php');              
            }           
          }        
      ?>
			
       <!-- Update Form with existing values -->
      <form action="" method="POST" enctype="multipart/form-data">

				<table class="tbl-small">

					<tr>
						<td>Heading: </td>
						<td>
							<textarea name="heading" cols="30" rows="2"><?php echo $heading; ?></textarea>
						</td>
					</tr>

					<td>About Text: </td>
					<td>
						<textarea name="about" cols="35" rows="6"><?php echo $about; ?></textarea>
					</td>
					</tr>

					<tr>
						<td>Current Image: </td>
						<td>
							<?php echo "<img src='../Images/".$row['image']."' >";?>
						</td>
					</tr>

					<tr>
						<td>Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>

					<td>Image Description: </td>
					<td>
						<textarea name="description" cols="30" rows="3"><?php echo $image_desc; ?></textarea>
					</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

							<input type="submit" name="submit" value="Update Content" class="btn-update">
							<input type="submit" name="cancel" value="Cancel" class="btn-cancel">
						</td>

				</table>

			</form>


			<?php
 
        //Cancel button is clicked 
        if(isset($_POST['cancel']))            
        {        
          header('Location: Manage_About.php');          
          die('');          
        }

        if(isset($_POST['submit']))
        {
          //Get all values from form         
          $id = $_POST['id'];          
          $heading = mysqli_real_escape_string($conn, $_POST['heading']);          
          $about = mysqli_real_escape_string($conn, $_POST['about']);          
          $current_image = $_POST['current_image'];          
          $image_desc = mysqli_real_escape_string($conn, $_POST['description']);
          
          if(isset($_FILES['image']['name']))          
          {          
            $filename = $_FILES['image']['name'];
            
            // If image is not blank           
            if($filename != "")              
            {            
              $source_path = $_FILES['image']['tmp_name'];              
              $destination_path = "../Images/".$filename;              
              
              //Insert Into Database              
              $upload = move_uploaded_file($source_path, $destination_path);              
              
              if($upload==false)              
              {              
                //Fail message                
                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                
                //Redirect to Manage About Page                
                header('location:Manage_About.php');
                
                //Stop the Process 
                die();                
              }
              
              // If current image is not blank, remove from folder              
              if($current_image!="")              
              {                
                $remove_path = "../Images/".$current_image;               
                
                $remove = unlink($remove_path);                
                     
                //If failed to remove then display message and stop the processs                
                if($remove==false)                
                {                
                  //Failed to remove image                  
                  $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                  
                  // Redirect to Manage About                 
                  header('location:Manage_About.php');
                  
                  die();  //Stop the Process                  
                }                
              }              
            }            
            else            
            {  
              // No image change             
              $filename = $current_image;              
            }            
          }          
          else          
          {          
            $filename = $current_image;            
          }
          
          // Update the Database          
          $sql2 = "UPDATE ll_about SET          
          heading = '$heading',          
          about = '$about',          
          image = '$filename',          
          image_desc = '$image_desc'          
          WHERE id=$id          
          ";      
          
          //Execute Query          
          $res2 = mysqli_query($conn, $sql2);          
          
          //Redirect to Manage About with Message                   
          if($res==true)          
          {         
            //Content Updated            
            $_SESSION['update'] = "<div class='success'>Content Updated Successfully.</div>";            
            header('location:Manage_About.php');            
          }          
          else          
          {          
            //failed to update content            
            $_SESSION['update'] = "<div class='error'>Content Not Updated.</div>";          
          }        
        }

        
  ?>

	
  </div>	
  </div>

	
<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
