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

	.tbl-full th,
	.tbl-full td {
		text-align: center;
	}

	.tbl-full tr th:nth-child(1) {

		text-align: left;
	}

	.tbl-full tr td:nth-child(1) {

		text-align: left;
	}

	.tbl-full tr td:nth-child(2) {

		text-align: left;
	}
	</style>

  <?php include('partials/admin_navbar.php'); ?> <!-- uses admin navigation bar -->


	<div class="main-content">
		<div class="wrapper">
			<br>
			<h1>Order Information</h1>

			<br><br><br>

			<?php

            //Check whether id is set or not
            if(isset($_GET['id']))
            {
                //Get the Order Details
                $id=$_GET['id'];

                // Query to get the order details
                $sql = "SELECT o.id, o.type,
                DATE_FORMAT(o.order_date, '%c/%d/%y') AS DATE,
                TIME_FORMAT(o.order_time, '%h:%i %p') AS TIME,
                c.cust_name, c.cust_phone, c.cust_address, o.status
                FROM ll_orders o, ll_customer c
                WHERE c.cust_id = o.cust_id AND o.id=$id
                ORDER BY o.id DESC";

                //Execute Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                $num=1;

                if($count>0)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $type = $row['type'];
                    $date = $row['DATE'];
                    $time = $row['TIME'];
                    $cust_name = $row['cust_name'];
                    $cust_phone = $row['cust_phone'];
                    $cust_address = $row['cust_address'];
                    $status = $row['status'];

                }
                else
                {
                    //Order not found
                    //Redirect to Manage Order
                    header('location:Manage_Orders.php');
                }
            }
            else
            {
                //Redirect to Manage order
                header('location:Manage_Orders.php');
            }

        ?>

			<table class="tbl-order">
				<tr>
					<th>Type</th>
					<th>Order Date</th>
					<th>Customer Name</th>
					<th>Phone #</th>

					<?php if ($type=="Delivery"){ echo '<th>Address</th>';}else{}?>
				</tr>


				<tr>
					<td width="20%" style="font-size: 22px!important;"><b><?php echo $type; ?></b></td>
					<td><b><?php echo $date.' - '.$time; ?></b></td>
					<td><b><?php echo $cust_name; ?></b></td>

					<?php
                    $result = sprintf("%s-%s-%s",
                        substr($cust_phone, 0, 3),
                        substr($cust_phone, 3, 3),
                        substr($cust_phone, 6, 4));

              ?>
					<td><b><?php echo $result; ?></b></td>

					<?php if ($type=="Delivery"){echo '<td><b>';
                                                echo $cust_address;
                                                echo '</b></td>';}else{}?>
				</tr>
			</table>

			<br><br><br><br>


			<table class="tbl-full">
				<tr>
					<th>#</th>
					<th>Food Item(s)</th>
					<th>Size</th>
					<th>QTY</th>
				</tr>
				<?php
                    //Get the Order Details
                    $id=$_GET['id'];

                    $sql2= "SELECT f.product_size, f.product_name, oi.quantity
                    FROM  order_items oi, ll_food f
                    WHERE oi.item_id = f.id AND oi.order_id = $id";

                     //Execute Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Count Rows
                    $count2 = mysqli_num_rows($res2);

                    $num=1;

                    if($count2>0)
                    {
                        while($row=mysqli_fetch_assoc($res2))
                        {
                            $size = $row['product_size'];
                            $food = $row['product_name'];
                            $qty = $row['quantity'];

                        ?>

				<tr>
					<td width="5%"><?php echo $num++; ?>. </td>
					<td width="45%"><b><?php echo $food; ?> </b></td>
					<td width="13%"><b><?php echo $size; ?></b></td>
					<td width="14%"><b><?php echo $qty; ?></b></td>
					<?php
                        }
                    }
                ?>

				</tr>

			</table>

			<br><br><br><br>

			<a href="Manage_Orders.php" class="btn-back">&laquo; Back </a><!-- back button -->

		</div>
	</div>

	<?php include('partials/admin_footer.php'); ?> <!-- use footer -->
