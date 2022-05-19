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

	iframe {
		width: 90%;
		height: 350px;
	}
	</style>

	<?php include("partials/admin_navbar.php"); ?>  <!-- use admin navigation bar -->
	<br>
  
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Menu PDF</h1>


			<?php

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['noupdate']))
                    {
                        echo $_SESSION['noupdate'];
                        unset($_SESSION['noupdate']);
                    }

                ?>

			<br><br>

			<!-- Add Menu PDF Button -->
			<a href="add_menupdf.php" class="btn-primary"> Add Menu PDF</a>

			<pre></pre>
			<br><br>


			<table class="tbl-full">
				<tr>
					<th>ID</th>
					<th>PDF </th>
					<th>Actions</th>
				</tr>

				<?php
                        
          //Query to get PDF                      
          $sql = "SELECT * FROM ll_menu_pdf";
                        
          //Execute query                        
          $res = mysqli_query($conn, $sql);

          //Count Rows       
          $count = mysqli_num_rows($res);
        
          //Create Serial Number VAriable and set value as 1
          $num=1;
        
          if($count>0)        
          {          
            //Get the pdf from Database 
            while($rows=mysqli_fetch_array($res))
            {
              //get the values from individual columns and display in table
              $id=$rows['id'];
              $pdf = $rows['pdf'];
              $path='../PDF/';       
        ?>
        
				<tr>
					<td><?php echo $num++; ?>. </td>
					<td><iframe src="<?php echo $path.$pdf; ?>"></iframe>
					</td>

					<td>
						<a href="update_menupdf.php?id=<?php echo $id; ?>" class="btn-secondary" style="font-size:20px;">Update PDF</a>
						<a href="delete_menupdf.php?id=<?php echo $id; ?>" class="btn-danger" style="font-size:20px;">Delete PDF</a>
					</td>
				</tr>

				<?php                            
            }                        
          }           
          else           
          {              
            //PDF not Added in Database                            
            echo "<tr> <td colspan='7' class='error'> PDF not Added Yet. </td> </tr>";                       
          }                   
        ?>

			</table>

			<br><br><br><br>

			<a href="Manage_Menu.php" class="btn-back">&laquo; Back </a> <!-- Back button -->

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?><!-- use footer -->
  
