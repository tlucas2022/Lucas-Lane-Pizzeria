<!DOCTYPE html>
<html> 
  
<head>
  <title> Lucas Lane Pizzeria - Home Page </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta http-equiv="refresh" content="10"> <!-- Page refresh every 10 seconds -->
         
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/> <!-- import font awesome icons -->
        
  <link href= "css/index.css" rel="stylesheet"> <!-- import CSS file for index page -->

</head>
  
  <?php include("partials/admin_navbar.php"); ?> <!-- uses navigation bar -->

  <?php
  
  if(isset($_SESSION['login']))
  {    
    echo $_SESSION['login'];
    unset($_SESSION['login']);
  }

  //Query to Get all active orders
  $sql = "SELECT COUNT(*) AS Active_Orders FROM ll_orders WHERE status != 'ORDER COMPLETED'";

  //Execute Query
  $res = mysqli_query($conn, $sql);

  $count = mysqli_num_rows($res);

  if($count>=0)
  {
    while($row=mysqli_fetch_assoc($res))
    {
      $active = $row['Active_Orders'];
    }
  }
  else
  {}

  //Query to Get all complete orders
  $sql2= "SELECT COUNT(*) AS Total_Orders FROM ll_orders WHERE status = 'ORDER COMPLETED'";

  //Execute Query
  $res2 = mysqli_query($conn, $sql2);

  $count2 = mysqli_num_rows($res2);

  if($count2>=0)
  {
    while($row=mysqli_fetch_assoc($res2))
    {
      $orders = $row['Total_Orders'];
    }
  }
  else
  {}

  //Query to Get revenue
  $sql3 = "SELECT SUM(total) AS Revenue FROM ll_orders";

  //Execute Query
  $res3 = mysqli_query($conn, $sql3);

  if($res3==true)
  {
    while($row=mysqli_fetch_assoc($res3))
    {
      $revenue = $row['Revenue'];
    }
  }
  else
  {}

  //Query to Get order types
  $sql4 = "SELECT type, count(*) as number FROM ll_orders GROUP BY type";

  //Execute Query
  $res4 = mysqli_query($conn, $sql4);

  ?>

  <br>

  <div class="main-content">
    <div class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <div class="page-header">Dashboard</div>
        </div><!-- /.col-lg-12-->
      </div><!-- /.row-->

      <!-- Active Orders -->
      <div class="row">
        <div class="col-lg-6 col-md-5">
          <div class="card bg-warning text-white">
            <div class="card-header">
              <div class="row">
                <div class="col-sm-6">
                  <div class="active-orders left"><?php echo $active; ?></div>
                  <div class="active-text left">Active Orders</div>
                </div>

                <div class="col-xs-9">
                  <div class="active-icon right">
                    <i class="fa-solid fa-utensils"></i>
                  </div>
                </div>
              </div><br>
            </div>

            <a class="active" href="Manage_Orders.php">
             
              <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="left-text">View Active Orders</span>
                <span class="right-text">
                  <i class="fas fa-angle-right" style="font-size:28px; color:#f80;"></i>
                </span>
              </div>
            </a>
          </div>
        </div>
        
        <!-- Completed Orders -->
        <div class="col-lg-6 col-md-6">
          <div class="card bg-success text-white">
            <div class="card-header"><pre></pre>
              <div class="row">
                <div class="col-md-3">
                  <div class="orders left"><?php echo $orders; ?></div>
                  <div class="completed left">Completed Orders</div>
                </div>

                <div class="col-xs-9">
                  <div class="completed-icon right">
                     <i class="fa-solid fa-clipboard-check"></i>
                   </div>
                </div>
              </div><pre></pre>
            </div>

            <a class="complete" href="order_backlog.php">

              <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="left-text">View Completed Orders</span>
                <span class="right-text">
                  <i class="fas fa-angle-right" style="font-size:28px; color:#25a543;"></i>
                </span>
              </div>
            </a>
          </div>
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-lg-12">
          <div class="page-subheader">Analytics</div>
        </div><!-- /.col-lg-12-->
      </div><!-- /.row-->

      <br><br>

      <!-- Order Revenue -->
      <div class="col-lg-5 col-md-3-money">
        <div class="card bg-purple text-white">
          <div class="card-header">
            <div class="row">
              <div class="col-md-3-rev">
                <pre></pre>

                <div class="money left">$<?php echo $revenue; ?></div>
                 <div class="revenue left">Total Revenue</div>
               </div>
 
               <div class="col-xs-9">
                 <div class="revenue-icon right">
                   <pre></pre>
                   <i class="fa-solid fa-money-bill-1-wave"></i>
                 </div>
              </div>
            </div><br>
          </div>

          <div class="card-footer d-flex align-items-center justify-content-between">
            <pre></pre>
          </div>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-subheader">Order Breakdown</h1>
        </div><!-- /.col-lg-12-->
      </div><!-- /.row-->

      <br><br>

      <!-- Order Type Piechart -->
      <div id="piechart"></div>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
       
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Type', 'Total'],
        <?php
        while($row=mysqli_fetch_array($res4))
        {
            echo "['".$row["type"]."', ".$row["number"]."],";
        }
        ?>

        ]);


        
          // Optional; add a title and set the width and height of the chart
          var options = {'title':'% of Total Orders',
                          titleTextStyle: {fontSize: 14, bold:true},
                         'width':600,
                         'height':450,
                          pieHole: 0.5,
                          colors: ['#F47005', '#05C8F4'],
                          backgroundColor: '#fdf9f7',
                          'chartArea': {'width': '95%', 'height': '92%'},
                          slices: { 1: {offset: 0.01}, 0: {offset: 0.01}},
                          legend: {position: 'right', alignment: 'start', textStyle: {color: 'black', fontSize: 22}},
                          pieSliceTextStyle: {color : 'black', fontSize: 21, bold:true}
                        };
    
          // Display the chart inside the <div> element with id="piechart" 
          var chart = new google.visualization.PieChart(document.getElementById('piechart')); 
          chart.draw(data, options);
        }
        
      </script>
    
    </div>
  </div>
    
  <?php include('partials/admin_footer.php'); ?>  <!-- use footer -->
