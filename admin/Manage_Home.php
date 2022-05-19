<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/admin.css" rel="stylesheet">  <!-- reference CSS file for admin pages -->


	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}

	img {
		width: 150px;
	}
	</style>

	<?php include("partials/admin_navbar.php"); ?> <!-- uses admin navigation bar -->
	<br>
  
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage User Home Page</h1>
			<br>

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
      
      <!-- Button to Add Content -->
			<a href="add_home.php" class="btn-primary"> Add Home Page</a>

			<pre></pre>
			<br><br><br>

			<table class="tbl-full">
				<tr>
					<th>ID</th>
					<th>Hours</th>
					<th>Image 1</th>
					<th>Image 2</th>
					<th>Image 3</th>
					<th>Actions</th>
				</tr>

        <?php
        
          //Query to get any home pages  
          $sql = "SELECT * FROM ll_home";
                    
          //Execute the query
          $res = mysqli_query($conn, $sql);

          //Count Rows 
          $count = mysqli_num_rows($res);
                    
          //Create Serial Number variable and set to 1                   
          $num=1;
                   
          if($count>0)
          {
           //Get the content from Database 
           while($rows=mysqli_fetch_array($res))
           {              
             //get the values from individual columns
              $id=$rows['id'];
              $hours=$rows['hours'];
              $img_one = $rows['image_one'];
              $img_two = $rows['image_two'];
              $img_three = $rows['image_three'];
          ?>

				<tr>
					<td width="4.5%"><?php echo $num++; ?>. </td>
					<td width="19.5%"><?php echo $hours; ?></td>
					<td width="17%"><?php echo "<img src='../Images/".$img_one."' >";?></td>
					<td width="17%"><?php echo "<img src='../Images/".$img_two."' >";?></td>
					<td width="17%"><?php echo "<img src='../Images/".$img_three."' >";?></td>

					<td>
						<a href="update_home.php?id=<?php echo $id; ?>" class="btn-secondary">Update Page</a>
						<a href="delete_home.php?id=<?php echo $id; ?>" class="btn-danger">Delete Page</a>
					</td>
				</tr>

				<?php
           }           
          }           
          else         
          {            
            //Page not Added in Database                        
            echo "<tr> <td colspan='7' class='error'> Page not Added Yet. </td> </tr>";                   
          }
              
        ?>

			</table>

			<br><br>

		</div>

	</div>

	<br><br>
  
	<?php include('partials/admin_footer.php'); ?><!-- use footer -->
  
