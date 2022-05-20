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

	<?php include("partials/admin_navbar.php"); ?> <!-- use navigation bar -->
	<br>
  
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage OLO Info</h1>

			<br /><br />
			<?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }          

	    if(isset($_SESSION['no-info-found']))
            {
                echo $_SESSION['no-info-found'];
                unset($_SESSION['no-info-found']);
            }  
        ?>
			<br><br>

			<!-- Button to Add Text -->
			<a href="add_olotext.php" class="btn-primary">Add Text</a>

			<br /><br /><br />

			<table class="tbl-full">
				<tr>
					<th>ID</th>
					<th>Text</th>
					<th>Actions</th>
				</tr>

				<?php

                        //Query to Get all data from Database
                        $sql = "SELECT * FROM ll_olo";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Count Rows
                        $count = mysqli_num_rows($res);

                        //Create Serial Number Variable and assign value as 1
                        $num=1;

                        //Check whether we have data in database or not
                        if($count>0)
                        {                            
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $text = $row['description'];
                                
        ?>

				<tr>
					<td><?php echo $num++; ?>. </td>
					<td width="60%"><?php echo $text; ?></td>

					<td>
						<a href="update_OLOText.php?id=<?php echo $id; ?>" class="btn-secondary">Update Text</a>
						<a href="delete_olotext.php?id=<?php echo $id; ?>" class="btn-danger">Delete Text</a>
					</td>
				</tr>

				<?php
                            }
                        }
                        else
                        {
                            echo "<tr> <td colspan='7' class='error'> Text not Added Yet. </td> </tr>";
                        }

                    ?>


			</table>

			<br><br><br><br>

			<a href="Manage_OLO.php" class="btn-back">&laquo; Back </a> <!-- Back button -->
		</div>

	</div>

	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
  
