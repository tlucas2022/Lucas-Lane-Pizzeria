<!DOCTYPE html>
<html>

<head>
	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/backlog.css" rel="stylesheet"><!-- reference CSS file for admin pages -->
	
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /><!-- import font awesome icons -->
  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	<?php include("partials/admin_navbar.php"); ?> <!-- use navigation bar -->
	<br>

	<div class="main-content">
		<div class="wrapper">

			<?php
                if(isset($_SESSION['no_order']))
                {
                    echo $_SESSION['no_order'];
                    unset($_SESSION['no_order']);
                }
           ?>

			<!-- Datatable plugin CSS file -->
			<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

			<!-- jQuery library file -->
			<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>

			<!-- Datatable plugin JS library file -->
			<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
</head>

<body>
	<br>
	<h2>Online Order Backlog</h2>

	<br>

	<!--HTML table with order data-->
	<table id="tableID" class="display table-bordered" style="width:99%">
		<thead class="table-dark">
			<tr>
				<th>Order #</th>
				<th>Type</th>
				<th>Date/Time</th>
				<th>Customer</th>
				<th>Total</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>

			<?php

            $sql = "SELECT o.id, o.type, o.total,
            DATE_FORMAT(o.order_date, '%c/%d/%Y') AS Date,
            TIME_FORMAT(o.order_time, '%h:%i %p') AS Time,
            c.cust_name
            FROM ll_orders o, ll_customer c
            WHERE c.cust_id = o.cust_id AND o.status = 'ORDER COMPLETED'
            ORDER BY o.id DESC";

            //Execute query
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $type = $row['type'];
                    $date = $row['Date'];
                    $time = $row['Time'];
                    $cust_name = $row['cust_name'];
                    $total=$row['total'];
                ?>

			<tr>
				<td class="info" width="10%"><?php echo $id; ?></td>
				<td class="info"><?php echo $type;?></td>
				<td class="info" width="25%"><?php echo $date.' - '.$time; ?></td>
				<td class="info"><?php echo $cust_name; ?></td>
				<td class="info">$<?php echo $total;?></td>
				<td width="14%">

					<a href="order_info.php?id=<?php echo $id;?>" target="_blank" rel="noopener noreferrer" class="btn btn-more float-center">
						View Order Info</a>
				</td>
			</tr>

			<?php
                }
            }

            else
            {
                echo "<tr> <td colspan='6' class='error text-center'> No Completed Orders.</td> </tr>";
            }

        ?>

		</tbody>
		<br>
	</table>

	<br><br><br><br>

	<a href="index.php" class="btn-back">&laquo; Back To Home</a> <!-- Back button -->
	<br><br>

	<script>
	/* Initialization of datatable */
	$(document).ready(function() {
		$('#tableID').DataTable({});
	});
	</script>

	</div>
	</div>

	<?php include('partials/admin_footer.php'); ?>  <!--  use footer  -->
	</div>
