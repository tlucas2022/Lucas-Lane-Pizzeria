<?php include('partials/admin_constants.php'); ?> <!-- Include admin constants -->

<!DOCTYPE html>
<html>
    
<head>
   <title> LL Pizza Admin Login </title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
  body {
    background-color: #FBEEE6;
  }

  h2 {
    color: #E6C200;
    font-size: 5.2em;
    font-family: Apple Chancery, Monotype Corsiva, cursive;
  }

  .p-5
  {   
    padding:2.5rem!important;
  }
  
  .p-4
  {
    padding:2.2rem!important;
  }

  input[type=text] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
  }

  input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
  }

  input[type=submit] {
      width: 100%;
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
  }

  input[type=submit]:hover {
      background-color: #45a049;
  }
  
  form {
    width: 30%;
    border-radius: 4px;
    background-color: #D6DDE5;
    padding: 25px;
    margin: 10% auto;
  }
  
  .text {
    font-size : 22px;
    font-weight: bold;
  }

</style>

</head>

<body>

  <div class="container-fluid p-5 bg-danger text-white text-center">
    <h2>LL Pizza Admin Platform</h2></div>
    <div class="container-fluid p-4 bg-dark"></div>

    <div>
      <?php
         if(isset($_SESSION['login']))      
         {          
           echo $_SESSION['login'];          
           unset($_SESSION['login']);                 
         }

         if(isset($_SESSION['no-login-message']))
         {
           echo $_SESSION['no-login-message'];
           unset($_SESSION['no-login-message']);
         }
      ?>

      <!-- Login Form -->
      <form action="" method="POST" class="text">
         <h1 class="text-center">Admin Panel</h1>
          <br>

          Username: <br>
          <input type="text" name="username" placeholder="Enter Username"><br><br>

          Password: <br>
          <input type="password" name="password" placeholder="Enter Password"><br><br>

          <input type="submit" name="submit" value="Login" class="btn-login" >
           
      </form><!-- Login Form Ends -->
  </div>
  
  </body>
</html>

<?php

    //Check if the submit button is clicked
    if(isset($_POST['submit']))
    {       
      //1. Get the Data from Login form     
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $raw_password = md5($_POST['password']);
      $password = mysqli_real_escape_string($conn, $raw_password);

      //2. Query to check if the username and password exists
      $sql = "SELECT * FROM ll_admin WHERE username='$username' AND password='$password'";
        
      //3. Execute the Query
      $res = mysqli_query($conn, $sql);

      //4. Count rows 
      $count = mysqli_num_rows($res);

      if($count==1)
      {
        //User Found, Login Success
        $_SESSION['login'] = "<div class='success text-center fs-1 fw-bold text-success'>Welcome Admin!!</div>";
        $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

        //Redirect to Home Page/Dashboard
        header('location:index.php');
      }
      else
      {
        //User not found
        $_SESSION['login'] = "<div class='error text-center fs-3 text-danger'>Username or Password did not match.</div>";

        //Redirect to Home Page/Dashboard
        header('location:login.php');
        }
    }

?>
