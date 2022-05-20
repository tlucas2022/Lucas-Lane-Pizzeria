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

	input[type='radio'] {
		transform: scale(1.3);
	}

	table tr td {
		font-size: 20px;
		font-weight: bold;
	}

	.error {
		font-size: 24px;
	}
	</style>


	<?php include("partials/admin_navbar.php"); ?> <!-- use navigation bar -->

	<div class="main-content">
		<div class="wrapper">
			<h1>Update Admin</h1>
      
			<br>
      
			<h5>*New or Same Password Must Be Retyped*<h5>					
        <br><br>

					<?php
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>

					<br>

					<?php
            //1. Get the ID of Selected Admin
            $id=$_GET['id'];

            //2. Query to Get the Details
            $sql="SELECT * FROM ll_admin WHERE id=$id";

            //Execute Query
            $res=mysqli_query($conn, $sql);
            
            if($res==true)
            {
              //Count Rows             
              $count = mysqli_num_rows($res);              
              
              if($count==1)                
              {                   
                // Get the Details                                
                $row=mysqli_fetch_assoc($res);
                
                $username = $row['username'];                
                $password = $row['password'];                
                $title = $row['title'];                
              }              
              else              
              {              
                //Redirect to Manage Admin Page                
                header('location:Manage_Admins.php');                
              }            
            }        
        ?>

        <!-- Update Form with existing values -->
					<form action="" method="POST">

						<table class="tbl-small">
							<tr>
								<td>Username: </td>
								<td><input type="text" name="Username" value="<?php echo $username; ?>"></td>
							</tr>

							<tr>
								<td>Password: </td>
								<td><input type="password" name="Password" value="<?php echo $password; ?>"></td>
							</tr>

							<tr>
								<td>Title: </td>
								<td><input type="radio" name="Title" value="Owner" <?php if($title == 'Owner') echo 'checked' ?>>&nbsp; Owner &nbsp
									<input type="radio" name="Title" value="Employee" <?php if($title == 'Employee') echo 'checked' ?>>&nbsp; Employee
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<input type="submit" name="submit" value="Update Admin" class="btn-update">
									<input type="submit" name="cancel" value="Cancel" class="btn-cancel">
								</td>
							</tr>

						</table>

					</form>
		</div>
	</div>

	<?php

    //Cancel button is clicked
    if(isset($_POST['cancel']))
    {
        header('Location: Manage_Admins.php');
        die('');
    }

    //Check if username and password have inputs
    else if(!empty($_POST['Username'])&&
        !empty($_POST['Password']))
    {       
        //Get all the values from form to update
        $id = $_POST['id'];
        $username = $_POST['Username'];
        $password = md5($_POST['Password']);
        $title = $_POST['Title'];

        //Query to Update Admin
        $sql = "UPDATE ll_admin SET
        username='$username',
        password='$password',
        title='$title'
        WHERE id='$id'
        ";

        //Execute Query
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //Query Executed and Admin Updated
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
      
        //Redirect to Manage Admin Page
        header('location:Manage_Admins.php');        
    }       
      else
      {
         //Failed to Update Admin
         $_SESSION['update'] = "<div class='error'>No Admin Updated.</div>";          
      }
?>
      
	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
      
