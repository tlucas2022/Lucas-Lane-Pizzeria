<?php 
    //Include Constants File
    include('partials/admin_constants.php');

    //echo "Delete Page";

        //Get the Value and Delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];


        //Delete Data from Database
        //SQL Query to Delete Data from Database
        $sql = "DELETE FROM ll_food WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res==true)
        {
            //SEt Success MEssage and REdirect
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            //Redirect to Manage Food
            header('location:admin/manage_items.php');
        }
        else
        {
            //SEt Fail MEssage and Redirecs
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            //Redirect to Manage Food
            header('location:admin/manage_items.php');
        }

 

  
?>