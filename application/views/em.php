<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<div id="maincontent" class="contentblock mr-4" style="width:75vw">

	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold" style="font-size: 20px">
			Employee Management
		</h2>
		<button type="button" class="btn mr-5 btn-x" data-toggle="modal" data-target="#EMModal">
			Add Employee
		</button>
	</div>


	<div class="container">
		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade modal-dialog-scrollable" id="EMModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Employee Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form onsubmit="return validation()" id="add_emp" class="bg-light">
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
								<label class="font-weight-regular"> Email </label>
								<input type="email" name="c_email" class="form-control" id="c_email" autocomplete="off" />
								<span id="emailids" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="BankDetail" class="font-weight-regular"> Bank Details </label>

								<div class="table-responsive">
									<table class="table table-bordered" id="dynamic_field">
										<tr>
											<td>Bank Name : <input type="text" name="bankname[]" placeholder="Enter your Bank Name" class="form-control name_list"></td>
										</tr>
										<tr>
											<td>
												IFSC Code : <input type="text" name="ifsc[]" placeholder="Enter your IFSC Code" class="form-control name_list"></td>
										</tr>
										<tr>
											<td>Account Number : <input type="text" name="accno[]" placeholder="Enter your Account Number" class="form-control name_list"></td>
										</tr>
										<tr>
											<td>Account Status :<input type="text" name="AccStatus[]" placeholder="Enter your Account Status" class="form-control name_list"></td>
										</tr>

									</table>
									<table>
										<tr>
											<td><button type="button" name="add" id="add" class="btn btn-success">Add More Bank </button></td>
										</tr>
									</table>
								</div>
							</div>



							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />

						</form>

						<br /><br />


					</div>

				</div>
			</div>
		</div>

		<!-- modal end  -->
		<br />



	</div>
	<div class="container" id="editExpModelContainer">
		<div class="modal fade" id="editEXPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Expense</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form onsubmit="return validation()" id="edit_emp" class="bg-light" method="post">
							<div class="Expid">
								<input type="text" name="EmpID" id="empId" hidden>
							</div>
							<div class="form-group">
								<label for="employeename" class="font-weight-regular">
									Employee Name
								</label>
								<input type="text" name="employeename" pattern="[a-z A-Z]{3,}" class="form-control" id="editEmpName" autocomplete="off" required />
								<span id="EName" name="EName" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="pan" class="font-weight-regular"> PAN Number </label>
								<input type="text" name="pan" class="form-control" id="editPan" autocomplete="off" required />
							</div>

							<div class="form-group">
								<label class="font-weight-regular"> Mobile Number </label>
								<input type="number" pattern="[0-9]{10}" maxlength="10" max="9999999999" step="1" name="mobile" class="form-control" id="editmobileNumber" required />
								<span id="mobileno" name="mobileno" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label class="font-weight-regular"> Email </label>
								<input type="email" name="c_email" class="form-control" id="editemail" autocomplete="off" />
								<span id="emailids" class="text-danger font-weight-regular"> </span>
							</div>
							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" data-tw-dismiss="modal" />
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- BEGIN: Main Table  -->
	<div class="card" style="width: 95%;">
		<div class="card-body">


			<div class="table-responsive-md mt-4" style="overflow-x:auto;">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Employee ID</th>
							<th scope="col">Employee Name</th>
							<th scope="col">PAN Number</th>
							<th scope="col">Mobile Number</th>
							<th scope="col">Bank Details</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody class="tblBody">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- END: Main Table  -->

	<!-- BEGIN: bank Details Table  -->
	<div class="modal fade" id="bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Bank Details Table</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive-md mt-4">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Bank Name</th>
									<th scope="col">IFSC Code </th>
									<th scope="col">Account Number </th>
									<th scope="col">Account Status </th>
								</tr>
							</thead>
							<tbody class="banktbl">
								<!-- <tr>
									<td>cdusdgf</td>
									<td>mahdd4ei</td>
									<td>16496495611</td>
									<td>active</td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script>
	function bankDetails(...id) {
		let url = "";
		id.forEach((id) => {
			url += (id + "_");
		});
		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>BankController/getBankDetails/" + url,
			success: function(response) {
				// alert(response);
				$(".banktbl").html(response);
			}
		});
	}

	function empDelete(id) {

		alert(id);
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this Employee!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: `<?php echo base_url(); ?>/EmployeesManagement/empDelete/${id}`,
						method: "POST",
						success: function(response) {
							if (response == "SUCCESS") {
								swal("Poof! Employee has been deleted!", {
									icon: "success",
								});
								loadExp();
							}
						}
					});
				} else {
					swal("Employee is safe!", {
						icon: "info",
					});
				}
			});
	}



	var postURL = "/addmore.php";
	var i = 1;
	//   <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>
	$('#add').click(function() {
		i++;
		$('#dynamic_field').append('<tr id="row1' + i + '" class="dynamic-added"> <td><b>Enter Your Another Bank  Account  Details </b> </td></tr>',
			'<tr id="row2' + i + '" class="dynamic-added"><td>Bank Name : <input type="text" name="bankname[]" placeholder="Enter your Bank Name" class="form-control name_list" required="" /></td></tr>',
			'<tr id="row3' + i + '" class="dynamic-added"><td> IFSC Code : <input type="text" name="ifscCode[]" placeholder="Enter your IFSC Code" class="form-control name_list" required="" /></td></tr>',
			'<tr id="row4' + i + '" class="dynamic-added"><td>Account Number : <input type="text" name="accno[]" placeholder="Enter your Account Number" class="form-control name_list" required="" /></td></tr>',
			'<tr id="row5' + i + '" class="dynamic-added"><td>Account Status : <input type="text" name="AccStatus[]" placeholder="Enter your Account status" class="form-control name_list" required="" /></td></tr>',
			'<tr id="row6' + i + '" class="dynamic-added"><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Remove</button></td></tr>',
		);
	});




	$(document).on('click', '.btn_remove', function() {
		var button_id = $(this).attr("id");
		$('#row1' + button_id + '').remove();
		$('#row2' + button_id + '').remove();
		$('#row3' + button_id + '').remove();
		$('#row4' + button_id + '').remove();
		$('#row5' + button_id + '').remove();
		$('#row6' + button_id + '').remove();

	});

	$("#add_emp").submit(function(e) {
		e.preventDefault();
		const form = new FormData(document.getElementById('add_emp'));
		// console.log(...form);
		$.ajax({
			method: 'POST',
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: "<?php echo base_url() ?>EmployeesManagement/addEmp",
			data: form,
			success: function() {
				// loadExp();

				console.log("data added successfully")
				loadExp();
				// document.g	etElementById("add_emp").reset();

			}
		});
	});

	function loadExp() {
		$.ajax({
			url: "<?php echo base_url() ?>EmployeesManagement/index",
			method: "POST",
			success: function(data) {
				$(".tblBody").html(data);

			}
		});
	}
	loadExp();

	function empEdit(id) {
		// alert(id);
		$.ajax({
			url: "<?php echo  base_url(); ?>EmployeesManagement/editEmp/" + id,
			method: "POST",
			success: function(response) {
				// console.log(JSON.parse(response));
				let data = JSON.parse(response);
				$("#editEmpName").val(data.c_fname, data.lname);
				$("#editPan").val(data.c_panno);
				$("#editmobileNumber").val(data.c_phone);
				$("#editemail").val(data.c_email);
				$('#empId').val(data.c_id);
				// $("#EditexpDesc").html(data.c_description);
			}
		});
	}
</script>