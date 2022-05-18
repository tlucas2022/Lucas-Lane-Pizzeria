<?php include('partials/admin_constants.php'); ?> <!-- link to admin constants -->
<?php include('partials/login-check.php'); ?> <!-- link to login check -->

<link href= "css/navbar.css" rel="stylesheet"> <!-- link to navigation bar css file -->

</head>

<body>
    <div class="container-fluid p-5 bg-dark text-white text-center">
      <h class ="h1">Lucas Lane Pizzeria</h><br>
      <h class ="h5">Administrative Platform</h>
    </div>

    <!-- Navbar -->
    <div class="navbar navbar-expand-sm bg-danger navbar-light justify-content-center">
      <ul class="navbar-nav">

       <b>
         <li class="nav-item">
          <a class="nav-link" href="index.php">ADMIN HOME</a> </li>
       </b>

       <b>
         <li class="nav-item">
          <a class="nav-link" href="Manage_Admins.php">MANAGE ADMINS</a> </li>
       </b>

       <b>
         <li class="nav-item">
          <a class="nav-link" href="Manage_Orders.php">MANAGE ORDERS</a></li>
       </b>

       <b>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">EDITOR</a>
           <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="Manage_Home.php">HOME</a></li>
            <li><a class="dropdown-item" href="Manage_Menu.php">MENU</a></li>
            <li><a class="dropdown-item" href="Manage_About.php">ABOUT</a></li>
            <li><a class="dropdown-item" href="Manage_OLO.php">OLO</a></li>
            <li><a class="dropdown-item" href="Manage_Contact.php">CONTACT</a></li>
           </ul>
         </li>
       </b>

       <b>
        <li class="nav-item">
         <a class="nav-link" href="logout.php">LOGOUT</a></li>
       </b>

      </ul>
    </div>
    <!-- End of Navbar -->
   
   <p>  </p>
