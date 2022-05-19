<?php

//Include Constants File
include('partials/admin_constants.php');

//Get the id and Delete
$id = $_GET['id'];
        
//Delete Data from Database
$sql = "DELETE FROM fees WHERE id=$id";
      
//Execute the Query
$res = mysqli_query($conn, $sql);

//Check if the data has been deleted from database 
if($res==true)
{
    //Set Success Message 
    $_SESSION['delete'] = "<div class='success'>Fees Deleted Successfully.</div>";

    //Redirect to Manage Fees  
    header('location:manage_fees.php');
}
else
{
    //Set Fail Message 
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Fees.</div>";

    //Redirect to Manage Fees
    header('location:manage_fees.php');       
}

?>
