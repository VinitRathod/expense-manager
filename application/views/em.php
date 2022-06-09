<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/stylesheet.css">


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
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:5em;">
		<a class="navbar-brand" href="#">
			<h2>Expense Management System</h2>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav>


	<!-- ... -->
	<div style="display:flex;">
		<div class="sidebar" style="width:20%">
			<div id="sidebar" class=" w3-light-grey w3-bar-block" style="position:auto; width:100%">
				<h3 class="w3-bar-item">Menu</h3>
				<a href="<?php echo base_url(); ?>employeeManagement" class="w3-bar-item w3-button">Employee Management</a>
				<a href="<?php echo base_url(); ?>vendorManagement" class="w3-bar-item w3-button">Vendor Management</a>
				<a href="<?php echo base_url(); ?>vendorPayout" class="w3-bar-item w3-button">Vendor Payout</a>
				<a href="<?php echo base_url(); ?>employeePayout" class="w3-bar-item w3-button">Employee Payout</a>
				<a href="<?php echo base_url(); ?>expenseManagement" class="w3-bar-item w3-button">Expense Management</a>
			</div>
		</div>
		<div id="maincontent" class="contentblock" style="width:100%">

			<h2 class="text-blue text-center font-weight-bold" style="font-size: 20px">
				Employee Management
			</h2>

			<div class="container">
				<br />

				<div class="col-lg-5 m-auto d-block" style="border:1px black solid; width:70%">
					<form action="<?php echo base_url(); ?>add" method="post" onsubmit="return validation()" name="add_name" id="add_name" class="bg-light">
						<!-- <div class="form-group">
					<label class="font-weight-regular"> Employee ID </label>
					<input type="text" name="empid" class="form-control" id="empid" autocomplete="off" required />
					<span id="employeeid" class="text-danger font-weight-regular">
					</span>
				</div> -->

						<div class="form-group">
							<label for="employeename" class="font-weight-regular">
								Employee Name
							</label>
							<input type="text" name="employeename" pattern="[a-z A-Z]{3,}" class="form-control" id="employeename" autocomplete="off" required />
							<span id="EName" name="EName" class="text-danger font-weight-regular"> </span>
						</div>

						<div class="form-group">
							<label for="pan" class="font-weight-regular"> PAN Number </label>
							<input type="text" name="pan" class="form-control" id="pan" autocomplete="off" required />
						</div>

						<div class="form-group">
							<label class="font-weight-regular"> Mobile Number </label>
							<input type="number" pattern="[0-9]{10}" maxlength="10" max="9999999999" step="1" name="mobile" class="form-control" id="mobileNumber" required />
							<span id="mobileno" name="mobileno" class="text-danger font-weight-regular"> </span>
						</div>

						<div class="form-group">
							<label for="BankDetail" class="font-weight-regular"> Bank Details </label>

							<div class="table-responsive">
								<table class="table table-bordered" id="dynamic_field">
									<tr>
										<td>Bank Name : <input type="text" name="bankname[]" placeholder="Enter your Bank Name" class="form-control name_list" required="" /></td>
									</tr>
									<tr>
										<td>
											IFSC Code : <input type="text" name="ifscCode[]" placeholder="Enter your IFSC Code" class="form-control name_list" required="" /></td>
									</tr>
									<tr>
										<td>Account Number : <input type="text" name="accno[]" placeholder="Enter your Account Number" class="form-control name_list" required="" /></td>
									</tr>
									<tr>
										<td>Account Status :<input type="text" name="AccStatus[]" placeholder="Enter your Account Status" class="form-control name_list" required="" /></td>
									</tr>

								</table>
								<table>
									<tr>
										<td><button type="button" name="add" id="add" class="btn btn-success">Add More Bank </button></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label for="ContactDetail" class="font-weight-regular"> Contact Details </label>

							<div class="table-responsive">
								<table class="table table-bordered" id="dynamic_field1">
									<tr>
										<td>Name : <input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" required="" /></td>
									</tr>
									<tr>
										<td>
											Mobile Number : <input type="text" name="mobileno[]" placeholder="Enter your mobile number" class="form-control name_list" required="" /></td>
									</tr>
									<tr>
										<td>Email: <input type="email" name="email[]" placeholder="Enter your email" class="form-control name_list" required="" /></td>
									</tr>
								</table>
								<table>
									<tr>
										<td><button type="button" name="add1" id="add1" class="btn btn-success">Add Another Mobile Number </button></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="form-group">
							<label for="Designation" class="font-weight-regular">
								Designation
							</label>
							<input type="text" name="designation" pattern="[a-z A-Z]{3,}" class="form-control" id="designation" autocomplete="off" required />

						</div>
						<div class="form-group">
							<label for="Tag" class="font-weight-regular">
								Tags
							</label>
							<input type="text" name="Tags" pattern="[a-z A-Z]{1,}" class="form-control" id="Tags" autocomplete="off" required />

							<!-- ...  -->

							<div class="form-group" id="formField"></div>

							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
					</form>

					<br /><br />
				</div>

				<!-- <div class="form-group">
					<label class="font-weight-regular"> Mobile Number </label>
					<input type="number" pattern="[0-9]{10}" maxlength="10" max="9999999999" step="1" name="mobile" class="form-control" id="mobileNumber" required />
					<span id="mobileno" name="mobileno" class="text-danger font-weight-regular"> </span>
				</div> -->


				<!-- ...  -->

				<!-- <div class="form-group" id="formField"></div>

				<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
				<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" /> -->
				</form>

				<br /><br />
			</div>
		</div>

		<script type="text/javascript">
			function validation() {

			}
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				var postURL = "/addmore.php";
				var i = 1;
				//   <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>
				$('#add').click(function() {
					i++;
					$('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"> <td> Enter Your ' + i + ' Bank  Account  Details  </td></tr>',
						'<tr id="row' + i + '" class="dynamic-added"><td>Bank Name : <input type="text" name="bankname[]" placeholder="Enter your Bank Name" class="form-control name_list" required="" /></td></tr>',
						'<tr id="row' + i + '" class="dynamic-added"></tr>',
						'<tr id="row' + i + '" class="dynamic-added"><td> IFSC Code : <input type="text" name="ifscCode[]" placeholder="Enter your IFSC Code" class="form-control name_list" required="" /></td></tr>',
						'<tr id="row' + i + '" class="dynamic-added"><td>Account Number : <input type="text" name="accno[]" placeholder="Enter your Account Number" class="form-control name_list" required="" /></td></tr>',
						'<tr id="row' + i + '" class="dynamic-added"><td>Account Status : <input type="text" name="AccStatus[]" placeholder="Enter your Account status" class="form-control name_list" required="" /></td></tr>',

					);
				});

			});
		</script>
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
				var postURL = "/addmore.php";
				var i = 1;
				//   <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>
				$('#add1').click(function() {
					i++;
					$('#dynamic_field1').append('<tr id="row' + i + '" class="dynamic-added"> <td> Enter Your ' + i + ' Mobile Numbers </td></tr>',
						'<tr id="row' + i + '" class="dynamic-added"> <td>Mobile Number : <input type="text" name="mobileno[]" placeholder="Enter your mobile number"class="form-control name_list" required="" /></td></tr>',

					);
				});


			});
		</script>
</body>

</html>