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
		font-family: Georgia;
		font-size: 20px;
		font-weight: bold;
	}

	.tbl-small {
		width: 45%;
	}
	</style>

	<?php include('partials/admin_navbar.php'); ?> <!-- uses admin navigation bar -->

	<div class="main-content">
		<div class="wrapper">
			<h1>Add Contact Page Content</h1>


			<?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

			<br><br>

			<form action="" method="POST">

				<table class="tbl-small">

					<tr>
						<td>Address: </td>
						<td>
							<textarea name="address" cols="35" rows="2" placeholder="Enter Restuarant Address"></textarea>
						</td>
					</tr>

					<td>Phone #: </td>
					<td><input type="text" name="phone" placeholder="Enter Phone Number">
					</td>
					</tr>

					<td>Email: </td>
					<td>
						<textarea name="email" cols="35" rows="2" placeholder="Enter Email Address"></textarea>
					</td>
					</tr>

					<td>Social: </td>
					<td>
						<textarea name="social" cols="35" rows="2" placeholder="Enter Social Media Account"></textarea>
					</td>
					</tr>

					<td>Map: </td>
					<td>
						<textarea name="map" cols="35" rows="5" placeholder="Enter Google Map link"></textarea>
					</td>
					</tr>


					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Content" class="btn-primary">
							<a href="Manage_Contact.php" style="text-decoration: none; color:white;"><button class="btn-cancel" style="font-size: 19px; padding: 1.7%;">
									Cancel </a>
						</td>
					</tr>

				</table>

			</form>


			<?php

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $social = $_POST['social'];
                $map = $_POST['map'];


                //Query to insert contact page content
                $sql = "INSERT INTO ll_contact SET
                    rest_address = '$address',
                    phone = '$phone',
                    email = '$email',
                    social = '$social',
                    map = '$map'
                ";

                //Execute the Query
                $res = mysqli_query($conn, $sql);
              
                if($res == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Content Added Successfully.</div>";
                  
                  //Redirect to Manage Contact page 
                  header('location:Manage_Contact.php');
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Content.</div>";
                  
                  //Redirect to Manage Contact page
                  header('location:Manage_Contact.php');
                }
            }

        ?>

		</div>
	</div>
	
<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
