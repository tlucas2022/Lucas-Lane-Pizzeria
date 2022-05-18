<?php
    //Query to select admin profiles
    $sql = "SELECT * FROM ll_admin";

    //Execute
    $res = mysqli_query($conn, $sql);

    //Count Rows
    $count = mysqli_num_rows($res);

    //If there are any results, check session
    if($count>0) {

      //Authorize admin profile Check if user is logged in or not
      if(!isset($_SESSION['user'])) {

         //User not logged in--Redirect to login page
        $_SESSION['no-login-message'] = "<div class='error text-center fs-3 text-primary'>Please login to access Admin Platform.</div>";

        //Redirect to Login Page
        header('location:login.php');
      }

      else {}
      //Login

    }
?>
