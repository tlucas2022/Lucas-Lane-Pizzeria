<!DOCTYPE html>
<html>

<head>
    <title> Lucas Lane Pizzeria - Home Page </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <link href= "css/info.css" rel="stylesheet"> <!-- import CSS file for order info page -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/> <!-- importing  font awesome icons -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- importing jquery -->

<style>
  
.h1top{
    font-size: 4.5em;
    font-family: "Stencil Std";
    color:red;
}

.h5top{
    font-size: 2.05em;
    font-family: "Stencil Std";
}

.btn-back{
   background-color: black;
   padding: 1.15%;
   color: white;
   text-decoration: none;
   font-weight: bold;
   font-size : 20px;
   margin: .25em;
   border-radius: 4.5px;
}

.info-table {
  margin: 1em 0;
  min-width: 300px;
}

.info-table tr {
  border: 1px solid #ddd;
  border-color: black;
}

.info-table th {
  display: none;
}

.info-table td {
  display: block;
}

.info-table td:first-child {
  padding-top: .5em;
}
  
.info-table td:last-child {
  padding-bottom: .5em;
}

.info-table td:before {
  content: attr(data-th) ": ";
  font-weight: bold;
  width: 6.5em;
  display: inline-block;
}

@media (min-width: 480px) {
  .info-table td:before {
    display: none;
  }
}

.info-table th, .info-table td {
  text-align: left;
}

@media (min-width: 480px) {
  .info-table th, .info-table td {
    display: table-cell;
    padding: .25em .5em;
  }
  
  .info-table th:first-child, .info-table td:first-child {
    padding-left: 0;
  }
  
  .info-table th:last-child, .info-table td:last-child {
    padding-right: 0;
  }
}

body {
   -webkit-font-smoothing: antialiased;
   text-rendering: optimizeLegibility;
}

h1 {
  font-weight: normal;
  letter-spacing: -1px;
  color: #34495E;
}

.info-table {
  background: #efeded;
  border-radius: .4em;
  overflow: hidden;
}

.info-table th, .info-table td {
  margin: .5em 1em;
}
  
@media (min-width: 480px) {
  .info-table th, .info-table td {
    padding: 1em !important;
  }
}
  
  .info-table th {
    color: white;
    font-size:20px;
  }

@media (max-width: 480px){
  .info-table th, .info-table td:before {
      color: black!important;
      font-size: 25px;
  }
  
  .btn-primary {
      padding: 2.5%;
      font-size: 22px;
  }
}

p {
   font-size: 26px;
   font-weight: normal;
}

</style>
  
<!-- Print only page content -->
<style type="text/css" media="print">
  .noPrint{
     display: none;
  }

</style>

</head>

<body>
  
  <div class="container-fluid p-5 bg-dark text-white text-center">
     <h class ="h1top">Lucas Lane Pizzeria</h><br>
  </div>

  <div class="main-content">
   <div class="wrapper">

    <?php
      //Get order id 
      $id=$_GET['id'];
     
      //Query to get all order information based on the id
      $sql = "SELECT o.id, o.type, o.total,
      DATE_FORMAT(o.order_date, '%c/%d/%y') AS DATE,
      TIME_FORMAT(o.order_time, '%h:%i %p') AS TIME,
      c.cust_name, c.cust_phone, c.cust_address, c.cust_email, o.status
      FROM ll_orders o, ll_customer c
      WHERE c.cust_id = o.cust_id  AND o.id = $id
      ORDER BY o.id DESC";

      //Execute Query
      $res = mysqli_query($conn, $sql);

      //Count Rows
      $count = mysqli_num_rows($res);
     
      //If there are any results, retrieve values
      if($count>0)
      {
        $row=mysqli_fetch_assoc($res);
        $id = $row['id'];
        $type = $row['type'];
        $date = $row['DATE'];
        $time = $row['TIME'];
        $total = $row['total'];
        $cust_name = $row['cust_name'];
        $cust_phone = $row['cust_phone'];
        $cust_address = $row['cust_address'];
        $cust_email = $row['cust_email'];
        $status = $row['status'];
      }
        else
        {
           //redirect to order tracker with session message
           $_SESSION['no_order'] = "<div class='error'>Order not Found.</div>";
           header('location:order_tracker.php');
        }

    ?>

    <h1 class="order">ORDER #<?php echo $id;?>  (<?php echo $type;?>)</h1>

    <br>
    
    <div class="top"><br>
     <h2>Order Info</h2>
     <div class="Info">
        <p2>Order Date: <?php echo $date;?></p2><br>
        <br><p2>Time: <?php echo $time;?></p2>
     </div>
    </div>

    <br><br><br>

    <div id="bot">
      <table class="info-table">
         <tr class="heading">
            <th class="item"><h4>Item</h4></td>
            <th class="Qty"><h4>Qty</h4></td>
            <th class="hours"><h4>Price</h4></td>
            <th class="Rate"><h4>Subtotal</h4></td>
         </tr>

         <?php
           //Get The Order Details
           $id=$_GET['id'];

           $sql2= "SELECT f.product_size, f.product_name, f.product_price, oi.quantity, f.product_price*oi.quantity AS subtotal
           FROM  order_items oi, ll_food f
           WHERE oi.item_id = f.id AND oi.order_id = $id";

           //Execute Query
           $res2 = mysqli_query($conn, $sql2);

           //Count Rows
           $count2 = mysqli_num_rows($res2);

           if($count2>0)
           {
             while($row=mysqli_fetch_assoc($res2))
             {
                $size = $row['product_size'];
                $food = $row['product_name'];
                $price = $row['product_price'];
                $qty = $row['quantity'];
                $subtotal = $row['subtotal'];
                $sub += $subtotal;
         ?>

         <tr>
             <td data-th="Item"><p><?php echo $size;?> <?php echo $food;?></p></td>
             <td data-th="Qty"><p>(<?php echo $qty;?>)</p></td>
             <td data-th="Price"><p>$<?php echo $price;?></p></td>
             <td data-th="Subtotal"><p>$<?php echo $subtotal;?></p></td>

        <?php
            }
         }
        ?>
        
        </tr>
      </table>

      <?php
        // Query to get delivery fee and tax rate        
        $sql5= "SELECT * FROM fees";

        //Execute Query
        $res5 = mysqli_query($conn, $sql5);

        //Count Rows
        $count5= mysqli_num_rows($res5);

        if($count5>0)
        {
          while($row=mysqli_fetch_assoc($res5))
          {   
            $taxes= $row['tax_rate'];
            $tax += $taxes * $sub;
            $delivery = $row['delivery'];

      ?>
  
      <br><br>
      
      <p class="Rate"></p><br>
      <h4>Tax: &nbsp;$<?php echo number_format($tax,2);?></h4>

          <?php
            //Only use delivery fee if the order type is delivery             
            if ($type=="Delivery")
            {
          ?>

          <h4>Delivery Fee: &nbsp;$<?php echo $delivery;?></h4>

        <?php 
          }  
        ?>

        <h4>Total: &nbsp;$<?php echo number_format($total,2);?></h4><br>

       <?php
         }
        }
       ?>

    </div><!--End InvoiceBot--><br><br><br>

    <div class="Info">
      <h2>Customer Info</h2>
      <p>
        <?php echo $cust_name;?></br>
        <?php if ($type=="Delivery"){
            echo $cust_address;
            echo '</br>';
          }
            else{}
        ?>
        
        <?php echo $cust_email;?></br>
        <?php
            $result = sprintf("%s-%s-%s",
            substr($cust_phone, 0, 3),
            substr($cust_phone, 3, 3),
            substr($cust_phone, 6, 4));

            echo $result;?></br>
                    </p>
    </div>

    <br><br><br>

    <div id="nonPrintable">
       <button type="button" class="btn btn-primary float-end" onclick="functionPrint()">Print</button>
    </div>
   </div>
 </div>

    <br><br><br><br>

     <script>
      // Print Function       
      function functionPrint() {
        document.getElementById("nonPrintable").className += "noPrint";
        window.print();
    }
  </script>

</body>

</html>
