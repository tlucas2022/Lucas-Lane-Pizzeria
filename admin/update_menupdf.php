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

	iframe {
		width: 90%;
		height: 350px;
	}
	</style>
  
  <?php include('partials/admin_navbar.php'); ?><!-- use navigation bar -->

	<div class="main-content">
		<div class="wrapper">
			<h1>Update Menu PDF</h1>

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

        //Query to Get the Selected Menu PDF
        $sql = "SELECT * FROM ll_menu_pdf WHERE id=$id";

        //execute
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Count the Rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);

                    $current_pdf = $row['pdf'];
                }
                    else
                    {
                        //redirect to manage menu with session message
                        $_SESSION['noupdate'] = "<div class='error'>File not Found.</div>";
                        header('location:manage_menupdf.php');
                    }

            }

        ?>

			<table class="tbl-display">

				<tr>
					<th colspan="2" style="text-align: center;">Current PDF</th>
				</tr>

				<td style="text-align: center; vertical-align: middle;">
					<iframe src="<?php echo '../PDF/'.$current_pdf; ?>"></iframe>
				</td>


			</table>

			<br><br><br>
      
<!-- Update Form with existing values -->
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-small">
					<tr>
						<td style="background-color:#bbd6fa; padding-right: 30px;">Select New PDF: </td>
						<td>
							<input type="file" name="pdf">
						</td>

					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="current_pdf" value="<?php echo $current_pdf; ?>">

							<input type="submit" name="submit" value="Update Menu" class="btn-update" style="font-size: 16px; padding: 2%;">
							<input type="submit" name="cancel" value="Cancel" class="btn-cancel" style="font-size: 16px; padding: 2%;">
						</td>
					</tr>

				</table>

			</form>

			<?php
      
      //Cancel button is clicked
          if(isset($_POST['cancel']))
          {
              header('Location: manage_menupdf.php');
              die('');
          }

            if(isset($_POST['submit']))
            {
                // Get all the values from our form
                $id = $_POST['id'];
                $current_pdf = $_POST['current_pdf'];

                if(isset($_FILES['pdf']['name']))
                {
                    //Get the PDF Details
                    $filename = $_FILES['pdf']['name'];

                    //Check whether the PDF is available or not
                    if($filename != "")
                    {
                        //Upload the New PDF

                        $source_path = $_FILES['pdf']['tmp_name'];

                        $destination_path = "../PDF/".$filename;

                        //Finally Upload the PDF
                        $upload = move_uploaded_file($source_path, $destination_path);


                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload PDF. </div>";
                            
                          //Redirect
                            header('location:manage_menupdf.php');
                            
                          //Stop the Process
                            die();
                        }

                        //B. Remove the Current pdf if available
                        if($current_pdf!="")
                        {
                            $remove_path = "../PDF/".$current_pdf;

                            $remove = unlink($remove_path);

                            //CHeck whether the pdf is removed or not
                            //If failed to remove then display message and stop the processs
                            if($remove==false)
                            {
                                //Failed to remove pdf
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current PDF.</div>";
                                header('location:manage_menupdf.php');
                                die();//Stop the Process
                            }
                        }


                    }
                    else
                    {
                        $filename = $current_pdf;
                    }
                }
                else
                {
                    $filename = $current_pdf;
                }

                // Update the Database
                $sql2 = "UPDATE ll_menu_pdf SET
                    pdf = '$filename'
                    WHERE id=$id
                ";

                //Execute Query
                $res2 = mysqli_query($conn, $sql2);

                //Redirect to Manage PDF with Message
                if($res2==true)
                {
                    //PDF Updated
                    $_SESSION['update'] = "<div class='success'>Menu PDF Updated Successfully.</div>";
                    header('location:manage_menupdf.php');
                }
                else
                {
                    //failed to update pdf
                    $_SESSION['update'] = "<div class='error'>Failed to Update Menu PDF.</div>";
                    header('location:manage_menupdf.php');
                }

            }

        ?>
		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?><!-- use footer -->
