<?php
     require 'config.php'; // uses configuration page to process commands

     // Add products to cart database table
     if (isset($_POST['pid'])) {
       $pid = $_POST['pid'];
       $pname = $_POST['pname'];
       $pprice = $_POST['pprice'];
       $psize = $_POST['psize'];
       $pcode = $_POST['pcode']; // product code to differentiate products
       $pqty = $_POST['pqty'];
       $total_price = $pprice * $pqty;
       $date = date("Y-m-d");
       $user_id = session_id(); // set session id variable to differentiate carts between users

       // Query to select the right items from cart        
       $stmt = $conn->prepare('SELECT product_code, user_id FROM cart WHERE product_code=? AND user_id=?');
       $stmt->bind_param('ss',$pcode, $user_id);
       $stmt->execute(); //Execute
       $res = $stmt->get_result();
       $r = $res->fetch_assoc(); //Retrieve values and store them

       $code = $r['product_code'] ?? '';
       $user= $r['user_id'] ?? '';

        // Query to insert items into cart
        if (!$code && $user_id!=$user) {
          $query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_size,qty,total_price,product_code,user_id, date) VALUES (?,?,?,?,?,?,?,?)');
          $query->bind_param('ssssssss',$pname,$pprice,$psize,$pqty,$total_price,$pcode,$user_id,$date);
          $query->execute();

          echo '<div class="alert alert-success alert-dismissible fs-3 mt-2">
                   <button type="button" class="close" data-dismiss="alert">&times;</button>
                       <strong>Item added to your cart!</strong>
                </div>';
        }
        else {
              echo '<div class="alert alert-danger alert-dismissible fs-3 mt-2">
                   <button type="button" class="close" data-dismiss="alert">&times;</button>
                     <strong>Item already added to your cart!</strong>
                  </div>';
            }
        }

        // Get # of items in the cart
        if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
          $user_id = session_id();
          $stmt = $conn->prepare('SELECT * FROM cart WHERE user_id=?');
          $stmt->bind_param('s',$user_id);
          $stmt->execute(); //Execute
          $stmt->store_result(); //Retrieve number and store in variable
          $rows = $stmt->num_rows;

          echo $rows;
        }

        // Remove single items from cart
        if (isset($_GET['remove'])) {
          $id = $_GET['remove'];

          //Query to delete the cart item           
          $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
          $stmt->bind_param('i',$id);
          $stmt->execute(); //Execute

          $_SESSION['showAlert'] = 'block';
          $_SESSION['message'] = 'Item removed from the cart!';
          header('location:cart.php');
        }

        // Remove all items from cart
        if (isset($_GET['clear'])) {
          $user = session_id();
          $stmt = $conn->prepare('DELETE FROM cart WHERE user_id = ?');
          $stmt->bind_param('s',$user);
          $stmt->execute();
          $_SESSION['showAlert'] = 'block'; 
          $_SESSION['message'] = 'All Item removed from the cart!';
          header('location:cart.php');
        }

        // Set total price of the product in the cart table
        if (isset($_POST['qty'])) {
          $qty = $_POST['qty'];
          $pid = $_POST['pid'];
          $pprice = $_POST['pprice'];

          $tprice = $qty * $pprice;

          // Query to update cart total          
          $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
          $stmt->bind_param('isi',$qty,$tprice,$pid);
          $stmt->execute();
        }

        // Checkout and save customer info in the customers table (Pickup Orders)
        if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
              date_default_timezone_set('America/New_York');
              $name = $_POST['name'];
              $email = $_POST['email'];
              $phone = $_POST['phone'];
              $products = $_POST['products'];
              $grand_total = $_POST['total'];
              $type = $_POST['Type'];
              $pmode = $_POST['pmode'];
              $date = date("Y-m-d");
              $time = date("H:i:s");

              $data = '';

              // Query to insert customer information        
              $stmt7 = $conn->prepare('INSERT INTO ll_customer (cust_name, cust_phone, cust_email) VALUES(?,?,?)');
              $stmt7->bind_param('sss',$name, $phone, $email);
              $stmt7->execute(); //Execute

              $id = mysqli_insert_id($conn); //Retrieve the customer id 

              // Query to insert order information
              $stmt = $conn->prepare('INSERT INTO ll_orders (type, total, order_date, order_time, cust_id)VALUES(?,?,?,?,?)');
              $stmt->bind_param('sssss',$type,$grand_total,$date,$time,$id);
              $stmt->execute(); //Execute


              $id = mysqli_insert_id($conn); //Retrieve order id
              $user = session_id();
          
              // Query to select the order items and their quantities from the cart              
              $stmt5 = $conn->prepare('SELECT f.id, c.qty FROM ll_food f, cart c
              WHERE c.product_code = f.product_code AND c.user_id = ?;');
              
              $stmt5->bind_param('s',$user);
              $stmt5->execute(); //Execute
              $result5 = $stmt5->get_result();
               while ($row = $result5->fetch_assoc()) :
                 $item = $row['id'];
                 $qty = $row['qty'];

              // Query to insert order item information
              $stmt1 = $conn->prepare('INSERT INTO order_items (order_id, item_id, quantity)VALUES(?,?,?)');
              $stmt1->bind_param('sss',$id, $item, $qty);
              $stmt1->execute(); //Execute

               endwhile;

              // Query to delete the cart after order is placed          
              $stmt2 = $conn->prepare('DELETE FROM cart WHERE user_id = ?');
              $stmt2->bind_param('s',$user);
              $stmt2->execute(); //Execute

              $data .= '
      
      
    // Confirmation Page     
    <div class="wrapper">
      <br>
      
        <div class="title">
          <p class="p1">Thank You For Your Order!!!!!!</p>
        </div>
        
        <br>

        <div class="number">
          <p>Order #: 00' . $id . ' </p>
        </div>
    
        <br>

        <div style="margin-top: 20px;">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="tab"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 col-sm-offset-3 container-print">
               <div class="panel panel-dark panel-default pseudo">
                 <br>

                 <div class="panel-heading" style="text-align:center">' . $type . ' Order: ' . $name . '</div> <hr />
                 <div class="panel-body">
                   <div class="row">
                     <div class="col-sm-12 body" style="text-align:center">Items Purchased : </div>
                     <div class="col-sm-12 body" style="text-align:center">' . $products . ' </div>
                   </div>
                   <hr style="margin-left: -20px"/>

                   <div class="row" style="line-height:3;">
                     <div class="col-sm-12">
                       <div class="p5">Total: $'. number_format($grand_total,2) . '</p> </div>
                     </div>
                   </div>
        
                 </div>
               </div>
            </div>
          </div>

          <div class="space">
            <p>   </p>
          </div>
    
          <div class="info">
            <p>         </p>
            <p class="p2">Click the link below to track your order <i class="fa">&#xf078;</i></p>
          </div>
    
          <div class="text-center mt-5">
            <a href="order_tracker.php" style="text-decoration: none; padding-bottom: 50px; color: white"><button class="btn btn-primary">Track your order</a></button>
          </div>
   </div>
   ';
   
          echo $data;
          }

          // Checkout and save customer info in the customers table (Delivery Orders)
          if (isset($_POST['place']) && isset($_POST['place']) == 'orderD') {
                date_default_timezone_set('America/New_York');
                $name = $_POST['name1'];
                $email = $_POST['email1'];
                $phone = $_POST['phone1'];
                $products = $_POST['products1'];
                $grand_total = $_POST['total1'];
                $type = $_POST['Type'];
                $address = $_POST['address'];
                $pmode = $_POST['pmode1'];
                $date = date("Y-m-d");
                $time = date("H:i:s");

                $data = '';

                // Query to insert customer information
                $stmt7 = $conn->prepare('INSERT INTO ll_customer (cust_name, cust_phone, cust_email, cust_address) VALUES(?,?,?,?)');
                $stmt7->bind_param('ssss',$name, $phone, $email, $address);
                $stmt7->execute();


                $id = mysqli_insert_id($conn); // Retrieve customer id

                // Query to insert order information
                $stmt = $conn->prepare('INSERT INTO ll_orders (type, total, order_date, order_time, cust_id)VALUES(?,?,?,?,?)');
                $stmt->bind_param('sssss',$type,$grand_total,$date,$time,$id);
                $stmt->execute(); //Execute

                $id = mysqli_insert_id($conn); // Retrieve order id 
                $user = session_id();

                // Query to select cart items and their quantities 
                $stmt5 = $conn->prepare('SELECT f.id, c.qty FROM ll_food f, cart c
                WHERE c.product_code = f.product_code AND c.user_id = ?;');
                $stmt5->bind_param('s',$user);
                $stmt5->execute(); //Execute
                $result5 = $stmt5->get_result();
                  while ($row = $result5->fetch_assoc()) :
                    $item = $row['id'];
                    $qty = $row['qty'];

                // Query to insert order items information
                $stmt1 = $conn->prepare('INSERT INTO order_items (order_id, item_id, quantity)VALUES(?,?,?)');
                $stmt1->bind_param('sss',$id, $item, $qty);
                $stmt1->execute(); //Execute

                  endwhile;

                // Query to delete cart after order completion 
                $stmt2 = $conn->prepare('DELETE FROM cart WHERE user_id = ?');
                $stmt2->bind_param('s',$user);
                $stmt2->execute(); //Execute

                $data .= '

    // Confirmation Page   
    <div class="wrapper">
      <br>
        
       <div class="title">
         <p class="p1">Thank You For Your Order!!!!!!</p>
       </div>
   
       <br>

       <div class="number">
          <p>Order #: 00' . $id . ' </p>
       </div>
      
       <br>

       <div style="margin-top: 20px;">
         <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
               <div class="tab"></div>
            </div>
         </div>

         <div class="row">
           <div class="col-sm-6 col-sm-offset-3 container-print">
              <div class="panel panel-dark panel-default pseudo">
                 <br>

                 <div class="panel-heading" style="text-align:center">' . $type . ' Order: ' . $name . '</div> <hr />
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-sm-12 body" style="text-align:center">Items Purchased : </div>
                        <div class="col-sm-12 body" style="text-align:center">' . $products . ' </div>
                      </div>
                         
                      <hr style="margin-left: -20px"/>

                      <div class="row" style="line-height:3;">
                         <div class="col-sm-12">
                            <p class="p5">Total: $'. number_format($grand_total,2) . '</p>
                         </div>
                      </div>
                    </div>
                 </div>
              </div>
           </div>
         </div>

         <div class="space">
           <p>   </p>
         </div>
        
         <div class="info">
            <p>         </p>
            <p class="p2">Click the link below to track your order <i class="fa">&#xf078;</i></p>
         </div>
        
         <div class="text-center mt-5">
            <a href="order_tracker.php" style="text-decoration: none; padding-bottom: 50px; color: white"><button class="btn btn-primary">Track your order</a></button>
         </div>
    </div>
    ';
         echo $data;
         }
 ?>
