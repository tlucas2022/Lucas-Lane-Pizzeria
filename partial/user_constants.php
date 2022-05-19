<?php include "../inc/dbinfo.inc"; ?> <!-- use connection file -->

<?php
    //Start Session
    ob_start();
    session_start();

 /* Connect to MySQL and select the database. */
 $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

 if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

 $database = mysqli_select_db($conn, DB_DATABASE);

?>
