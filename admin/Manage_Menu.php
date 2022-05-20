<!DOCTYPE html>
<html>

<head>

	<title> Lucas Lane Pizzeria - Home Page </title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
	
  <link href="css/admin.css" rel="stylesheet"> <!-- reference CSS file for admin pages -->

	<style>
	h1 {
		font-size: 2.5em;
		font-family: Georgia, Times, serif;
	}
	</style>

	<?php include("partials/admin_navbar.php"); ?>  <!-- use navigation bar -->
   
	<br>
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Menu (Editor)</h1>
			<br><br><br>


			<div class="container mt-3">
				<div class="d-grid gap-5 col-6 mx-auto">
          
          <!--  Links to menu related pages -->
					<a href="manage_menuimages.php"><button type="button" class="btn btn-edit">Menu Images</button></a>
					<a href="manage_menupdf.php"><button type="button" class="btn btn-edit">Menu PDF</button></a>
				</div>
			</div>
		</div>
	</div>


	<br><br>
	<?php include('partials/admin_footer.php'); ?> <!-- use footer  -->
