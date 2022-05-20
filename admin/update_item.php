<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.                                                                                                             min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.                                                                                                             bundle.min.js"></script>
	<link href="css/admin.css" rel="stylesheet">

	<?php include('partials/admin_navbar.php'); ?>
  
	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}

	img {
		width: 200px;
		height: 150px;
	}

	table tr td {
		font-size: 20px;
		font-weight: bold;
	}

	input[type="submit"],
	.btn-cancel {
		padding: 2%;
	}

	.tbl-small {
		width: 43%;
	}

	input[type="radio"] {
		transform: scale(1.3);
	}
	</style>


	<div class="main-content">
		<div class="wrapper">
			<h1>Update Food</h1>

			<br><br>


			<?php
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected Food
        $sql = "SELECT * FROM ll_food WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {

                //Get the Individual Values of Selected Food
                $row = mysqli_fetch_assoc($res);
                $food = $row['product_name'];
                $description = $row['product_desc'];
                $size = $row['product_size'];
                $price = $row['product_price'];
                $code = $row['product_code'];
                $current_category = $row['category_id'];
                $active = $row['active'];
                $current_image = $row['photo'];
           }
            else
            {
                //Redirect to Manage Food
                header('location:manage_items.php');
            }
        }
?>

 <!-- Update Form with existing values -->
			<form action="" method="POST" enctype="multipart/form-data">

				<table class="tbl-small">
					<tr>
						<td>Name:</td>
						<td><input type="text" name="food" value="<?php echo $food;                                                                                                              ?>"></td>
					</tr>

					<tr>
						<td>Description: </td>
						<td>
							<textarea name="description" cols="30" rows="4"><?php echo $description; ?></textarea>
						</td>
					</tr>

					<tr>
						<td>Size:</td>
						<td>
							<input type="text" name="size" value="<?php echo $size; ?>">
						</td>
					</tr>

					<tr>
						<td>Price: </td>
						<td>
							<input type="number" step="0.01" name="price" value="<?php echo $price; ?>">
						</td>
					</tr>

					<tr>
						<td>Code:</td>
						<td><input type="text" name="code" value="<?php echo $co                                                                                                             de; ?>"></td>
					</tr>

					<tr>
						<td>Category: </td>
						<td>
							<select name="category">

								<?php
                            //Query to Get ACtive Categories
                            $sql2 = "SELECT * FROM ll_category WHERE active='Yes                                                                                                             '";
                            //Execute the Query
                            $res2 = mysqli_query($conn, $sql2);
                            //Count Rows
                            $count2 = mysqli_num_rows($res2);

                            //Check whether category available or not
                            if($count2>0)
                            {
                                //CAtegory Available
                                while($row2=mysqli_fetch_assoc($res2))
                                {
                                    $category = $row2['category'];
                                    $category_id = $row2['id'];

                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
								<option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
								<?php
                                }
                            }
                            else
                            {
                                //CAtegory Not Available
                                echo "<option value='0'>Category Not Available.</option>";
                            }

                        ?>

							</select>
						</td>
					</tr>

					<tr>
						<td>Active: </td>
						<td>
							<input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">&nbsp; Yes &nbsp;
							<input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">&nbsp; No
						</td>
					</tr>

					<tr>
						<td>Item Photo:</td>
						<td><?php echo "<img src='../Images/".$current_image."'                                                                                                              >";?></td>
					</tr>

					<tr>
						<td></td>
						<td><input type="file" name="image"></td>
					</tr>

					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="hidden" name="current_image" value="<?php echo                                                                                                              $current_image; ?>">

							<input type="submit" name="submit" value="Update Food" class="btn-update">
							<input type="submit" name="cancel" value="Cancel" class="b                                                                                                             tn-cancel">
						</td>
					</tr>

				</table>

			</form>

			<?php


        if(isset($_POST['cancel']))
        {
            header('Location: manage_items.php');
            die('');
        }
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id = $_POST['id'];
                $food = mysqli_real_escape_string($conn, $_POST['food']);
                $description = mysqli_real_escape_string($conn, $_POST['descript                                                                                                             ion']);
                $size = $_POST['size'];
                $code = $_POST['code'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $active = $_POST['active'];
                $current_image = $_POST['current_image'];



                if(isset($_FILES['image']['name']))
                {
                  $filename = $_FILES['image']['name'];

                   if($filename != "")
                    {

                       $source_path = $_FILES['image']['tmp_name'];
                       $destination_path = "../Images/".$filename;

                        //3. Insert Into Database
                        $upload = move_uploaded_file($source_path, $destination_                                                                                                             path);

                        if($upload==false)
                        {
                            //SEt message
                           $_SESSION['upload'] = "<div class='error'>Failed to U                                                                                                             pload Image. </div>";
                            //Redirect to MAnage Page
                            header('location:manage_items.php');
                            //STop the Process
                           die();
                        }
                    }
                   else
                   {
                        $filename = $current_image;
                   }
                }
               else
               {
                  $filename = $current_image;
               }

                //4. Update the Food in Database
                $sql3 = "UPDATE ll_food SET
                    product_name = '$food',
                    product_desc = '$description',
                    product_size = '$size',
                    product_price = '$price',
                    product_code = '$code',
                    category_id = '$category',
                    active = '$active',
                    photo = '$filename'
                   WHERE id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not
               if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div class='success'>Food Updated Suc                                                                                                             cessfully.</div>";
                    header('location:manage_items.php');
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Failed to Update F                                                                                                             ood.</div>";
                    header('location:manage_items.php');
                }

            }

        ?>

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?>
