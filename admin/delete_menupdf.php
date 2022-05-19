<?php 
    //Include Constants File
    include('partials/admin_constants.php');

    $id = $_GET['id'];

    $sql1= "SELECT pdf FROM ll_menu_pdf WHERE id=$id";

    //Execute the Query
    $res1 = mysqli_query($conn, $sql1);

    $count = mysqli_num_rows($res1);

    if($count>0)
    {
        $row=mysqli_fetch_array($res1);
        $filename = $row['pdf'];
        $path = "html/PDF/".$filename;

            //REmove Image File from Folder
             $remove = unlink($path);
    }
    else {}

    //SQL Query to Delete Data from Database
    $sql = "DELETE FROM ll_menu_pdf WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'>Menu PDF Deleted Successfully.</div>";\
            header('location:admin/manage_menupdf.php');
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Menu PDF Not Deleted.</div>";\
            header('location:admin/manage_menupdf.php');
        }

        
?>