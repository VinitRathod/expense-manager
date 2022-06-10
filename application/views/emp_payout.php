<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock" style="width:100%">
	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold ml-5" style="font-size: 20px">
			Employee Payout
		</h2>
		<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#EPModal">
			Add New Payout
		</button>
	</div>

	<div class="container">
		<br />

		<!-- Modal -->
		<div class="modal fade" id="EPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Employee Payout</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form action="#" onsubmit="return validation()" class="bg-light" name="add_name" id="add_name">
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
							

							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
						</form>





					</div>

				</div>
			</div>
		</div>
		<!-- modal end  -->

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