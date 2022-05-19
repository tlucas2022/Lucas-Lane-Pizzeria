<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  
	<link href="css/admin.css" rel="stylesheet"> <!-- reference CSS file for admin pages -->
  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- import font awesome icons -->
  
  
	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}

	.error {
		font-size: 24px;
	}
	</style>
  
  
	<?php include("partials/admin_navbar.php"); ?> <!-- use navigation bar -->


	<br>
	<!-- Main Section-->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Admins</h1>

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


                ?>
			<br><br>


			<!-- Add Admin Button -->
			<a href="Add_Admin.php" class="btn-primary"> Add Admin</a>

			<pre></pre>
			<br><br>

			<table class="tbl-full">
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>Title</th>
					<th>Actions</th>

				</tr>

				<?php

        //Query to select any admin profiles                         
        $sql = "SELECT * FROM ll_admin";
        
        //Execute          
        $res = mysqli_query($conn, $sql);
        
        if($res==TRUE)
        
        {         
          //Count Rows
          $count = mysqli_num_rows($res);

          //Create Serial Number Variable and assign value as 1  
          $num=1;
                
          if($count>0)                
          {          
            while($rows=mysqli_fetch_assoc($res))
            {                                    
              $id=$rows['id'];              
              $Username=$rows['username'];              
              $Title=$rows['title'];             
        ?>

				<tr>
					<td><?php echo $num++?>.</td>
					<td><?php echo $Username; ?></td>
					<td width="18%"><?php echo $Title; ?></td>
					<td>
						<a href="update_admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
						<a href="delete_admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
					</td>
				</tr>

				<?php 
            }   
          }             
          else            
          { 
            echo "<tr> <td colspan='4' class='error'> Admin not Added Yet. </td> </tr>";           
          }                       
        }
           
        ?>


			</table>

		</div>
	</div>

	<br><br>
  
	<?php include('partials/admin_footer.php'); ?> <!-- Use footer -->
  
  
  
