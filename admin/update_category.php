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

	input[type='radio'] {
		transform: scale(1.3);
	}

	table tr td {
		font-size: 20px;
		font-weight: bold;
	}

	.error {
		font-size: 24px;
	}
	</style>
  
  
  <?php include('partials/admin_navbar.php'); ?> <!-- use navigation bar -->
  
	<div class="main-content">
		<div class="wrapper">
			<h1>Update Category</h1>

			<br><br>

			<?php                
        //Get the ID
        $id = $_GET['id'];

        //Query to get all data
        $sql = "SELECT * FROM ll_category WHERE id=$id";

        //Execute Query
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
          //Count Rows
          $count = mysqli_num_rows($res);

          if($count==1)
          {
            //Get all the data
            $row = mysqli_fetch_assoc($res);

            $Category = $row['category'];
            $Active = $row['active'];
          }
          else
          {
            //redirect to manage category with session message
            $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
            header('location:manage_category.php');
          }
        }
      
      ?>

      <!-- Update Form with existing values -->
			<form action="" method="POST">

				<table class="tbl-small">
					<tr>
						<td>Category:</td>
						<td><input type="text" name="Category" value="<?php echo $Category; ?>"></td>
					</tr>

					<tr>
						<td>Active?</td>
						<td> <input <?php if($Active=="Yes"){echo "checked";} ?> type="radio" name="Active" value="Yes">&nbsp; Yes &nbsp;
							<input <?php if($Active=="No"){echo "checked";} ?> type="radio" name="Active" value="No">&nbsp; No
					</tr>


					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" value="Update Category" class="btn-update" style="padding:2%">
							<input type="submit" name="cancel" value="Cancel" class="btn-cancel" style="padding:2%">
						</td>

				</table>

			</form>


			<?php
            //Cancel button is clicked
            if(isset($_POST['cancel']))
            {
                header('Location: manage_category.php');
                die('');
            }

            if(!empty($_POST['Category']))
            {
                //Get all the values from our form
                $id = $_POST['id'];
                $Category = $_POST['Category'];
                $Active = $_POST['Active'];


                //Update Database
                $sql = "UPDATE ll_category SET
                    Category = '$Category',
                    Active = '$Active'
                    WHERE id=$id
                ";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Redirect to Manage Category with MEssage
 
 
                //Category Updated                
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";                    
                header('location:manage_category.php');                
            }               
            else
                {
                  //failed to update category
                  $_SESSION['update'] = "<div class='error'>Category Not Updated.</div>";
                }

        ?>

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?> <!--  use footer  -->
  
