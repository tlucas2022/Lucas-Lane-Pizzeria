<?php

//Include Constants File
include('partials/admin_constants.php');

//Get the Value and Delete
$id = $_GET['id'];

//Delete Data from Database
$sql = "DELETE FROM ll_contact WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

//Check if the data has been deleted from database 
if($res==true)
{
    //Set Success Message
    $_SESSION['delete'] = "<div class='success'>Content Deleted Successfully.</div>";

    //Redirect to Manage Contact    
    header('location:Manage_Contact.php');       
}       
else 
{   
    //Set Fail Message
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Content.</div>";

    //Redirect to Manage Contact
    header('location:Manage_Contact.php');       
}

?>
