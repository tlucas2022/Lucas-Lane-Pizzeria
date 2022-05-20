<?php

    //Include Constants File
    include('partials/admin_constants.php');

        $id = $_GET['id'];

        $sql = "SELECT type, status from ll_orders WHERE id=$id";

        //Execute query
        $res = mysqli_query($conn, $sql);

        //Count Rows 
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);
            $type = $row['type'];
            $status = $row['status'];
        }

        else{}

        if($type=="Delivery")
        {
          if($status == "Order Received")
          {
            $sql2 = "UPDATE ll_orders SET status='Preparing Order' WHERE id=$id";
          }

          elseif($status == "Preparing Order")
          {
            $sql2 = "UPDATE ll_orders SET status='Order Is On The Way' WHERE id=$id";
          }

          elseif($status == "Order Is On The Way")
          {
            $sql2 = "UPDATE ll_orders SET status='Order Delivered' WHERE id=$id";
          }

          elseif($status == "Order Delivered")
          {
            $sql2 = "UPDATE ll_orders SET status='ORDER COMPLETED' WHERE id=$id";
          }

            //Execute Query
            $res2 = mysqli_query($conn, $sql2);

            if($res2==true)
            {
              //Updated
              $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
              header('location: Manage_Orders.php');
            }
            else
            {
                //Failed to Update
                $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                header('location: Manage_Orders.php');
            }
          }

        elseif ($type=="Pickup")
        {

          if($status == "Order Received")
          {
            $sql3 = "UPDATE ll_orders SET status='Preparing Order' WHERE id=$id";
          }

          elseif($status == "Preparing Order")
          {
            $sql3 = "UPDATE ll_orders SET status='Order Is Ready For Pickup' WHERE id=$id";
          }

          elseif($status == "Order Is Ready For Pickup")
          {
            $sql3 = "UPDATE ll_orders SET status='Order Picked Up' WHERE id=$id";
          }

          elseif($status == "Order Picked Up")
          {
            $sql3 = "UPDATE ll_orders SET status='ORDER COMPLETED' WHERE id=$id";
          }

            //Execute the Query
            $res3 = mysqli_query($conn, $sql3);

            if($res3==true)
            {
              //Updated
              $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
              header('location: Manage_Orders.php');
            }
            else
            {
                //Failed to Update
                $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                header('location: Manage_Orders.php');
            }
        }

        ?>
