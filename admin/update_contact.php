<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/admin.css" rel="stylesheet"><!-- import CSS file for admin pages -->

	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}

	table tr td {
		font-size: 20px;
		font-weight: bold;
	}

	input[type="submit"] {
		padding: 2%;
	}

	.tbl-small {
		width: 45%;
	}
	</style>

  <?php include('partials/admin_navbar.php'); ?><!-- use navigation bar -->

	<div class="main-content">
		<div class="wrapper">
			<h1>Update Contact Page Content</h1>

			<br><br>


			<?php
                //Get the ID 
                $id = $_GET['id'];

                //Query to get all other details
                $sql = "SELECT * FROM ll_contact WHERE id=$id";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //Count Rows
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //Get all the data
                        $rows = mysqli_fetch_assoc($res);
                      
                        $id = $rows['id'];
                        $address = $rows['rest_address'];
                        $phone = $rows['phone'];
                        $email = $rows['email'];
                        $social = $rows['social'];
                        $map = $rows['map'];
                    }
                    else
                    {
                        //redirect to manage contact with session message
                        $_SESSION['no-content-found'] = "<div class='error'>Content not Found.</div>";
                        header('location:Manage_Contact.php');
                    }
            }

        ?>

      <!-- Update Form with existing values -->
			<form action="" method="POST">

				<table class="tbl-small">

					<tr>
						<td>Address: </td>
						<td>
							<textarea name="address" cols="35" rows="2"><?php echo $address?></textarea>
						</td>
					</tr>

					<td>Phone #: </td>
					<td><input type="text" name="phone" value="<?php echo $phone?>"></td>
					</tr>

					<td>Email: </td>
					<td>
						<textarea name="email" cols="35" rows="2"><?php echo $email?></textarea>
					</td>
					</tr>

					<td>Social: </td>
					<td>
						<textarea name="social" cols="35" rows="2"><?php echo $social?></textarea>
					</td>
					</tr>

					<td>Map: </td>
					<td>
						<textarea name="map" cols="35" rows="5"><?php echo $map?></textarea>
					</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">

							<input type="submit" name="submit" value="Update Content" class="btn-update">
							<input type="submit" name="cancel" value="Cancel" class="btn-cancel">
						</td>

				</table>

			</form>


			<?php

          //Cancel button is clicked 
          if(isset($_POST['cancel']))
          {
              header('Location: Manage_Contact.php');
              die('');
          }


            if(isset($_POST['submit']))
            {
                // Get all the values from form
                $id = $_POST['id'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $social = $_POST['social'];
                $map = $_POST['map'];


                // Update the Database
                $sql2 = "UPDATE ll_contact SET
                    rest_address = '$address',
                    phone = '$phone',
                    email = '$email',
                    social = '$social',
                    map = '$map'
                    WHERE id=$id
                ";

                //Execute Query
                $res2 = mysqli_query($conn, $sql2);

                if($res==true)
               {
                    //Content Updated
                    $_SESSION['update'] = "<div class='success'>Content Updated Successfully.</div>";
                    
                    // Redirecct to manage contact                   
                    header('location:Manage_Contact.php');
                }
                else
                {
                    //failed to update content
                    $_SESSION['update'] = "<div class='error'>Content Not Updated.</div>";                   
                }
          }

        ?>

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?>  <!-- use footer -->
