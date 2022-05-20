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

	img {
		width: 225px;
		height: 275px;
	}

	.tbl-small tr td {
		font-size: 20px;
		font-weight: bold;
	}

	table th {
		font-size: 23px;
	}

	.error {
		font-size: 24px;
	}
	</style>

  	<?php include('partials/admin_navbar.php'); ?><!-- use navigation bar -->
  
	<div class="main-content">
		<div class="wrapper">
			<h1>Update Menu Images</h1>

			<br><br>

			<?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

			<?php

        //Get details
        $id = $_GET['id'];

        //Query to Get the Selected Menu Image
        $sql = "SELECT * FROM ll_menu WHERE id=$id";

        //execute
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Count Rows
            $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);

                    $current_image = $row['image'];
                }
                    else
                    {
                        //redirect to manage menu with session message
                        $_SESSION['noupdate'] = "<div class='error'>Image not Found.</div>";
                        header('location:manage_menuimages.php');
                    }

            }

        ?>

			<table class="tbl-display">

				<tr>
					<th colspan="2" style="text-align: center;">Current Image</th>
				</tr>


				<td style="text-align: center; vertical-align: middle;">
					<?php
                            //Image Available
                            echo "<img src='../Images/".$row['image']."' >";

                    ?>
				</td>

			</table>

			<br><br><br>
      
      
<!-- Update Form with existing values -->
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-small">
					<tr>
						<td style="background-color:#bbd6fa; padding-right:20px; width:34%;">Select New Image: </td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>



					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

							<input type="submit" name="submit" value="Update Menu" class="btn-update" style="font-size: 18px; padding: 2%;">
							<input type="submit" name="cancel" value="Cancel" class="btn-cancel" style="font-size: 18px; padding: 2%;">
						</td>
					</tr>

				</table>

			</form>

			<?php
      
      //Cancel button is clicked 
            if(isset($_POST['cancel']))
            {
                header('Location: manage_menuimages.php');
                die('');
            }

            if(isset($_POST['submit']))
            {
                // Get all the values from form
                $id = $_POST['id'];
                $current_image = $_POST['current_image'];


                // Updating New Image if selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the Image Details
                    $filename = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($filename != "")
                    {
                        // Upload the New Image

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../Images/".$filename;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            
                            //Redirect to Manage Page
                            header('location:manage_menuimages.php');
                           
                          //Stop the Process
                            die();
                        }

                        //Remove the Current Image if available
                        if($current_image!="")
                        {
                            $remove_path = "../Images/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:manage_menuimages.php');
                                
                                die();
                                //Stop the Process
                            }
                        }

                    }
                    else
                    {
                        $filename = $current_image;
                    }
                }
                else
                {
                    $filename = $current_image;
                }

                //3. Update the Database
                $sql2 = "UPDATE ll_menu SET
                    image = '$filename'
                    WHERE id=$id
                ";

                //Execute Query
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirect to Manage with Message
                //CHeck whether executed or not
                if($res2==true)
                {
                    //Content Updated
                    $_SESSION['update'] = "<div class='success'>Menu Image Updated Successfully.</div>";
                    header('location:manage_menuimages.php');
                }
                else
                {
                    //failed to update content
                    $_SESSION['update'] = "<div class='error'>Failed to Update Menu Image.</div>";
                    header('location:update_menuimages.php');
                }

            }

        ?>
		</div>
	</div>


	<?php include('partials/admin_footer.php'); ?><!-- use footer -->
  
