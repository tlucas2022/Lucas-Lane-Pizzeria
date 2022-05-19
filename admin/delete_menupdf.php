<?php

//Include Constants File
include('partials/admin_constants.php');

$id = $_GET['id'];

// Query to find the pdf
$sql1= "SELECT pdf FROM ll_menu_pdf WHERE id=$id";

//Execute the Query
$res1 = mysqli_query($conn, $sql1);

// Count Rows    
$count = mysqli_num_rows($res1);

if($count>0)
{
    $row=mysqli_fetch_array($res1);
    $filename = $row['pdf'];
    $path = "../PDF/".$filename;

    //REmove Image File from Folder
    $remove = unlink($path);
}
else {}

//SQL Query to Delete PDF from Database
$sql = "DELETE FROM ll_menu_pdf WHERE id=$id";

//Execute the Query
$res = mysqli_query($conn, $sql);

if($res==true)
{            
    //PDF Deleted
     $_SESSION['delete'] = "<div class='success'>Menu PDF Deleted Successfully.</div>";\
 
    //Redirect to Manage Menu PDF  
    header('location:manage_menupdf.php');  
}      
else
{   
    //Failed to Delete PDF 
    $_SESSION['delete'] = "<div class='error'>Menu PDF Not Deleted.</div>";\
    
    //Redirect to Manage Menu PDF         
    header('location:manage_menupdf.php');
}

?>
