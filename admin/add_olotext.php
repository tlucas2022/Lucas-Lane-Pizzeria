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
			<h1>Add OLO Text</h1>


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
						<td>Text: </td>
						<td>
							<textarea name="description" cols="30" rows="5" placeholder="Online Ordering Info."></textarea>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Text" class="btn-secondary" style="font-size:19px; border-radius:7.5px">
							<a href="manage_OLOText.php" style="text-decoration: none; color:white;"><button class="btn-cancel" style="font-size: 20px; padding: 1.7%;">
									Cancel </a>
						</td>
					</tr>

				</table>

			</form>


			<?php

            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                $description = mysqli_real_escape_string($conn, $_POST['description']);

                //Insert Into Database             
                $sql = "INSERT INTO ll_olo SET
                    description = '$description'
                ";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Check is query is successful
                if($res == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Info Added Successfully.</div>";
                  
                  //Redirect to Manage OLO Text page
                    header('location:manage_OLOText.php');
                }
                else
                {
                    //Failed to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Info.</div>";
                  
                  //Redirect to Manage OLO Text page
                    header('location:manage_OLOText.php');
                }
            }

        ?>

		</div>
	</div>
  
	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
  
