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


	img {
		width: 90px;
	}
	</style>

	<?php include("partials/admin_navbar.php"); ?> <!-- uses admin navigation bar -->
  
	<br>
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage About Page</h1>

			<br /><br />
			<?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {              
              echo $_SESSION['delete'];          
              unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {                
              echo $_SESSION['update'];           
              unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

        ?>
      
			<br>

			<!-- Button to Add Content -->
			<a href="add_about.php" class="btn-primary">Add Page Content</a>

			<br><br><br>

			<table class="tbl-full">
				<tr>
					<th>ID</th>
					<th>Heading</th>
					<th>About Text</th>
					<th>Image</th>
					<th>Image Desc</th>
					<th>Actions</th>
				</tr>

				<?php
                      
        //Query to Get all page content from Database       
        $sql = "SELECT * FROM ll_about";

        
        //Execute Query       
        $res = mysqli_query($conn, $sql);
        
        //Count Rows
        $count = mysqli_num_rows($res);

        //Create Serial Number Variable and assign value as 1  
        $num=1;
        
        //Check whether we have data in database or not        
        if($count>0)     
        { 
          //get the data and display 
          while($row=mysqli_fetch_assoc($res))
          {
            $id = $row['id'];            
            $heading = $row['heading'];            
            $about_text = $row['about'];            
            $image = $row['image'];            
            $image_desc = $row['image_desc'];            
        ?>
				
        <tr>				
          <td><?php echo $num++; ?>. </td>					
          <td width="10%"><?php echo $heading; ?></td>					
          <td width="35%"><?php echo $about_text; ?></td>
					<td width="10%"><?php echo "<img src='../Images/".$row['image']."' >";?></td>
					<td width="12%"><?php echo $image_desc; ?></td>
					
          <td>					
            <a href="update_about.php?id=<?php echo $id; ?>" class="btn-secondary" style="padding:2%">Update Content</a>						
            <br>
						
            <pre></pre>
						
            <a href="delete_about.php?id=<?php echo $id; ?>" class="btn-danger" style:"padding:2%">Delete Content</a>					
          </td>
				
        </tr>
				
        <?php     
          }       
        }
        else
        {
          echo "<tr> <td colspan='6' class='error'> Content not Added Yet. </td> </tr>"; 
        }
        
        ?>
			
      </table>
		
    </div>
  </div>
	
  <br><br>

	<?php include('partials/admin_footer.php'); ?><!-- use footer -->
  
