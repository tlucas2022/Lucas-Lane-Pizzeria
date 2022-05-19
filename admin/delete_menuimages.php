<?php
    
//Include Constants File
include('partials/admin_constants.php');
    
$id = $_GET['id'];
$filename = $_GET['filename'];

$path = "../Images/".$filename;
            
//REmove Image File from Folder
$remove = unlink($path);
    
//SQL Query to Delete Data from Database
$sql = "DELETE FROM ll_menu WHERE id=$id";
    
//Execute the Query
$res = mysqli_query($conn, $sql);

if($res==true)
{        
    //Image Deleted
    $_SESSION['delete'] = "<div class='success'>Menu Image Deleted Successfully.</div>
            
    //Redirect to Manage Menu Images      
    header('location:manage_menuimages.php');    
}
        
 else
 {
     //Failed to Delete Food
     $_SESSION['delete'] = "<div class='error'>Menu Image Not Deleted.</div>";\
    
    //Redirect to Manage Menu Images     
    header('location:manage_menuimages.php');  
 }

?>
