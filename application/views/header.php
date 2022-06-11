<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheet.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

	<script src="https://kit.fontawesome.com/7f3d017f41.js" crossorigin="anonymous"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<!-- Sweet Alert CDN -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/sidebar.js"></script>



</head>

<body>
	<nav id="top-nav" class="navbar navbar-expand-lg mb-2  ">
		<a id="top-nav1" class="navbar-brand ml-4 " href="#">
			<h2><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Expense Management System</h2>
		</a>
	</nav>


	<!-- ... -->
	<div style="display:flex;">
		<div class="sidebar pt-3" style="padding-left:20px;">
			<div id="sidebar" class="w3-bar-block">
			<a href="<?php echo base_url(); ?>" id="side-select" class="w3-bar-item w3-button-x"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
				<a href="<?php echo base_url(); ?>employeeManagement" id="side-select" class="w3-bar-item w3-button-x"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;&nbsp;Employee Management</a>
				<a href="<?php echo base_url(); ?>vendorManagement" id="side-select" class="w3-bar-item w3-button-x"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;&nbsp;Vendor Management</a>
				<a href="<?php echo base_url(); ?>vendorPayout" id="side-select" class="w3-bar-item w3-button-x"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;&nbsp;Vendor Payout</a>
				<a href="<?php echo base_url(); ?>employeePayout" id="side-select" class="w3-bar-item w3-button-x"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;Employee Payout</a>
				<a href="<?php echo base_url(); ?>ExpenseManagement/expManagement" id="side-select" class="w3-bar-item w3-button-x"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Expense Management</a>
			</div>
		</div>

		<script>
			
		</script>
</body>

</html>