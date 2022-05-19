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
			<h1>Add Home Page Content</h1>

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

				<table class="tbl-small" style="width:50%">

					<tr>
						<td>Hours: </td>
						<td>
							<textarea name="hours" cols="35" rows="5" placeholder="Hours"></textarea>
						</td>
					</tr>

					<tr>
						<td>Image 1: </td>
						<td>
							<input type="file" name="image_one">
						</td>
					</tr>

					<tr>
						<td>Image 2: </td>
						<td>
							<input type="file" name="image_two">
						</td>
					</tr>

					<tr>
						<td>Image 3: </td>
						<td>
							<input type="file" name="image_three">
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Home Page" class="btn-primary">
							<a href="Manage_Home.php" style="text-decoration: none; color:white;"><button class="btn-cancel" style="font-size: 19px; padding: 1.7%;">
									Cancel </a>
						</td>
					</tr>

				</table>

			</form>


			<?php

            if(isset($_POST['submit']))
            {
                $hours = mysqli_real_escape_string($conn, $_POST['hours']);
                $img_one = $_FILES['image_one']['name'];
                $img_two = $_FILES['image_two']['name'];
                $img_three = $_FILES['image_three']['name'];

                $source_path1 = $_FILES['image_one']['tmp_name'];
                $destination_path1 = "../Images/".$img_one;

                $source_path2 = $_FILES['image_two']['tmp_name'];
                $destination_path2 = "../Images/".$img_two;

                $source_path3 = $_FILES['image_three']['tmp_name'];
                $destination_path3 = "../Images/".$img_three;

                    // Upload files and store in database
                    $upload = move_uploaded_file($source_path1, $destination_path1) &&
                    move_uploaded_file($source_path2, $destination_path2) &&
                    move_uploaded_file($source_path3, $destination_path3);


                    //Query to insert content into database
                    $sql = "INSERT INTO ll_home SET
                    hours = '$hours',
                    image_one = '$img_one',
                    image_two = '$img_two',
                    image_three = '$img_three'
                ";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                if($res == true)
                {
                  //Data inserted Successfullly
                  $_SESSION['add'] = "<div class='success'>Content Added Successfully.</div>";

                  //Redirect to Manage Home page
                  header('location:Manage_Home.php');
                }
                else
                {
                  //Failed to Insert Data
                  $_SESSION['add'] = "<div class='error'>Failed to Add Content.</div>";
                  
                  //Redirect to Manage Home page
                  header('location:Manage_Home.php');
                }
            }

        ?>

		</div>
	</div>
  
	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
  
