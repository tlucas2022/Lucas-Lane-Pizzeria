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

	input[type="submit"],
	.btn-cancel {
		padding: 2%;
	}

	.tbl-small {
		width: 43%;
	}
	</style>

  <?php include('partials/admin_navbar.php'); ?> <!-- uses admin navigation bar -->

	<div class="main-content">
		<div class="wrapper">
			<h1>Update OLO Information</h1>

			<br><br>


			<?php
                //Get the ID
                $id = $_GET['id'];

                //Query to get all other details
                $sql = "SELECT * FROM ll_olo WHERE id=$id";

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

                        $description = $row['description'];

                    }
                    else
                    {
                        //redirect to manage OLO text with session message
                        $_SESSION['no-info-found'] = "<div class='error'>Info Blurb not Found.</div>";
                        header('location:manage_OLOText.php');
                    }
            }

        ?>
      
      <!-- Update Form with existing values -->
			<form action="" method="POST">

				<table class="tbl-small">
					<tr>
						<td>Text:</td>
						<td><textarea name="description" cols="35" rows="5"><?php echo $description; ?></textarea></td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" value="Update Text" class="btn-update">
							<a href="manage_OLOText.php" style="text-decoration: none; color:white;"><button class="btn-cancel">
									Cancel </a>
						</td>

				</table>

			</form>


			<?php

         if(isset($_POST['submit']))
         {
                //Get all the values from form
                $id = $_POST['id'];
                $description = mysqli_real_escape_string($conn, $_POST['description']);

                // Update Database
                $sql = "UPDATE ll_olo SET
                description = '$description'
                WHERE id=$id
                ";

             //Execute Query
             $res = mysqli_query($conn, $sql);
           
             //Redirect with Message to Manage OLO text page

             if($res == true)
             {
                //Info Updated
                $_SESSION['update'] = "<div class='success'>Info Updated Successfully.</div>";
                header('location:manage_OLOText.php');
            }
                else
                {
                    //failed to update text
                    $_SESSION['update'] = "<div class='error'>Info Not Updated.</div>";
                }
         }
        ?>

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
    
