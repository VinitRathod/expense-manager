<?php
defined('BASEPATH') or exit('No direct script access allowed');
$csrf = array(
	'name' => $this->security->get_csrf_token_name(),
	'value' => $this->security->get_csrf_hash(),
);
?>


<div id="maincontent" class="contentblock mr-4" style="width:80vw">

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
								<div id="lblPANCard" class="error"></div>
								<input type="text" name="pan" class="form-control" onkeyup="validationPan()" id="pan" autocomplete="off" required />
							</div>

							<div class="form-group">
								<label class="font-weight-regular"> Mobile Number </label>
								<div id="mobileno" name="mobileno" class="error"> </div>
								<input type="text" name="mobile" class="form-control" onkeyup="validationmob()" placeholder="+91-9999999999" id="mobileNumber" required />

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
											<td>Account Number : <div id="accnom" name="accnom" class="error"> </div> <input type="number" id="accnumber" name="accno[]" placeholder="Enter your Account Number" onkeyup="validationaccno()" class="form-control name_list"></td>
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
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" onclick="resetForm()" autocomplete="off" />

						</form>

						<br /><br />


					</div>

				</div>
			</div>
		</div>

		<!-- modal end  -->
		<br />



	</div>
	<!-- Edit Modal Start -->
	<div class="modal fade" id="editEMPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Employee Details</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">


					<form onsubmit="return validation()" class="bg-light" id="editEmpBasic">
						<div class="Empid">
							<input type="hidden" name="EmpID" id="editempId">
						</div>
						<div class="form-group">
							<label class="font-weight-regular"> Employee ID </label>
							<input type="text" name="empid" class="form-control" id="edit_empid" autocomplete="off" required />
							<span id="employeeid" class="text-danger font-weight-regular">
							</span>
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
							<div id="lblPANCardE" class="error"></div>
							<input type="text" name="pan" class="form-control" onkeyup="validationPanE()" id="editPan" autocomplete="off" required />
						</div>

						<div class="form-group">
							<label class="font-weight-regular"> Mobile Number </label>
							<div id="mobilenoE" name="mobileno" class="error"> </div>
							<input type="text" placeholder="+91-9999999999" name="mobile" class="form-control" onkeyup="validationmobE()" id="edit_mobileno" required />

						</div>

						<div class="form-group">
							<label class="font-weight-regular"> Email </label>
							<input type="email" name="c_email" class="form-control" id="edit_email" autocomplete="off" />
							<span id="emailids" class="text-danger font-weight-regular"> </span>
						</div>
						<input type="submit" name="submit" value="Edit Details" class="btn btn-primary" autocomplete="off" data-tw-dismiss="modal" />
						<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
					</form>

					<br /><br />
				</div>

			</div>
		</div>
	</div>
	<!-- Edit Modal Ends -->
	<!-- BEGIN: Main Table  -->
	<div class="card" style="width: 95%;">
		<div class="card-body">


			<div class="table-responsive-md mt-4" style="overflow-x:auto;">
				<table class="table" id="employee">
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
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeEditing()">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<button type="button" class="btn btn-x invisible" id="editBankAdd">Add Bank</button>
					<div class="table-responsive-md mt-4">
						<table class="table" id="bankDetails_tbl" style="overflow-x:auto;" id="employee">
							<thead>
								<tr id="banks_header">
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
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" data-dismiss="modal" onclick="closeEditing()">Close</button>
					<button class="btn btn-success" type="button" id="editBanks">Edit Banks</button>
				</div>
			</div>
		</div>
	</div>

</div>
<script>
	var csrf_token = "";
	let editingBank = false;
	let addingBank = false;
	let currentBanksId = undefined;

	function resetForm() {
		var lblPANCard = document.getElementById("lblPANCard")
		lblPANCard.innerHTML = "";
		var mobileno = document.getElementById("mobileno")
		mobileno.innerHTML = "";

	}

	function bankDetails(id) {
		// let url = "";
		// id.forEach((id) => {
		// 	url += (id + "_");
		// });
		if (csrf_token == "") {
			csrf_token = '<?php echo $csrf['value'] ?>';
		}
		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>EmployeesManagement/getBankDetails/" + id,
			data: {
				"<?= $csrf['name']; ?>": csrf_token,
			},
			success: function(data) {
				// alert(response);
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$(".banktbl").html(res.output);
				currentBanksId = id;
			}
		});
	}

	function empDelete(id) {
		if (csrf_token == "") {
			csrf_token = '<?php echo $csrf['value'] ?>';
		}

		// alert(id);
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
						data: {
							"<?= $csrf['name']; ?>": csrf_token,
						},
						success: function(data) {
							let res = JSON.parse(data);
							// console.log(res);
							if (res.csrf) {
								csrf_token = res.csrf;
							}
							if (res.output == "SUCCESS") {
								swal("Poof! Employee has been deleted!", {
										icon: "success",
									})
									.then(() => {
										location.reload();
									});
								// loadEmp();

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

	// edit banks details start from here
	$("#editBanks").click(function() {
		if (csrf_token == "") {
			csrf_token = '<?php echo $csrf['value'] ?>';
		}
		if (!editingBank) {
			$("#editBankAdd").removeClass("invisible");
			$("#banks_header").append("<th scope='col'>Remove</th>")
			$(".banks").append('<td><button class="close" type="button" aria-label="Close" onclick="removeBank(this)"><span aria-hidden="true">&times;</span></button></td>');
			$("#editBanks").html("Update");
			editingBank = true;
		} else {
			let existing_banks = [];
			let other_banks = [];
			let all_rows = document.getElementById("bankDetails_tbl").rows;
			for (let i = 1; i < all_rows.length; i++) {
				if (all_rows[i].cells.length == 6) {
					existing_banks.push(all_rows[i].cells[0].innerHTML);
					// other_banks.push([all_rows[i].cells[1].innerHTML,all_rows[i].cells[2].innerHTML,all_rows[i].cells[3].innerHTML,all_rows[i].cells[4].innerHTML]);
				} else {
					other_banks.push([all_rows[i].cells[0].innerHTML, all_rows[i].cells[1].innerHTML, all_rows[i].cells[2].innerHTML, all_rows[i].cells[3].innerHTML]);
				}
			}
			// for quick debugging...
			// console.log(existing_banks);
			// console.log(other_banks);
			let form = new FormData();
			form.append('existing_bank', existing_banks);
			form.append('other_banks', other_banks);
			form.append('c_id', currentBanksId);
			form.append("csrf_token", csrf_token);

			$.ajax({
				method: 'POST',
				processData: false,
				contentType: false,
				cache: false,
				enctype: 'multipart/form-data',
				url: `<?php echo base_url() ?>EmployeesManagement/editBanks`,
				data: form,
				// dataType: "json",
				success: function(data) {
					let res = JSON.parse(data);
					// console.log(res);
					if (res.csrf) {
						csrf_token = res.csrf;
					}
					if (res.output == "SUCCESS") {
						swal("Updated Bank Details Successfully!", "", "success").then(() => {
							// closeEditing();
							location.reload();
						});
					}

				},
			});
		}
	});


	function removeBank(elem) {
		// alert(elem);
		if (csrf_token == "") {
			csrf_token = '<?php echo $csrf['value'] ?>';
		}
		let current_tr = elem.parentNode.parentNode;
		let current_tbl = elem.parentNode.parentNode.parentNode;
		let index = $("#bankDetails_tbl tr").index(current_tr);
		current_tbl = document.getElementById("bankDetails_tbl");
		let bankId = current_tbl.rows[index].cells[0].innerHTML;
		let total_rows = current_tbl.rows.length;
		// alert(bankId);

		let form = new FormData();
		form.append("c_id", bankId);
		form.append("csrf_token", csrf_token);

		if (total_rows > 2) {
			$.ajax({
				method: 'POST',
				processData: false,
				contentType: false,
				cache: false,
				enctype: 'multipart/form-data',
				url: `<?php echo base_url() ?>EmployeesManagement/checkBank`,
				data: form,
				success: function(data) {
					let res = JSON.parse(data);
					// console.log(res);
					if (res.csrf) {
						csrf_token = res.csrf;
					}
					if (res.output == "SUCCESS") {
						document.getElementById("bankDetails_tbl").deleteRow(index);
						swal("Bank Has Been Deleted!", "", "success").then(() => {});
					} else {
						// just for quick debug...
						// alert(response);
						swal("Cannot Delete This Bank Details", "This Bank is in Payout Processing", "error").then(() => {
							// call back after work is update is done, comes here...
							// closeEditing();
						});
					}
				}
			});
		} else { // otherwise....
			// give error...
			swal("Cannot perform this action!", "At least one Bank detail is mandatory!", "error").then(() => {
				// some call back goes here...
			})
		}



		// quick debug...
		// alert(index);
		// since at least one contact is mandatory...
		// to get how many rows in current table -> pass current table

	}

	$("#editBankAdd").click(function() {
		if (!addingBank) {
			$(".banktbl").append('<tr><td><input type="text" id="intermediateBankName" required /></td><td><input type="text" id="intermediateIFSC" required /></td><td><input type="text" id="intermediateAccNo" required /></td><td><input type="text" id="intermediateAccStat" required /></td><td><button type="button" class="btn btn-success" onclick="addBank()">Add</button></td></tr>');
			addingBank = true;
		} else {
			swal("Complete this action fisrt!", "Please finish adding one Bank first.", "warning").then(() => {
				// some callbaks to be called here if any...
			});
		}
	});

	function closeEditing() {
		editingBank = false;
		$("#bankDetails_tbl tbody tr td").filter(":nth-child(5)").remove();
		$("#bankDetails_tbl thead tr th").filter(":nth-child(5)").remove();
		$("#editBankAdd").addClass("invisible");
		$("#editBanks").html("Edit Banks");
		addingBank = false;
	}

	function addBank() {
		addingBank = false;
		let bank_name = $("#intermediateBankName").val();
		let ifsc = $("#intermediateIFSC").val();
		let accno = $("#intermediateAccNo").val();
		let accStat = $("#intermediateAccStat").val();

		let index = document.getElementById("bankDetails_tbl").rows.length;
		document.getElementById("bankDetails_tbl").deleteRow(index - 1);
		$(".banktbl").append('<tr class="banks"><td>' + bank_name + '</td><td>' + ifsc + '</td><td>' + accno + '</td><td>' + accStat + '</td><td><button class="close" type="button" aria-label="Close" onclick="removeBank(this)"><span aria-hidden="true">&times;</span></button></td></tr>')
		// alert("Hello world");
	}



	var postURL = "/addmore.php";
	var i = 1;
	//   <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>
	$('#add').click(function() {
		i++;
		$('#dynamic_field').append('<tr id="row1' + i + '" class="dynamic-added"> <td><b>Enter Your Another Bank  Account  Details </b> </td></tr>',
			'<tr id="row2' + i + '" class="dynamic-added"><td>Bank Name : <input type="text" name="bankname[]" placeholder="Enter your Bank Name" class="form-control name_list" required="" /></td></tr>',
			'<tr id="row3' + i + '" class="dynamic-added"><td> IFSC Code : <input type="text" name="ifsc[]" placeholder="Enter your IFSC Code" class="form-control name_list" required="" /></td></tr>',
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
		if (csrf_token == "") {
			csrf_token = '<?php echo $csrf['value'] ?>';
		}
		e.preventDefault();
		const form = new FormData(document.getElementById('add_emp'));
		form.append("csrf_token", csrf_token);
		// console.log(...form);
		$.ajax({
			method: 'POST',
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: "<?php echo base_url() ?>EmployeesManagement/addEmp",
			data: form,
			success: function(data) {
				// loadEmp();
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				console.log("data added successfully")
				// loadEmp();
				location.reload();
				// document.getElementById("add_emp").reset();

			}
		});
	});

	function loadEmp() {
		if (csrf_token == "") {
			csrf_token = '<?php echo $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo base_url() ?>EmployeesManagement/index",
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
				$(document).ready(function() {
					$('#employee').DataTable({
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
				$(".tblBody").html(res.output);
			}
		});
	}
	loadEmp();

	function empEdit(id) {
		// alert(id);
		if (csrf_token == "") {
			csrf_token = '<?php echo $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo  base_url(); ?>EmployeesManagement/editEmp/" + id,
			method: "POST",
			data: {
				"<?= $csrf['name']; ?>": csrf_token,
			},
			success: function(data) {
				// console.log(JSON.parse(response));
				// var data = JSON.parse(response);
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				// let data = JSON.parse(response);
				$("#edit_empid").val(res.result.c_empid);
				$("#editEmpName").val(res.result.c_fname + " " + res.result.c_lname);
				$("#editPan").val(res.result.c_panno);
				$("#edit_mobileno").val(res.result.c_contactno);
				$("#edit_email").val(res.result.c_email);
				$('#editempId').val(res.result.c_id);
				$("#EditexpDesc").html(res.result.c_description);
			}
		});
	}

	function validationmob() {

		var mobileNumber = document.getElementById("mobileNumber");
		var mobileno = document.getElementById("mobileno");
		var regexm = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
		if (regexm.test(mobileNumber.value)) {
			mobileno.innerHTML = "";
			return true;
		} else {
			mobileno.innerHTML = "*Invalid Mobile Number";
			return false;
		}


	}

	function validationmobE() {

		var mobileNumber = document.getElementById("edit_mobileno");
		var mobileno = document.getElementById("mobilenoE");
		var regexm = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
		if (regexm.test(mobileNumber.value)) {
			mobileno.innerHTML = "";
			return true;
		} else {
			mobileno.innerHTML = "*Invalid Mobile Number";
			return false;
		}


	}


	function validationPan() {

		var txtPANCard = document.getElementById("pan");
		var lblPANCard = document.getElementById("lblPANCard")
		var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
		if (regex.test(txtPANCard.value.toUpperCase())) {
			lblPANCard.innerHTML = "";
			return true;
		} else {
			lblPANCard.innerHTML = "*Invalid PAN Card Number";
			return false;
		}

	}

	function validationPanE() {

		var txtPANCard = document.getElementById("editPan");
		var lblPANCard = document.getElementById("lblPANCardE")
		var regex = /([A-Z]){5}([0-9]){4}([A-Z]){1}$/;
		if (regex.test(txtPANCard.value.toUpperCase())) {
			lblPANCard.innerHTML = "";
			return true;
		} else {
			lblPANCard.innerHTML = "*Invalid PAN Card Number";
			return false;
		}

	}

	function validationaccno() {

		var accnumber = document.getElementById("accnumber");
		var accnom = document.getElementById("accnom");
		var regexm = "[0-9]{9,18}";
		if (regexm.test(mobileNumber.value)) {
			accnom.innerHTML = "";
			return true;
		} else {
			maccnom.innerHTML = "*Invalid Account Number";
			return false;
		}


	}

	$("#editEmpBasic").submit(function(e) {
		e.preventDefault();
		const form = new FormData(document.getElementById("editEmpBasic"));
		form.append("csrf_token", csrf_token);
		// console.log(...form);
		$.ajax({
			url: "<?php echo base_url(); ?>EmployeesManagement/editEmpBasic",
			method: "POST",
			processData: false,
			contentType: false,
			cache: false,
			data: form,
			enctype: 'multipart/form-data',
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				// console.log(response);
				if (res.output == "SUCCESS") {
					swal("Basic Details Of Employee Are Updates Successfully!", "", "success").then(() => {
						// call back function, after success something to be done... goes here...
						// loadEmp();
						location.reload();
					});
				}
			}

		});
	})
</script>
<!-- script table Data  -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</body>

</html>