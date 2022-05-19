<?php
    
//Include Constants File
include('partials/admin_constants.php');

//Get the Value and Delete
$id = $_GET['id'];

//Delete Data from Database
$sql = "DELETE FROM ll_food WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

if($res==true)      
{          
    //Set Success Message 
    $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            
    //Redirect to Manage Items   
    header('location:manage_items.php');      
}       
else 
{
    //Set Fail Message 
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            
    //Redirect to Manage Items
    header('location:manage_items.php');        
}

?>
