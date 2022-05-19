<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/admin.css" rel="stylesheet"> <!-- reference CSS file for admin pages -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- import font awesome icons -->

  
	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}
	</style>

	<?php include('partials/admin_navbar.php'); ?> <!-- use admin navigation bar -->
  
	<br>
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Food Items</h1>

			<br /><br />
			<?php

                   if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                ?>

			<br><br>
      
      <!-- Button to Add Item -->      
			<a href="add_items.php" class="btn-primary">Add Food</a>

			<br /><br /><br />


			<table class="tbl-full">
				<tr>
					<th>ID</th>
					<th>Food</th>
					<th>Description</th>
					<th>Size</th>
					<th>Price</th>
					<th>Active?</th>
					<th>Actions</th>
				</tr>

				<?php
          //Query to get food items
          $sql = "SELECT * FROM ll_food";

          //Execute query
          $res = mysqli_query($conn, $sql);

          //Count Rows
          $count = mysqli_num_rows($res);

          //Create Serial Number Variable and set value to 1
          $num=1;

          if($count>0)        
          {
            //Get the foods from Database 
            while($row=mysqli_fetch_assoc($res))
            {          
              //get the values from individual columns and display
              $id = $row['id'];
              $food = $row['product_name'];
              $description = $row['product_desc'];
              $size = $row['product_size'];
              $price = $row['product_price'];
              $active = $row['active'];
        ?>

				<tr>
					<td><?php echo $num++; ?>. </td>
					<td width="20%"><?php echo $food; ?></td>
					<td width="24%"><?php echo $description; ?></td>
					<td><?php echo $size; ?></td>
					<td>$<?php echo $price; ?></td>
					<td width="8%"><?php echo $active; ?></td>
					<td>
						<a href="update_item.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
						<a href="delete_item.php?id=<?php echo $id; ?>" class="btn-danger">Delete Food</a>
					</td>
				</tr>

				<?php                          
            }            
          }             
          else              
          {              
            //Food not Added in Database                           
            echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";                        
          }                
        ?>


			</table>

			<br><br><br><br>

			<a href="Manage_OLO.php" class="btn-back">&laquo; Back </a>  <!-- Back button -->

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
  
