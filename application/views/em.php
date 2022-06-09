<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
	<h1 class="text-green text-center font-weight-bold" style="font-size: 40px">
		Expense Management System
	</h1>

	<h4 class="text-blue text-center font-weight-bold" style="font-size: 20px">
		Employee Management
	</h4>

	<div class="container">
		<br />

		<div class="col-lg-5 m-auto d-block">
			<form action="<?php echo base_url(); ?>add" method="post" onsubmit="return validation()" class="bg-light">
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


				<!-- ...  -->

				<div class="form-group" id="formField"></div>

				<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
				<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
			</form>

			<br /><br />
		</div>
	</div>

	<script type="text/javascript">
		function validation() {

		}
	</script>
</body>

</html>