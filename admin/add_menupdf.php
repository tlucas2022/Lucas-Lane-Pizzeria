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
	</style>

<?php include('partials/admin_navbar.php'); ?> <!-- uses admin navigation bar -->

  
	<div class="main-content">
		<div class="wrapper">
			<h1>Add Menu PDF</h1>

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

				<table class="tbl-small">

					<tr>
						<td>PDF </td>
						<td>
							<input type="file" name="file" id="file">
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Menu PDF" class="btn-primary">
							<a href="manage_menupdf.php" style="text-decoration: none; color:white;">

								<button class="btn-cancel" style="font-size: 18px; padding: 1.7%;">
									Cancel </a>
						</td>
					</tr>

				</table>

			</form>


			<?php

            if(isset($_POST['submit']))
            {
                if(isset($_FILES['file']['name']))
                {
                    //Upload the PDF
                    $filename = $_FILES['file']['name'];

                    // Upload the PDF only if not blank
                    if($filename != "")
                    {
                        $source_path = $_FILES['file']['tmp_name'];

                        $destination_path = "../PDF/".$filename;

                        //Upload the pdf
                        $upload = move_uploaded_file($source_path, $destination_path);


                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload PDF. </div>";
                           
                            //Redirect to Add Menu PDF Page
                            header('location:add_menupdf.php');
                              
                            //Stop the Process
                            die();
                        }

                    }
                }

                else
                {
                    //Don't Upload PDF and set the value as blank
                    $filename="";
                }

                            // PDF insert sql
                            $insert = "INSERT into ll_menu_pdf SET
                            pdf ='$filename'
                            ";

                            if(mysqli_query($conn, $insert))
                            {
                                $_SESSION['upload'] = "<div class='success'>Menu PDF Added Successfully.</div>";
                                header('location:manage_menupdf.php');
                            }

                            else
                            {
                                echo 'Error: '.mysqli_error($conn);
                            }
                    }
                        else
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Add Menu PDF.</div>";
                        }

                ?>


		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
  
