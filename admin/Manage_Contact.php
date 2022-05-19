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
	</style>

	<?php include("partials/admin_navbar.php"); ?> <!-- use navigation bar -->
	<br>


	<!-- Main Section-->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Contact Page</h1>

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

      <!-- Add Contact Page Content -->
			<a href="add_contact.php" class="btn-primary"> Add Content</a>

			<pre></pre>
			<br><br>

			<table class="tbl-full">
				<tr>
					<th>ID</th>
					<th>Address</th>
					<th>Number</th>
					<th>Email</th>
					<th>Actions</th>
				</tr>

				<?php

        //Query to get any existing contact page content         
        $sql = "SELECT * FROM ll_contact";
        $res = mysqli_query($conn, $sql);
                        
        if($res==TRUE)
        {
          $count = mysqli_num_rows($res);
                 
          if($count>0)
          {
            while($rows=mysqli_fetch_assoc($res))
            {
              $id = $rows['id'];
              $address = $rows['rest_address'];
              $phone = $rows['phone'];
              $email = $rows['email'];
              $social = $rows['social'];
              $map = $rows['map'];
        ?>
				
        <tr>
          <!-- Display content in table -->
          <td><?php echo $num++?>.</td>
					<td width="16%"><?php echo $address; ?></td>
					<td width="14%"><?php echo $phone; ?></td>
					<td><?php echo $email; ?></td>
					
          <td>
            <a href="update_contact.php?id=<?php echo $id; ?>" class="btn-secondary">Update Content</a>
            <a href="delete_contact.php?id=<?php echo $id; ?>" class="btn-danger">Delete Content</a>
					</td>
				
        </tr>
				
        <?php        
            }            
          }          
          else          
          {          
            echo "<tr> <td colspan='7' class='error'> Content not Added Yet. </td> </tr>";            
          }         
        }
     
        ?>
	
      </table>

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
  
