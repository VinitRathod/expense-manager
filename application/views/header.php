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
	<!-- Font Awesome JS -->
	<script src="https://kit.fontawesome.com/7f3d017f41.js" crossorigin="anonymous"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<!-- Sweet Alert CDN -->
	<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="<?php echo base_url(); ?>assets/sidebar.js"></script>




</head>

<body>
	<nav id="top-nav" class="navbar navbar-expand-lg mb-2">
		<a id="top-nav1" class="navbar-brand ml-4 " href="#">
			<h2><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Expense Management System</h2>
		</a>
		<a class="btn btn-light mr-4" id="Logout-x" href="<?php echo base_url(); ?>LoginController/logout" role="button"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;LOGOUT</a>
	</nav>


	<!-- ... -->
	<div style="display:flex;">
		<div class="sidebar pt-3" style="padding-left:20px;">
			<div id="sidebar" class="w3-bar-block">
				<a href="<?php echo base_url(); ?>" id="side-select1" class="w3-bar-item w3-button-x"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a>
				<a href="<?php echo base_url(); ?>EmployeesManagement/empManagement" id="side-select2" class="w3-bar-item w3-button-x"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;&nbsp;Employee Management</a>
				<a href="<?php echo base_url(); ?>VendorManagement/venManagement" id="side-select3" class="w3-bar-item w3-button-x"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;&nbsp;Vendor Management</a>
				<a href="<?php echo base_url(); ?>VendorPayout/venPayout" id="side-select4" class="w3-bar-item w3-button-x"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;&nbsp;Vendor Payout</a>
				<a href="<?php echo base_url(); ?>EmployeesManagement/empPayout" id="side-select5" class="w3-bar-item w3-button-x"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;&nbsp;Employee Payout</a>
				<a href="<?php echo base_url(); ?>ExpenseManagement/expManagement" id="side-select6" class="w3-bar-item w3-button-x"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;Expense Management</a>
				<a href="<?php echo base_url(); ?>UserManagement/usrManagement" id="side-select7" class="w3-bar-item w3-button-x"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;&nbsp;User Management</a>
			</div>
		</div>

		<script>
			const url = window.location.href;
			if (url.includes("dashboard")) {
				console.log(url);
				let element = document.querySelector('#side-select1')
				console.log(element);
				element.classList.add("active");
			}
			if (url.includes("empManagement")) {
				console.log(url);
				let element = document.querySelector('#side-select2')
				console.log(element);
				element.classList.add("active");
			}
			if (url.includes("venManagement")) {
				console.log(url);
				let element = document.querySelector('#side-select3')
				console.log(element);
				element.classList.add("active");
			}
			if (url.includes("venPayout")) {
				console.log(url);
				let element = document.querySelector('#side-select4')
				console.log(element);
				element.classList.add("active");
			}
			if (url.includes("empPayout")) {
				console.log(url);
				let element = document.querySelector('#side-select5')
				console.log(element);
				element.classList.add("active");
			}
			if (url.includes("expManagement")) {
				console.log(url);
				let element = document.querySelector('#side-select6')
				console.log(element);
				element.classList.add("active");
			}
			if (url.includes("usrManagement")) {
				console.log(url);
				let element = document.querySelector('#side-select7')
				console.log(element);
				element.classList.add("active");
			}
		</script>


</body>



</html>