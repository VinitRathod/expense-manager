<?php
defined('BASEPATH') or exit('No direct script access allowed');
$csrf = array(
	'name' => $this->security->get_csrf_token_name(),
	'value' => $this->security->get_csrf_hash(),
);
?>
<div id="maincontent" class="contentblock mr-4" style="width:80vw">
	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold " style="font-size: 20px">
			Employee Payout
		</h2>
		<button type="button" class="btn btn-x mr-5" data-toggle="modal" data-target="#EPModal">
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

						<form onsubmit="return validation()" class="bg-light" name="addEmpPay" id="addEmpPay">
							<!-- <div class="form-group">
								<label for="bulkupload" class="font-weight-regular">
									Bulk Upload
								</label>
								<input type="file" name="bulkupload" class="form-control" id="bulkupload" accept="application/xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required />
							</div> -->

							<div class="form-group">
								<label class="font-weight-regular"> Employee ID </label>
								<select class="form-control" id="empId" name="empId">
									<option>Select Employee ID</option>
									<!-- <option value=" ev2">Vendorcat-2</option>
									<option value="ev3">Vendorcat-3</option> -->
								</select>
								<span id="warn_emp_id" class="text-danger font-weight-regular">
								</span>
							</div>

							<div class="form-group">
								<label for="employeename" class="font-weight-regular">
									Employee Name
								</label>
								<div class="empName">
									<input type="text" name="pay_emp_name" pattern="[a-z A-Z]{3,}" minlength="3" class="form-control" id="employeename" autocomplete="off" required />
								</div>

								<span id="EName" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="bank"> Select Bank :</label>
								<select id="c_banks" name="c_banks" class="form-control">
									<!-- <option value="v1">Vendor-1</option>
									<option value="v2">Vendor-2</option>
									<option value="v3">Vendor-3</option> -->
								</select>
								<span id="warn_c_banks" class="text-danger font-weight-regular"> </span>
							</div>

							<!-- <div class="form-group">
								<label for="category" class="font-weight-regular">
									Expense category :
								</label>
								<select id="category" name="course" required>
									<option id="salary" value="sal">SALARY</option>
									<option id="other" value="other">OTHER</option>
								</select>
								<div id="expense-category">

								</div>
							</div> -->

							<div class="form-group">
								<label class="font-weight-regular"> Expense Category </label>
								<select class="form-control" id="expId" name="expId">
									<!-- <option>Select Employee ID</option> -->
									<!-- <option value="ev2">Vendorcat-2</option>
									<option value="ev3">Vendorcat-3</option> -->
								</select>
								<span id="warn_expCat" class="text-danger font-weight-regular"> </span>
								<div id="expense-category">

								</div>
								<span id="warn_doc" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="amount" class="font-weight-regular"> Amount </label>
								<input type="number" name="amount" class="form-control" id="amount" min="0" autocomplete="off" required />
								<span id="warn_amount" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label class="font-weight-regular"> Payment Due Date</label>
								<input type="date" name="paydd" class="form-control" id="paydd" autocomplete="off" />
								<span id="warn_date" class="text-danger font-weight-regular">
								</span>
							</div>

							<div class="form-group">
								<label class="font-weight-regular"> Payment Mode</label><br />
								<input class="ml-3" type="radio" id="manual" name="pay_mode" value="manual" />
								<label for="manual">Manual</label><br />
								<input class="ml-3" type="radio" id="schedule" name="pay_mode" value="schedule" />
								<label for="schedule">Scheduled</label><br />
								<div id="payment-mode-schedule">

								</div>
								<span id="warn_sdate" class="text-danger font-weight-regular">
								</span>
							</div>

							<div class="form-group">
								<label for="Tag" class="font-weight-regular">
									Tags
								</label>
								<input type="text" name="Tags" pattern="[a-z A-Z]{1,}" class="form-control" id="Tags" autocomplete="off" required />
								<span id="warn_tag" class="text-danger font-weight-regular">
								</span>
								<br />

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

	<!-- table start  -->
	<div class="card" style="width: 95%;">
		<div class="card-body">
			<div class="spinnerDIV" style="display: none;">
				<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
					<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
				</svg>
			</div>
			<div class="table-responsive mt-4" style="overflow-x:auto" id="tblBlur">
				<table class="table" id="payout">
					<thead>
						<tr>
							<th scope="col">Employee Name</th>
							<th scope="col">Amount</th>
							<th scope="col">Payment Due Date</th>
							<th scope="col">Payment Mode</th>
							<th scope="col">Status</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody class="tblBody">
					</tbody>
				</table>
			</div>
		</div>
	</div>


</div>

<script type="text/javascript">
	function validation() {
		var ename = document.getElementById("employeename").value;
		// var mobileNumber = document.getElementById("mobileNumber").value;

		if (ename == "") {
			document.getElementById("EName").innerHTML =
				" ** Please fill the Name field";
			return false;
		}
	}
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var i = 0;
		$('#manual').click(function() {

			$('#payment-mode-schedule').empty();
			i = 0;

		});
		//   <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>
		$('#schedule').click(function() {
			if (i == 0) {
				$('#payment-mode-schedule').append('<br/><label class="font-weight-regular"> Payment Processing Date</label><input type="date" name="paypd" class="form-control" id="paypd" autocomplete="off" required />',

				);
				i++;
			}

		});


	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('change', '#expId', function() {
			if ($(this).val() == '<?php echo $this->sec->encryptor('e', '1'); ?>') {
				$('#expense-category').append('<br/><div class="form-group"><label for="document" class="font-weight-regular"> Upload Approval Image/Document </label><input type="file" name="approvalDoc" class="form-control" id="document" accept="application/pdf" /></div>', );
			} else {
				$('#expense-category').empty();
			}
		});
	});
</script>

<script>
	var csrf_token = "";
	$("#addEmpPay").submit(function(e) {
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		e.preventDefault();
		const form = new FormData(document.getElementById('addEmpPay'));
		form.append('csrf_token', csrf_token);
		// var add = document.getElementById("c_address").value;
		// form.append("c_address", add);
		// console.log(...form);
		$.ajax({
			method: 'POST',
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: `<?php echo base_url() ?>EmployeesManagement/addEmpPay`,
			data: form,
			success: function(data) {
				// alert(response);
				// console.log(response);
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				if (res.error) {
					for (let key in res.error) {
						// console.log(key + " " + res.error[key]);
						$("#" + key).text(res.error[key]);
					}
				} else {
					if (res.output == "SUCCESS") {
						swal("Employee Payout Created Successfully", "Action Succeed!", "success").then(() => {
							// loadEmpPay();
							location.reload();
							// $('#addEmpPay').trigger("reset");
						});
					}
				}
			}
		});
	});


	function loadEmpId() {
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo base_url(); ?>EmployeesManagement/getEmpId",
			method: "POST",
			data: {
				"<?= $csrf['name']; ?>": csrf_token,
			},
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$("#empId").html(res.output);
				// $(document).ready(function() {
				// 	$('#payout').DataTable({
				// 		"order": [
				// 			[0, 'asc'],
				// 			[1, 'desc']
				// 		],
				// 		"lengthChange": false,
				// 		"paging": true,
				// 		"iDisplayLength": 10,
				// 		retrieve: true,
				// 	});
				// });
			}
		});
	}

	loadEmpId();

	function loadEmpPay() {
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo base_url(); ?>EmployeesManagement/showEmpPay",
			method: "POST",
			data: {
				"<?= $csrf['name']; ?>": csrf_token,
			},
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$(".tblBody").html(res.output);
				// console.log(data);
				$(document).ready(function() {
					$('#payout').DataTable({
						"order": [
							[0, 'asc'],
							[1, 'desc']
						],
						"lengthChange": false,
						"paging": true,
						"iDisplayLength": 10,
						retrieve: true,
					});
				});
			}
		});
	}
	loadEmpPay();

	function getAllExpCat() {
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo base_url(); ?>EmployeesManagement/getExpCat",
			method: "POST",
			data: {
				"<?= $csrf['name']; ?>": csrf_token,
			},
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$("#expId").html(res.output);
			}
		});
	}
	getAllExpCat();



	$(document).on('change', '#empId', function() {
		var id = $(this).val();
		if (id != "") {
			getEmpName(id);
			getBanks(id);
		} else {
			$("#employeename").val("");

			var html = "<option>Please Select Employee ID</option>"
			$("#c_banks").html(html);
		}

	});

	function getEmpName(id) {
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo base_url(); ?>EmployeesManagement/getEmpName/" + id,
			method: "POST",
			data: {
				"<?= $csrf['name']; ?>": csrf_token,
			},
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$(".empName").html(res.output);
			},
			error: function() {
				console.log("Some Error Occured");
			}
		});
	}

	function getBanks(id) {
		// alert(id);
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo base_url(); ?>EmployeesManagement/getEmpBanks/" + id,
			method: "POST",
			data: {
				"<?= $csrf['name']; ?>": csrf_token,
			},
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$("#c_banks").html(res.output);
			}
		});
	}

	$(document).on('click', '.payout', function() {
		// alert("Payout Clicked")
		// console.log($(this).attr("id"));
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo base_url(); ?>PayoutController/payOutEmp/" + $(this).attr("id"),
			method: "POST",
			data: {
				"<?= $csrf['name']; ?>": csrf_token,
			},
			// data: $(this).val(),
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				// alert(data)
				// loadEmpPay();

				if (res.error) {
					swal("Some Error Ocurred", res.error + " Please Try Again Later After Some Time", "error").then(() => {
						// loadEmpPay();
						location.reload();
						// $('#addEmpPay').trigger("reset");
					});
				} else {
					location.reload();
				}

			},
			beforeSend: function() {
				$("#tblBlur").css("filter", "blur(4px)");
				$(".spinnerDIV").css("display", "block");
			},
			complete: function() {
				$("#tblBlur").css("filter", "blur(0px)");
				$(".spinnerDIV").css("display", "none");
			},
		});
	});
</script>

<!-- script table Data  -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>



</body>

</html>