<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheet.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<!-- jQuery CDN - Slim version (=without AJAX) -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


</head>

<body>
	<nav id="top-nav" class="navbar navbar-expand-lg navbar-light bg-light ">
		<a class="navbar-brand" href="#"> <h2>Expense Management System</h2></a>
	</nav>


	<!-- ... -->
	<div style="display:flex;">
		<div class="sidebar"  >
			<div id="sidebar" class=" w3-light-grey w3-bar-block"  >
				<h3 class="w3-bar-item">Menu</h3>
				<a href="<?php echo base_url(); ?>employeeManagement" class="w3-bar-item w3-button">Employee Management</a>
				<a href="<?php echo base_url(); ?>vendorManagement" class="w3-bar-item w3-button">Vendor Management</a>
				<a href="<?php echo base_url(); ?>vendorPayout" class="w3-bar-item w3-button">Vendor Payout</a>
				<a href="<?php echo base_url(); ?>employeePayout" class="w3-bar-item w3-button">Employee Payout</a>
				<a href="<?php echo base_url(); ?>expenseManagement" class="w3-bar-item w3-button">Expense Management</a>
			</div>
		</div>

		</body>

</html>