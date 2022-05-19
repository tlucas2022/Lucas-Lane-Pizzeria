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

	input[type="radio"] {
		transform: scale(1.3);
	}

	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}
	</style>

	<?php include('partials/admin_navbar.php'); ?> <!-- use navigation bar -->

	<div class="main-content">
		<div class="wrapper">
			<h1>Add Food</h1>
			<br>

			<?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

			<form action="" method="POST" enctype="multipart/form-data">

				<table class="tbl-small">
					<tr>
						<td>Name:</td>
						<td><input type="text" name="food" placeholder="Enter Food Name"></td>
					</tr>

					<tr>
						<td>Description: </td>
						<td>
							<textarea name="description" cols="30" rows="4" placeholder="Description of the Food."></textarea>
						</td>
					</tr>

					<tr>
						<td>Size:</td>
						<td><input type="text" name="size" placeholder="Enter Food Size"></td>
					</tr>

					<tr>
						<td>Price: </td>
						<td>
							<input type="number" step="0.01" name="price">
						</td>
					</tr>

					<tr>
						<td>Code:</td>
						<td><input type="text" name="code" placeholder="Enter any codename"></td>
					</tr>

					<tr>
						<td>Category: </td>
						<td>
							<select name="category">

								<?php                    
                  //1. Query to get all active categories from database             
                  $sql = "SELECT * FROM ll_category WHERE active='Yes'";
                                
                  //Executing query
                  $res = mysqli_query($conn, $sql);
                                
                  //Count Rows                   
                  $count = mysqli_num_rows($res);
                                
                  if($count>0)           
                  {                  
                    //We have categories                 
                    while($row=mysqli_fetch_assoc($res))                
                    {                    
                      //get the details of categories 
                      $id = $row['id'];
                      $category = $row['category'];
                ?>
                								
                <option value="<?php echo $id; ?>"><?php echo $category; ?></option>
								
                <?php
                    }
                  }
                else
                {
                  //WE do not have category
                ?>

                <option value="0">No Category Found</option>

                <?php
                 }

                  //2. Display on Drpopdown
                 ?>

              </select>
            </td>
					</tr>

          <tr>
            <td>Active?</td>
						<td><input type="radio" name="active" value="Yes">&nbsp; Yes &nbsp;
							<input type="radio" name="active" value="No">&nbsp; No
						</td>
					</tr>

					<tr>
						<td>Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Food" class="btn-primary">
							<a href="manage_items.php" style="font-size:19.5px; text-decoration: none; color:white;"><button class="btn-cancel" style="font-size: 16px; padding: 1.7%;">
									Cancel </a>
						</td>
					</tr>
				</table>

			</form>

			<?php
         //CHeck whether the button is clicked or not
         if(isset($_POST['submit']))
         {
           //1. Get the DAta from Form
           $food = mysqli_real_escape_string($conn, $_POST['food']);
           $description = mysqli_real_escape_string($conn, $_POST['description']);
           $size = $_POST['size'];         
           $code = $_POST['code'];          
           $price = $_POST['price'];           
           $category = $_POST['category'];           
           $image = $_FILES['image']['name'];
           
           $source_path = $_FILES['image']['tmp_name'];           
           $destination_path = "../Images/".$image;
           
           //Upload image            
           $upload = move_uploaded_file($source_path, $destination_path);
           
           //Check if active is "yes" or "no"                
           if(isset($_POST['active']))            
           {           
             $active = $_POST['active'];             
           }           
           else           
           {           
             $active = "No";             
           }
           
           //3. Query to insert item into database
           $sql2 = "INSERT INTO ll_food SET           
           product_name = '$food',           
           product_desc = '$description',           
           product_size = '$size',           
           product_price = '$price',           
           product_code = '$code',           
           category_id = '$category',           
           active = '$active',           
           photo = '$image'           
           ";
             
           //Execute the Query      
           $res2 = mysqli_query($conn, $sql2);
                 
           //4. Redirect with message to Manage items page
           if($res2 == true)
           {           
             //Data inserted Successfullly
            $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
             
            //Redirect to Manage Items             
             header('location:manage_items.php');         
           }                
           else            
           {            
             //Failed to insert data       
             $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                   
             //Redirect to Manage Items              
             header('location:manage_items.php');  
           }
         }
      
      ?>

		</div>
	</div>

  <?php include('partials/admin_footer.php'); ?>   <!-- use footer -->
  
  
