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

	table tr td {
		font-family: Georgia;
		font-size: 20px;
		font-weight: bold;
	}

	.error {
		font-size: 24px;
	}

	input[type='radio'] {
		transform: scale(1.3);
	}
	</style>

	<?php include('partials/admin_navbar.php'); ?> <!-- use navigation bar -->

	<div class="main-content">
		<div class="wrapper">
			<h1>Add Category</h1>

			<?php
                    if(isset($_SESSION['addcategory']))
                    {
                        echo $_SESSION['addcategory'];
                        unset($_SESSION['addcategory']);
                    }
                ?>

			<br>

			<form action="" method="POST">

				<table class="tbl-small">
					<tr>
						<td>Category:</td>
						<td><input type="text" name="Category" placeholder="Enter Category"></td>
					</tr>

					<tr>
						<td>Active?</td>
						<td><input type="radio" name="Active" value="Yes">&nbsp; Yes &nbsp;
							<input type="radio" name="Active" value="No">&nbsp; No
						</td>
					</tr>


					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Category" class="btn-primary">
							<a href="manage_category.php" style="text-decoration: none; color:white;"><button class="btn-cancel" style="font-size: 19px; padding: 1.7%;">
									Cancel </a>
						</td>
					</tr>
				</table>

			</form>


			<?php
        //Check if add button has been clicked 

        if(!empty($_POST['Category'])&&
            !empty($_POST['Active']))
        {           
            //Retrieve data from form
            $Category= $_POST['Category'];
            $Active= $_POST['Active'];

            // Query: add category to database
            $sql = "INSERT INTO ll_category SET 
                category='$Category',
                active='$Active'
            ";

            //Execute and save to database   
            $res = mysqli_query($conn, $sql) or die(mysqli_error());
                    
            //DATA INSERTED            
            $_SESSION['addcategory'] = "<div class= 'success'>Category Added.</div>";
                    
            // Redirect to Manage Category           
            header('location:manage_category.php');    
        }           
        else      
        {            
          //NO DATA INSERTED
          $_SESSION['addcategory'] = "<div class= 'error'>No Category Added.</div>";     
        }

    ?>
	
    </div>
	</div>
	
  <?php include('partials/admin_footer.php'); ?> <!-- use footer -->
