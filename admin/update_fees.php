<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/admin.css" rel="stylesheet"> <!-- import CSS file for admin pages -->

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
	</style>


  <?php include('partials/admin_navbar.php'); ?>  <!-- use navigation bar -->
  
	<div class="main-content">
		<div class="wrapper">
			<h1>Update Fees</h1>

			<br><br>


			<?php
        //Get id 
        $id = $_GET['id'];

        //Query to get the selected data
        $sql = "SELECT * FROM fees WHERE id=$id";

        //Execute Query
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Count Rows
            $count = mysqli_num_rows($res);

            if($count==1)
            {  
              //Get the individual values                
              $row = mysqli_fetch_assoc($res);
                
              $Delivery= $row['delivery'];                
              $Tax= $row['tax_rate'];
            }
            else
            {                
              //Redirect to Manage Fees                
              header('location:manage_fees.php');
            }
        }
?>

      <!-- Update Form with existing values -->
			<form action="" method="POST">

				<table class="tbl-small" style="width:35%;">
					<tr>
						<td>Delivery Fee:</td>
						<td><input type="number" step="0.01" min="0" name="delivery" value="<?php echo $Delivery; ?>"></td>
					</tr>

					<tr>
						<td>Tax Rate:</td>
						<td> <input type="number" step="0.01" min="0" name="tax" value="<?php echo $Tax; ?>"></td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">

							<input type="submit" name="submit" value="Update Fees" class="btn-update">
							<input type="submit" name="cancel" value="Cancel" class="btn-cancel">
						</td>
					</tr>

				</table>

			</form>

			<?php

        //Cancel button is clicked 
        if(isset($_POST['cancel']))
        {
            header('Location: manage_fees.php');
            die('');
        }
            if(isset($_POST['submit']))
            {
                //Get all the details from the form
                $id = $_POST['id'];
                $Delivery= $_POST['delivery'];
                $Tax= $_POST['tax'];

                //Update the Database
                $sql3 = "UPDATE fees SET
                    delivery = '$Delivery',
                    tax_rate = '$Tax'
                    WHERE id=$id
                ";

                //Execute Query
                $res3 = mysqli_query($conn, $sql3);

                if($res3==true)
                {
                    //Query Successful
                    $_SESSION['update'] = "<div class='success'>Order Fees Updated Successfully.</div>";
                    header('location:manage_fees.php');
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Fees.</div>";
                    header('location:manage_fees.php');
                }
            }

        ?>

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?><!-- use footer -->
  
