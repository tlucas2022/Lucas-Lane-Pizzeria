
<?php
  
//Include Constants File
include('partials/admin_constants.php');

//Get the id and Delete 
$id = $_GET['id'];

//Delete Data from Database
$sql = "DELETE FROM ll_about WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

//Check if the data has been deleted from database
if($res==true)     
{     
    //Set success message
    $_SESSION['delete'] = "<div class='success'>Content Deleted Successfully.</div>";
            
    //Redirect to Manage About
    header('location:Manage_About.php');     
}
else
{      
    //Set Fail Message 
     $_SESSION['delete'] = "<div class='error'>Failed to Delete Content.</div>";
 
    //Redirect to Manage About    
    header('location:Manage_About.php');       
}

?>
