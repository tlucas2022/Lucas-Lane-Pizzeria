<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/admin.css" rel="stylesheet">  <!-- reference CSS file for admin pages -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <!-- import font awesome icons -->

	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}

	.error {
		font-size: 23px;
	}
	</style>

	<?php include('partials/admin_navbar.php'); ?> <!-- use admin navigation bar -->
	<br>

	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Category</h1>

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
			<br><br>

      <!-- Button to Add Category -->
			<a href="add_category.php" class="btn-primary">Add Category</a>

			<br /><br /><br />

			<table class="tbl-full">
				<tr>
					<th>ID</th>
					<th>Category</th>
					<th>Active?</th>
					<th>Actions</th>
				</tr>

				<?php
                        
        //Query to get all categories from Database        
        $sql = "SELECT * FROM ll_category";
        
        //Execute Query        
        $res = mysqli_query($conn, $sql);
        
        //Count Rows        
        $count = mysqli_num_rows($res);
        
        //Create Serial Number Variable and assign value as 1        
        $num=1;

        if($count>0)        
        {          
          //get the data and display          
          while($row=mysqli_fetch_assoc($res))          
          {          
            $id = $row['id'];            
            $category = $row['category'];            
            $active = $row['active'];                                
        ?>

				<tr>
					<td><?php echo $num++; ?>. </td>
					<td><?php echo $category; ?></td>
					<td><?php echo $active; ?></td>

					<td>
						<a href="update_category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
						<a href="delete_category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>
					</td>
				</tr>

				<?php                    
          }                    
        }                    
        else                 
        {         
          echo "<tr> <td colspan='4' class='error'> Category not Added Yet. </td> </tr>";   
        }      
        
        ?>

			</table>

			<br><br><br><br>

			<a href="Manage_OLO.php" class="btn-back">&laquo; Back </a> <!-- Back button -->

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
  
