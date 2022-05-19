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

	<?php include('partials/admin_navbar.php'); ?> <!-- use navigation bar -->

	<div class="main-content">
		<div class="wrapper">
			<h1>Add Order Fees</h1>

			<?php
                    if(isset($_SESSION['addfees']))
                    {
                        echo $_SESSION['addfees'];
                        unset($_SESSION['addfees']);
                    }
                ?>

			<br>

			<form action="" method="POST">

				<table class="tbl-small" style="width:35%;">
					<tr>
						<td>Delivery Fee:</td>
						<td><input type="number" step="0.01" min="0" name="delivery" placeholder="Enter Delivery Fees"></td>
					</tr>

					<tr>
						<td>Tax Rate:</td>
						<td> <input type="number" step="0.01" min="0" name="tax" placeholder="Enter Tax Rate"></td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Fees" class="btn-primary">
							<a href="manage_fees.php" style="text-decoration: none; color:white;"><button class="btn-cancel" style="font-size: 18px; padding: 1.7%;">
									Cancel </a>
						</td>
					</tr>
				</table>

			</form>


			<?php
        //CHeck whether the button is clicked or not
        if(isset($_POST['submit']))
        {
           $Delivery= $_POST['delivery'];
           $Tax= $_POST['tax'];

            //3. Insert Into Database
            $sql = "INSERT INTO fees SET
                delivery = '$Delivery',
                tax_rate = '$Tax'
            ";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //CHeck whether data inserted or not
            if($res == true)
            {
             //DATA INSERTED
             $_SESSION['addfees'] = "<div class= 'success'>Fees Added.</div>";
              
              //Redirect to Manage Fees page
             header('location:manage_fees.php');
            }
            else
            {
                //NO DATA INSERTED
                $_SESSION['addfees'] = "<div class= 'error'>No Fees Added.</div>";
              
                //Redirect to Manage Fees page
                header('location:manage_fees.php');
            }
        }

    ?>

		</div>
	</div>
  
	<?php include('partials/admin_footer.php'); ?> <!--  Use Footer -->
  
  
