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
		width: 200px;
		height: 150px;
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
			<h1>Update Home Page Content</h1>

			<br><br>


			<?php
                //Get the ID
                $id = $_GET['id'];

                //Query to get all other details
                $sql = "SELECT * FROM ll_home WHERE id=$id";

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
                        
                        $id=$rows['id'];
                        $hours=$rows['hours'];
                        $curimg_one = $rows['image_one'];
                        $curimg_two = $rows['image_two'];
                        $curimg_three = $rows['image_three'];

                    }
                    else
                    {
                        //redirect to manage home with session message
                        $_SESSION['no-content-found'] = "<div class='error'>Content not Found.</div>";
                        header('location:Manage_Home.php');
                    }
            }

        ?>

      <!-- Update Form with existing values -->
			<form action="" method="POST" enctype="multipart/form-data">

				<table class="tbl-small" style="width:50%">

					<tr>
						<td>Hours: </td>
						<td>
							<textarea name="hours" cols="35" rows="5"><?php echo $hours; ?></textarea>
						</td>
					</tr>

					<tr>
						<td>Current Image 1: </td>
						<td>
							<?php echo "<img src='../Images/".$curimg_one."' >";?>
						</td>
					</tr>

					<tr>
						<td>Image 1: </td>
						<td>
							<input type="file" name="image_one">
						</td>
					</tr>

					<tr>
						<td>Current Image 2: </td>
						<td>
							<?php echo "<img src='../Images/".$curimg_two."' >";?>
						</td>
					</tr>

					<tr>
						<td>Image 2: </td>
						<td>
							<input type="file" name="image_two">
						</td>
					</tr>

					<tr>
						<td>Current Image 3: </td>
						<td>
							<?php echo "<img src='../Images/".$curimg_three."' >";?>
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
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="current_image" value="<?php echo $curimg_one; ?>">
							<input type="hidden" name="current_image2" value="<?php echo $curimg_two; ?>">
							<input type="hidden" name="current_image3" value="<?php echo $curimg_three; ?>">

							<input type="submit" name="submit" value="Update Content" class="btn-update" style="padding:2%">
							<input type="submit" name="cancel" value="Cancel" class="btn-cancel" style="padding:2%">
						</td>

				</table>

			</form>


			<?php

            //Cancel button is clicked 
            if(isset($_POST['cancel']))
            {
                header('location:Manage_Home.php');
                die('');
            }

            if(isset($_POST['submit']))
            {
                // Get all the values from form
                $id = $_POST['id'];
                $hours = mysqli_real_escape_string($conn, $_POST['hours']);
                $curimg_one = $_POST['current_image'];
                $curimg_two = $_POST['current_image2'];
                $curimg_three = $_POST['current_image3'];


                if(isset($_FILES['image_one']['name']))
                {
                    $filename = $_FILES['image_one']['name'];

                    if($filename != "")
                    {

                        $source_path = $_FILES['image_one']['tmp_name'];
                        $destination_path = "../Images/".$filename;

                        //Insert Into Database
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image(s). </div>";
                            
                            //Redirect to Manage Home Page
                            header('location:Manage_Home.php');
                            
                            //STop the Process
                            die();
                        }

                        if($curimg_one!="")
                        {
                            $remove_path = "../Images/".$curimg_one;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:Manage_Home.php');
                                die();//Stop the Process
                            }
                        }

                    }
                    else
                    {
                        $filename = $curimg_one;
                    }
                }
                else
                {
                    $filename = $curimg_one;
                }

                if(isset($_FILES['image_two']['name']))
                {
                    $filename2 = $_FILES['image_two']['name'];

                    if($filename2 != "")
                    {

                        $source_path2 = $_FILES['image_two']['tmp_name'];
                        $destination_path2 = "../Images/".$filename2;

                        //Insert Into Database
                        $upload2 = move_uploaded_file($source_path2, $destination_path2);

                        if($upload2==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image(s). </div>";
                            
                            //Redirect to Manage Home Page
                            header('location:Manage_Home.php');
                            
                            //STop the Process
                            die();
                        }

                        if($curimg_two!="")
                        {
                            $remove_path2 = "../Images/".$curimg_two;

                            $remove2 = unlink($remove_path2);

                            //Check whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove2==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:Manage_Home.php');
                                die();//Stop the Process
                            }
                        }

                    }
                    else
                    {
                        $filename2 = $curimg_two;
                    }
                }
                else
                {
                    $filename2 = $curimg_two;
                }

                if(isset($_FILES['image_three']['name']))
                {
                    $filename3 = $_FILES['image_three']['name'];

                    if($filename3 != "")
                    {

                        $source_path3 = $_FILES['image_three']['tmp_name'];
                        $destination_path3 = "../Images/".$filename3;

                        //Insert Into Database
                        $upload3 = move_uploaded_file($source_path3, $destination_path3);

                        if($upload3==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image(s). </div>";
                            
                            //Redirect to Manage Home Page
                            header('location:Manage_Home.php');
                            
                            //STop the Process
                            die();
                        }

                        if($curimg_three!="")
                        {
                            $remove_path3 = "../Images/".$curimg_three;

                            $remove3 = unlink($remove_path3);

                            //Check whether the image is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove3==false)
                            {
                                //Failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location:Manage_Home.php');
                                die();//Stop the Process
                            }
                        }

                    }
                    else
                    {
                        $filename3 = $curimg_three;
                    }
                }
                else
                {
                    $filename3 = $curimg_three;
                }


                //Update the Database
                $sql2 = "UPDATE ll_home SET
                    hours = '$hours',
                    image_one = '$filename',
                    image_two = '$filename2',
                    image_three = '$filename3'
                    WHERE id=$id
                ";

                //Execute Query
                $res2 = mysqli_query($conn, $sql2);

                // Redirect to Manage Home with Message
                if($res==true)
               {
                    //Content Updated
                    $_SESSION['update'] = "<div class='success'>Content Updated Successfully.</div>";
                    header('location:Manage_Home.php');
                }
                else
                {
                    //failed to update content
                    $_SESSION['update'] = "<div class='error'>Content Not Updated.</div>";
                    //header('location:update_home.php');
                }
          }

        ?>

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?><!-- use footer -->
