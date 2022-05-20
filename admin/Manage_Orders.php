<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/admin.css" rel="stylesheet"><!-- reference CSS file for admin pages -->


	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}

	.tbl-full {
		font-size: 20px;
	}
	</style>

	<?php include("partials/admin_navbar.php"); ?><!-- use navigation bar -->

	<br>
  
	<div class="main-content">
		<div class="wrapper-order">
			<h1>Manage Orders</h1>
			<br>

			<?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
           ?>

			<br><br>

			<table class="tbl-full">
				<tr>
					<th>#</th>
					<th>Type</th>
					<th>Order Date</th>
					<th>Customer Name</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>

				<?php
                        //Get all the orders from database
                        $sql = "SELECT o.id, o.type,
                        DATE_FORMAT(o.order_date, '(%a) %c/%d/%Y') AS DATE,
                        TIME_FORMAT(o.order_time, '%h:%i %p') AS TIME,
                        c.cust_name,
                        o.status
                    FROM
                        ll_orders o,
                        ll_customer c
                    WHERE
                        c.cust_id = o.cust_id
                        AND o.status != 'ORDER COMPLETED'
                    ORDER BY
                        o.id
                    DESC "; // DIsplay the Latest Order at First

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $num = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $type = $row['type'];
                                $order_date = $row['DATE'];
                                $order_time = $row['TIME'];
                                $customer_name = $row['cust_name'];
                                $status = $row['status'];

                                ?>

				<tr>
					<td><?php echo $num++; ?>. </td>
					<td width="11%"><?php echo $type; ?></td>
					<td><?php echo $order_date.' - '.$order_time; ?></td>
					<td><?php echo $customer_name; ?></td>
					<td>

						<?php
                               // Order Status
                               if($status=="Order Received")
                               {
                                  echo "<label style='color:#F7833C; font-weight:bold;'> $status </label>";
                               }
                               
                               elseif($status=="Preparing Order")
                               {
                                  echo "<label style='color: #00AEC6; font-weight:bold;'>$status</label>";
                               }
                              
                               elseif($status=="Order Is On The Way")
                               {
                                  echo "<label style='color: #C73CF7; font-weight:bold;'>$status</label>";
                               }
                              
                               elseif($status=="Order Is Ready For Pickup")
                               {
                                  echo "<label style='color: #C73CF7; font-weight:bold;'>$status</label>";
                               }
                              
                               elseif($status=="Order Picked Up")
                               {
                                  echo "<label style='color: green; font-weight:bold;'>$status</label>";
                               }
                              
                               elseif($status=="Order Delivered")
                               {
                                  echo "<label style='color: green; font-weight:bold;'>$status</label>";
                               }
                              
                               elseif($status=="ORDER COMPLETED")
                               {
                                  echo "<label style='color: #1E57D2; font-weight:bold;'>$status</label>";
                               }
                               
            ?>
                                               
					</td>


					<td width="17%">
						<a href="update.php?id=<?php echo $id; ?>" class="btn-secondary" style="font-size:22px;padding:3%!important;">Update</a>

						<a href="view_order.php?id=<?php echo $id; ?>" class="btn-edit" style="font-size:22px;padding:3%!important;">View</a>
					</td>


				</tr>

				<?php
                            }
                        }
                        else{
                            echo "<tr><td colspan='13' class='error text-center fs-3'>No Active Orders Available</td></tr>";
                        }

                    ?>


			</table>


			<br><br><br><br>

			<a href="order_backlog.php" class="previous"> See Previous Orders </a>


		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?><!-- use footer -->
  
