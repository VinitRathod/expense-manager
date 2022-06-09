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
		Expense Management
	</h4>

	<div class="container">
		<br />

		<div class="col-lg-5 m-auto d-block">
			<form action="<?php echo base_url(); ?>addExpCat" onsubmit="return validation()" class="bg-light" method="post">
				<div class="form-group">
					<label for="expid" class="font-weight-regular"> Expense Code </label>
					<input type="text" name="expCode" class="form-control" id="expCode" autocomplete="off" required />
					<span id="warnExpCode" class="text-danger font-weight-regular">

					</span>
				</div>

				<div class="form-group">
					<label for="expcode" class="font-weight-regular">
						Expense Category
					</label>
					<input type="text" name="expCat" pattern="[a-z A-Z0-9]{1,}" class="form-control" id="expCat" autocomplete="off" required />
					<span id="warnFExpCat" class="text-danger font-weight-regular">

					</span>
				</div>

				<!-- Can Be Used Later -->
				<!-- <div class="form-group">
					<label for="expcategory"> Select Expense Category :</label>
					<select id="expcategory" name="course">
						<option value="expcat1">expcat-1</option>
						<option value="expcat2">expcat-2</option>
						<option value="expcat3">expcat-3</option>
					</select>
					<span id="expCategory" class="text-danger font-weight-regular"> </span>
				</div> -->

				<div class="form-group">
					<label for="expdesc" class="font-weight-regular"> Expense Description </label>
					<br />
					<textarea id="expDesc" rows="4" cols="50" name="expDesc" required>
            		</textarea>
				</div>

				<div class="form-group">
					<label for="exptype"> Select Expense Type :</label>
					<select id="expType" name="expType">
						<option value="vendor">Vendor</option>
						<option value="employee">Employee</option>
					</select>
					<span id="warnExpType" class="text-danger font-weight-regular"> </span>
				</div>




				<!-- ...  -->



				<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
				<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
			</form>

			<br /><br />
		</div>
	</div>

	<script type="text/javascript">
		function validation() {}
	</script>
</body>

</html>