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
		Employee Payout
	</h4>

	<div class="container">
		<br />

		<div class="col-lg-5 m-auto d-block">
			<form action="#" onsubmit="return validation()" class="bg-light">
				<div class="form-group">
					<label for="bulkupload" class="font-weight-regular">
						Bulk Upload
					</label>
					<input type="file" name="bulkupload" class="form-control" id="bulkupload" accept="application/xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required />
				</div>

				<div class="form-group">
					<label class="font-weight-regular"> Employee ID </label>
					<input type="text" name="empid" class="form-control" id="empid" autocomplete="off" required />
					<span id="employeeid" class="text-danger font-weight-regular">
					</span>
				</div>

				<div class="form-group">
					<label for="employeename" class="font-weight-regular">
						Employee Name
					</label>
					<input type="text" name="employeename" pattern="[a-z A-Z]{3,}" minlength="3" class="form-control" id="employeename" autocomplete="off" required />
					<span id="EName" class="text-danger font-weight-regular"> </span>
				</div>

				<div class="form-group">
					<label for="category" class="font-weight-regular">
						Expense category :
					</label>
					<select id="category" name="course" required>
						<option value="sal">SALARY</option>
						<option value="other">OTHER</option>
					</select>
				</div>

				<div class="form-group">
					<label for="amount" class="font-weight-regular"> Amount </label>
					<input type="number" name="amount" class="form-control" id="amount" min="0" autocomplete="off" required />
					<span id="amount-s" class="text-danger font-weight-regular"> </span>
				</div>

				<div class="form-group">
					<label class="font-weight-regular"> Payment Due Date</label>
					<input type="date" name="paydd" class="form-control" id="paydd" autocomplete="off" required />
					<span id="paymentdd" class="text-danger font-weight-regular">
					</span>
				</div>

				<div class="form-group">
					<label class="font-weight-regular"> Payment Mode</label><br />
					<input class="ml-3" type="radio" id="manual" name="fav_language" value="manual" />
					<label for="manual">Manual</label><br />
					<input class="ml-3" type="radio" id="schedule" name="fav_language" value="schedule" />
					<label for="schedule">Scheduled</label><br />
				</div>

				<!-- ....  -->



				<div class="form-group" id="formField"></div>

				<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
				<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
			</form>

			<br /><br />
		</div>
	</div>

	<script type="text/javascript">
		function validation() {
			var ename = document.getElementById("employeename").value;
			var mobileNumber = document.getElementById("mobileNumber").value;
			var amount = document.getElementById("amount").value;

			if (ename == "") {
				document.getElementById("EName").innerHTML =
					" ** Please fill the Name field";
				return false;
			}

			if (amount == "") {
				document.getElementById("amount-s").innerHTML =
					" ** Please fill the amount field";
				return false;
			}

			if (mobileNumber == "") {
				document.getElementById("mobileno").innerHTML =
					" ** Please fill the mobile NUmber field";
				return false;
			}

			if (isNaN(mobileNumber)) {
				document.getElementById("mobileno").innerHTML =
					" ** user must write digits only not characters";
				return false;
			}
			if (mobileNumber.length != 10) {
				document.getElementById("mobileno").innerHTML =
					" ** Mobile Number must be 11 digits only";
				return false;
			}
		}
	</script>
</body>

</html>