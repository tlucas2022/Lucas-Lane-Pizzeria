<!DOCTYPE html>
<html>

<head>

    <title> Lucas Lane Pizzeria - Home Page </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
  
    <link href="css/admin.css" rel="stylesheet"> <!-- import CSS file for navigation bar -->
  
    <style>
    input[type='radio'] {
        transform: scale(1.3);
    }

    h1 {
        font-size: 2.5em;
        font-family: Georgia, Times, serif;
    }

    table tr td {
        font-size: 20px;
        font-weight: bold;
        font-family: Georgia;
    }

    .error {
        font-size: 24px;
    }
    </style>

    <?php include("partials/admin_navbar.php"); ?>


    <!-- Main Section-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin Profile</h1>


            <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
            <br>

            <form action="" method="POST">

                <table class="tbl-small">
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="Username" placeholder="Enter Username"></td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="Password" placeholder="Enter Password"></td>
                    </tr>

                    <tr>
                        <td>Title:</td>
                        <td><input type="radio" name="Title" value="Owner">&nbsp; Owner &nbsp;
                            <input type="radio" name="Title" value="Employee">&nbsp; Employee
                        </td>
                    </tr>


                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin Profile" class="btn-primary">
                            <a href="Manage_Admins.php" style="text-decoration: none; color:white;"><button class="btn-cancel" style="font-size: 18px; padding: 1.9%;">
                                    Cancel </a>
                        </td>

                </table>

            </form>

        </div>
    </div>

    <?php include('partials/admin_footer.php'); ?> <!-- use footer -->

    <?php
        //Check if add button has been clicked and form is not missing any inputs

        if(!empty($_POST['Username'])&&
            !empty($_POST['Password'])&&
            !empty($_POST['Title']))
        {
          //Retrieve data from from
            $Username= $_POST['Username'];
            $Password= md5($_POST['Password']); //Password Encrypted
            $Title= $_POST['Title'];

            // Query: add profile to database
            $sql = "INSERT INTO ll_admin SET 
                username='$Username',
                password='$Password',
                title='$Title'
            ";

            //Execute           
            $res = mysqli_query($conn, $sql) or die(mysqli_error());
                      
            //DATA INSERTED                    
            $_SESSION['add'] = "<div class= 'success'>Admin Profile Added.</div>";
            
            // Redirect to Manage Admins                 
            header('location:Manage_Admins.php');           
        }           
        else          
        {               
          //NO DATA INSERTED             
          $_SESSION['add'] = "<div class= 'error'>No Admin Profile Added.</div>";    
        }

    ?>
