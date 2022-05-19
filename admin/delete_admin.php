<?php
include('partials/admin_constants.php');
//Include constants.php file here

// 1. get the ID of Admin to be deleted
$id = $_GET['id'];

//2. Create SQL Query to Delete Admin
$sql = "DELETE FROM ll_admin WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if($res==true)
{
 //Query Executed Successully and Admin Deleted
 $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";

 //Redirect to Manage Admin Page
  header('location:Manage_Admins.php');
}
else
{
 //Failed to Delete Admin
 $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";

 header('location:Manage_Admins.php');
}
   
?>
