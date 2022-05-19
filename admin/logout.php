<?php
    //Include admin constants
    include('partials/admin_constants.php');

    //1. Destory the Session
    session_destroy(); //Unsets $_SESSION['user']

    //2. Redirect to Login Page
    header('location:login.php');

?>
