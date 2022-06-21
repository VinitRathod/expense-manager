<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock mr-4" style="width:80vw">



	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold " style="font-size: 20px">
			Vendor Management
		</h2>
		<button type="button" class="btn mr-5 btn-x" data-toggle="modal" data-target="#VMModal">
			Add Vendor
		</button>
	</div>

	<div class="container">

		<!-- Modal -->
		<div class="modal fade" id="VMModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Vendor Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form action="#" onsubmit="return validation()" class="bg-light" name="add_name" id="addVen">
							<div class="form-group">
								<label for="vendorId" class="font-weight-regular"> Vendor ID </label>
								<input type="text" name="vendorid" class="form-control" id="vendorId" autocomplete="off" />
								<span id="vendorid" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="vendorname" class="font-weight-regular">
									Vendor Name
								</label>
								<input type="text" name="c_name" pattern="[a-zA-Z]{3,} [a-zA-Z]{3,}" class="form-control" id="c_name" autocomplete="off" required placeholder="ex. John Doe" />
								<span id="VName" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="nickname" class="font-weight-regular">
									Nick Name
								</label>
								<input type="text" name="c_nickname" pattern="[a-z A-Z]{3,}" class="form-control" id="c_nickname" autocomplete="off" required placeholder="ex. Johhny" />
								<span id="NName" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="Address" class="font-weight-regular"> Address </label>
								<br />
								<textarea rows="4" cols="50" name="c_address" form="usrform" required id="c_address"></textarea>
							</div>

							<div class="form-group">
								<label for="gst" class="font-weight-regular"> GST </label>
								<div id="GSt" class="error"></div>
								<input type="text" name="c_gstno" pattern="[a-zA-Z]{16}" onkeyup="validationGST()" minlength="16" class="form-control" id="c_gstno" autocomplete="off" required />
							</div>
							<div class="form-group">
								<label for="pan" class="font-weight-regular"> PAN Number </label>
								<div id="lblPANCard" class="error"></div>
								<input type="text" name="c_panno" class="form-control" onkeyup="validationPan()" id="c_panno" autocomplete="off" required />
							</div>
							<div class="form-group">
								<label class="font-weight-regular"> Email </label>
								<input type="email" name="c_email" class="form-control" id="c_email" autocomplete="off" />
							</div>
							<div class="form-group">
								<label class="font-weight-regular"> Mobile Number </label>
								<div id="mobileno" name="mobileno" class="error"> </div>
								<input type="text" name="c_contacts[]" class="form-control" onkeyup="validationmob()" placeholder="+91-9999999999" id="c_contacts" required />
							</div>
							<div class="form-group">
								<label for="document" class="font-weight-regular"> Document </label>
								<input type="file" name="c_document" class="form-control" id="c_document" accept="application/pdf" />
							</div>

							<div class="form-group">
								<label for="BankDetail" class="font-weight-regular"> Bank Details </label>

								<div class="table-responsive">
									<table class="table table-bordered" id="dynamic_field">
										<tr>
											<td>Bank Name : <input type="text" name="c_bankname[]" placeholder="Enter your Bank Name" class="form-control name_list" required="" /></td>
										</tr>
										<tr>
											<td>
												IFSC Code : <input type="text" name="c_ifsc[]" placeholder="Enter your IFSC Code" class="form-control name_list" required="" /></td>
										</tr>
										<tr>
											<td>Account Number : <input type="text" name="c_accountno[]" placeholder="Enter your Account Number" class="form-control name_list" required="" /></td>
										</tr>
										<tr>
											<td>Account Status :<input type="text" name="c_status[]" placeholder="Enter your Account Status" class="form-control name_list" required="" /></td>
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
										<!-- <tr>
											<td>Name : <input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" required="" /></td>
										</tr> -->
										<tr>
											<td>

												Mobile Number :<div id="mobilenof" name="mobileno" class="error"> </div> <input type="text" id="mobile_f" onkeyup="validationmobF()" name="c_contacts[]" placeholder="+91-9999999999" class="form-control name_list" required="" /></td>
										</tr>
										<!-- <tr>
											<td>Email: <input type="email" name="email[]" placeholder="Enter your email" class="form-control name_list" required="" /></td>
										</tr> -->
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
								<input type="text" name="c_designation" pattern="[a-z A-Z]{3,}" class="form-control" id="c_designation" autocomplete="off" required />

							</div>
							<div class="form-group">
								<label for="Tag" class="font-weight-regular">
									Tags
								</label>
								<input type="text" name="c_tags" pattern="[a-z A-Z]{1,}" class="form-control" id="c_tags" autocomplete="off" required />
								<br />

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
		<!-- Edit Modal Start -->
		<div class="modal fade" id="editVen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Vendor Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form action="#" onsubmit="return validation()" class="bg-light" name="add_name" id="editVenBasic">
							<input type="text" hidden id="ven" name="ven">
							<div class="form-group">
								<label for="vendorname" class="font-weight-regular"> Vendor Name </label>
								<input type="text" name="c_name" pattern="[a-zA-Z]{3,} [a-zA-Z]{3,}" class="form-control" id="edit_c_name" autocomplete="off" required placeholder="ex. John Doe" />
								<span id="VName" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="nickname" class="font-weight-regular"> Nick Name </label>
								<input type="text" name="c_nickname" pattern="[a-z A-Z]{3,}" class="form-control" id="edit_c_nickname" autocomplete="off" required placeholder="ex. Johhny" />
								<span id="NName" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="Address" class="font-weight-regular"> Address </label>
								<br />
								<textarea rows="4" cols="50" name="c_address" form="usrform" required id="edit_c_address"></textarea>
							</div>

							<div class="form-group">
								<label for="gst" class="font-weight-regular"> GST </label>
								<div id="GStE" class="error"></div>
								<input type="text" name="c_gstno" pattern="[a-zA-Z]{16}" minlength="16" onkeyup="validationGSTE()" class="form-control" id="edit_c_gstno" autocomplete="off" required />
							</div>

							<div class="form-group">
								<label for="pan" class="font-weight-regular"> PAN Number </label>
								<div id="lblPANCardE" class="error"></div>
								<input type="text" name="c_panno" class="form-control" id="edit_c_panno" onkeyup="validationPanE()" autocomplete="off" required />
							</div>

							<div class="form-group">
								<label class="font-weight-regular"> Email </label>
								<input type="email" name="c_email" class="form-control" id="edit_c_email" autocomplete="off" />
								<span id="emailids" class="text-danger font-weight-regular"> </span>
							</div>

							<!-- <div class="form-group">
								<label for="document" class="font-weight-regular"> Document </label>
								<input type="file" name="c_document" class="form-control" id="edit_c_document" accept="application/pdf" />
							</div> -->

							<div class="form-group">
								<label for="Designation" class="font-weight-regular"> Designation </label>
								<input type="text" name="c_designation" pattern="[a-z A-Z]{3,}" class="form-control" id="edit_c_designation" autocomplete="off" required />

							</div>
							<div class="form-group">
								<label for="Tag" class="font-weight-regular"> Tags </label>
								<input type="text" name="c_tags" pattern="[a-z A-Z]{1,}" class="form-control" id="edit_c_tags" autocomplete="off" required />
								<br />
							</div>

							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
						</form>

						<br /><br />
					</div>

				</div>
			</div>
		</div>
		<!-- Edit Modal Ends -->
		<div class="card" style="width: 95%;">
			<div class="card-body">
				<div class="table-responsive-md mt-4 mr-2" style="overflow-x:auto;">
					<table class="table" id="vendor">
						<thead>
							<tr>
								<th scope="col">Vendor ID</th>
								<th scope="col">Vendor Name</th>
								<th scope="col">Address</th>
								<th scope="col">GST</th>
								<th scope="col">PAN Number</th>
								<th scope="col">Document</th>
								<th scope="col">Designation</th>
								<th scope="col">Bank Details</th>
								<th scope="col">Contact Details</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="tblBody">

						</tbody>
					</table>
				</div>
				<!-- END: Main Table  -->
				<!-- BEGIN: Contact Details Table  -->
				<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Contact Details Table</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeEditing()">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<button type="button" class="btn btn-x invisible" id="editContactAdd"> Add Contact </button>
								<div class="table-responsive-md mt-4">
									<table class="table" id="contactDetails_tbl">
										<thead>
											<tr id="contact_header">
												<th scope="col">Mobile Number</th>
											</tr>
										</thead>
										<tbody id="contactTbl">
											<!-- <tr>
												<td>dff</td>
												<td>275425454</td>
												<td>ghfbgfgf@gg.com</td>
											</tr> -->
										</tbody>
									</table>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeEditing()">Close</button>
								<button type="button" class="btn btn-success" id="editContacts">Edit Contacts</button>
							</div>
						</div>
					</div>
				</div>

				<!-- END: contact Details Table  -->
				<!-- BEGIN: bank Details Table  -->
				<div class="modal fade" id="bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Bank Details Table</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeBankEditing()">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<button type="button" class="btn btn-x invisible" id="editBankAdd"> Add Bank </button>
								<div class="table-responsive-md mt-4">
									<table class="table" id="bankDetails_tbl">
										<thead>
											<tr id="bank_header">
												<th scope="col">Bank Name</th>
												<th scope="col">IFSC Code </th>
												<th scope="col">Account Number </th>
												<th scope="col">Account Status </th>
											</tr>
										</thead>
										<tbody id="bankTbl">

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
								<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeBankEditing()">Close</button>
								<button type="button" class="btn btn-success" id="editBanks">Edit Banks</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>




	</div>



	<!-- END: bank Details Table  -->
</div>

<script type="text/javascript">
	function validation() {
		var emails = document.getElementById("c_email").value;

		console.log(vendorId);

		if (emails.indexOf("@") <= 0) {
			document.getElementById("emailids").innerHTML = " ** Invalid Email";
			return false;
		}

		if (
			emails.charAt(emails.length - 4) != "." &&
			emails.charAt(emails.length - 3) != "."
		) {
			document.getElementById("emailids").innerHTML = " ** Invalid Email";
			return false;
		}
	}
</script>
<script type="text/javascript">
	// global variables...
	// to manage extra rows for bank details...
	// to manage extra rows for add vendor ...
	var i = 1;
	// to manage extra rows for edit vendor...
	var j = 1;

	// to manage extra rows for contact details...
	// to manage extra rows for add vendor ...
	var k = 10;
	// to manage extra rows for edit vendor ...
	var l = 10;
	let editingContact = false;
	let addingContact = false;
	let currentVendorId = undefined;

	let editingBank = false;
	let addingBank = false;
	let currentBanksId = undefined;

	// edit contact details functions ....
	function closeEditing() {
		editingContact = false;
		$("#contactDetails_tbl tbody tr td").filter(':nth-child(2)').remove();
		$("#contactDetails_tbl thead tr th").filter(':nth-child(2)').remove();
		$("#editContactAdd").addClass("invisible");
		$("#editContacts").html("Edit Contacts");
		addingContact = false;
	}
	$("#editContacts").click(function(e) {
		// check if not editing contact...
		if (!editingContact) {
			// actions to be performed when clicked on edit contacts button..
			$("#contact_header").append('<th scope="col">Remove</th>');
			$(".contacts").append('<td><button type="button" class="close" aria-label="Close" onclick="removeContact(this)"><span aria-hidden="true">&times;</span> </button></td>');
			$("#editContactAdd").removeClass("invisible");
			$("#editContacts").html("Update");
			editingContact = true;
		} else {
			let contacts = [];
			let all_rows = document.getElementById("contactDetails_tbl").rows;
			for (let i = 1; i < all_rows.length; i++) {
				contacts.push(all_rows[i].cells[0].innerHTML);
			}
			let contacts_str = contacts.join(",");
			let form = new FormData();
			form.append("contacts", contacts_str);
			form.append("c_id", currentVendorId);
			$.ajax({
				method: 'POST',
				processData: false,
				contentType: false,
				cache: false,
				enctype: 'multipart/form-data',
				url: `<?php echo base_url() ?>VendorManagement/editContacts`,
				data: form,
				success: function(response) {
					if (response == "SUCCESS") {
						swal("Contacts Has Been Updated!", "", "success").then(() => {
							// call back after work is update is done, comes here...
							closeEditing();
						});
					} else {
						// just for quick debug...
						alert(response);
						swal("Some Unknown Error Occurred!", "", "error").then(() => {
							// call back after work is update is done, comes here...
							closeEditing();
						});
					}
				}
			});

		}
	});

	function removeContact(elem) {
		// just for debugging...
		// elem is button inside, on which this function is implemented when on click...
		// elem -> parent node is current td...
		// current td -> parent node is current tr...
		// current tr -> parent node is current tables...
		// to get current row's index -> pass current tr...
		let current_tr = elem.parentNode.parentNode;
		let current_tbl = elem.parentNode.parentNode.parentNode;
		let index = $("#contactDetails_tbl tr").index(current_tr);
		// quick debug...
		// alert(index);
		// since at least one contact is mandatory...
		// to get how many rows in current table -> pass current table
		let total_rows = current_tbl.rows.length;
		if (total_rows > 1) { // if total rows > 1 -> means at least one contact is there...
			// delete any clicked contact...
			document.getElementById("contactDetails_tbl").deleteRow(index);
		} else { // otherwise....
			// give error...
			swal("Cannot perform this action!", "At least one contact detail is mandatory!", "error").then(() => {
				// some call back goes here...
			})
		}
	}

	$("#editContactAdd").click(function() {
		if (!addingContact) {
			$("#contactTbl").append('<tr><td> <div id="mobilenoE" name="mobileno" class="error"> </div> <input  id="intermediate" placeholder="+91-9999999999" required /></td><td><button type="button" class="btn btn-success" onclick="addContact()">Add</button></td></tr>');
			addingContact = true;
		} else {
			swal("Complete this action fisrt!", "Please finish adding one contact first.", "warning").then(() => {
				// some callbaks to be called here if any...
			});
		}
	});

	function addContact() {

		let flag = 1;

		var mobileNumber = document.getElementById("intermediate");
		var mobileno = document.getElementById("mobilenoE");
		var regexm = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
		if (regexm.test(mobileNumber.value)) {
			mobileno.innerHTML = "";
			// return true;
		} else {
			mobileno.innerHTML = "*Invalid Mobile Number";
			flag = 0;
			// return false;
		}

		if (flag==1) {
			let newContact = $("#intermediate").val();
			let index = document.getElementById("contactDetails_tbl").rows.length;
			document.getElementById("contactDetails_tbl").deleteRow(index - 1);
			$("#contactTbl").append('<tr class="contacts"><td>' + newContact + '</td><td><button type="button" class="close" aria-label="Close" onclick="removeContact(this)"><span aria-hidden="true">&times;</span> </button></td>');
			addingContact = false;
		}

	}
	// edit contact details function ends here...

	// edit banks details functions starts from here ...
	$("#editBanks").click(function(e) {
		if (!editingBank) {
			$("#editBankAdd").removeClass("invisible");
			$("#bank_header").append('<th scope="col">Remove</th>');
			$(".banks").append('<td><button type="button" class="close" aria-label="Close" onclick="removeBank(this)"><span aria-hidden="true">&times;</span></button></td>');
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
			console.log(existing_banks);
			console.log(other_banks);
			let form = new FormData();
			form.append('existing_bank', existing_banks);
			form.append('other_banks', other_banks);
			form.append('c_id', currentBanksId);

			$.ajax({
				method: 'POST',
				processData: false,
				contentType: false,
				cache: false,
				enctype: 'multipart/form-data',
				url: `<?php echo base_url() ?>VendorManagement/editBanks`,
				data: form,
				success: function(response) {
					swal("Updated Bank Details Successfully!", "", "success").then(() => {
						closeBankEditing();
					});
				},
			});
		}
	});

	function removeBank(elem) {
		let current_tr = elem.parentNode.parentNode;
		let current_tbl = elem.parentNode.parentNode.parentNode;
		let index = $("#bankDetails_tbl tr").index(current_tr);
		current_tbl = document.getElementById("bankDetails_tbl");
		let bankId = current_tbl.rows[index].cells[0].innerHTML;
		let total_rows = current_tbl.rows.length;

		if (total_rows > 2) {
			let form = new FormData();
			form.append('c_id', bankId);
			$.ajax({
				method: 'POST',
				processData: false,
				contentType: false,
				cache: false,
				enctype: 'multipart/form-data',
				url: `<?php echo base_url() ?>VendorManagement/checkBank`,
				data: form,
				success: function(response) {
					if (response == "BANK NOT IN PAYOUT") {
						document.getElementById("bankDetails_tbl").deleteRow(index);
						// swal("Bank Details Has Been Updated!", "", "success").then(() => {

						// });
					} else {
						swal("Cannnot delete this bank details!", "This bank is in payout processing!", "error").then(() => {
							// some call back goes here...
						});
					}
				}
			});
		} else {
			swal("Cannot perform this action!", "At least one bank detail is mandatory!", "error").then(() => {
				// some call back goes here...
			});
		}
	}

	function closeBankEditing() {
		editingBank = false;
		addingBank = false;
		$("#bankDetails_tbl tbody tr td").filter(':nth-child(5)').remove();
		$("#bankDetails_tbl thead tr th").filter(':nth-child(5)').remove();
		$("#editBankAdd").addClass("invisible");
		$("#editBanks").html("Edit Banks");
	}

	$("#editBankAdd").click(function() {
		if (!addingBank) {
			$("#bankTbl").append('<tr><td><input type="text" id="intermediateBankname" required /></td><td><input type="text" id="intermediateIfsc" required /></td><td><input type="text" id="intermediateAccountNum" required /></td><td><input type="text" id="intermediateAccountStat" required /></td><td><button type="button" class="btn btn-success" onclick="addBank()">Add</button></td></tr>');
			addingBank = true;
		} else {
			swal("Complete this action fisrt!", "Please finish adding one bank first.", "warning").then(() => {
				// some callbaks to be called here if any...
			});
		}
	});

	function addBank() {
		addingBank = false;
		let bank_n = $("#intermediateBankname").val();
		let ifsc = $("#intermediateIfsc").val();
		let acc_no = $("#intermediateAccountNum").val();
		let acc_stat = $("#intermediateAccountStat").val();

		let index = document.getElementById("bankDetails_tbl").rows.length;
		document.getElementById("bankDetails_tbl").deleteRow(index - 1);
		$("#bankTbl").append('<tr class="banks"><td>' + bank_n + '</td><td>' + ifsc + '</td><td>' + acc_no + '</td><td>' + acc_stat + '</td><td><button type="button" class="close" aria-label="Close" onclick="removeBank(this)"><span aria-hidden="true">&times;</span></button></td></tr>');
	}

	// edit banks details functions ends from here...


	$(document).ready(function() {
		var postURL = "/addmore.php";
		//   <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>
		// for add vendor modal...
		$('#add').click(function() {
			i++;
			$('#dynamic_field').append('<tr id="row1' + i + '" class="dynamic-added"> <td><b>Enter Your Another Bank  Account  Details </b> </td></tr>',
				'<tr id="row2' + i + '" class="dynamic-added"><td>Bank Name : <input type="text" name="c_bankname[]" placeholder="Enter your Bank Name" class="form-control name_list" required="" /></td></tr>',
				'<tr id="row3' + i + '" class="dynamic-added"><td> IFSC Code : <input type="text" name="c_ifsc[]" placeholder="Enter your IFSC Code" class="form-control name_list" required="" /></td></tr>',
				'<tr id="row4' + i + '" class="dynamic-added"><td>Account Number : <input type="text" name="c_accountno[]" placeholder="Enter your Account Number" class="form-control name_list" required="" /></td></tr>',
				'<tr id="row5' + i + '" class="dynamic-added"><td>Account Status : <input type="text" name="c_status[]" placeholder="Enter your Account status" class="form-control name_list" required="" /></td></tr>',
				'<tr id="row6' + i + '" class="dynamic-added"><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Remove</button></td></tr>',
			);
		});

		$('#addx').click(function() {
			i++;
			$('#dynamic_fieldx').append('<tr id="row1' + j + '" class="dynamic-added"> <td><b>Enter Your Another Bank  Account  Details </b> </td></tr>',
				'<tr id="row2' + j + '" class="dynamic-added"><td>Bank Name : <input type="text" name="c_bankname[]" placeholder="Enter your Bank Name" class="form-control name_list" required="" /></td></tr>',
				'<tr id="row3' + j + '" class="dynamic-added"><td> IFSC Code : <input type="text" name="c_ifsc[]" placeholder="Enter your IFSC Code" class="form-control name_list" required="" /></td></tr>',
				'<tr id="row4' + j + '" class="dynamic-added"><td>Account Number : <input type="text" name="c_accountno[]" placeholder="Enter your Account Number" class="form-control name_list" required="" /></td></tr>',
				'<tr id="row5' + j + '" class="dynamic-added"><td>Account Status : <input type="text" name="c_status[]" placeholder="Enter your Account status" class="form-control name_list" required="" /></td></tr>',
				'<tr id="row6' + j + '" class="dynamic-added"><td><button type="button" name="remove" id="' + j + '" class="btn btn-danger btn_remove">Remove</button></td></tr>',
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


	});
</script>
</script>
<script type="text/javascript">
	function venDelete(id) {
		// alert(id);
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this vendor details!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: `<?php echo base_url(); ?>/VendorManagement/venDelete/${id}`,
						method: "POST",
						success: function(response) {
							// alert(response);
							if (response == "SUCCESS") {
								swal("Poof! Your vendor has been deleted!", {
									icon: "success",
								});
								loadVen();
							}
						}
					});
				} else {
					swal("Your vendor is safe!", {
						icon: "info",
					});
				}
			});
	}
	$(document).ready(function() {
		// <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>
		$('#add1').click(function() {
			k++;
			$('#dynamic_field1').append('<tr id="row11' + k + '" class="dynamic-added"> <td> <b>Enter Your Another Mobile Numbers </b></td></tr>',

				'<tr id="row22' + k + '" class="dynamic-added"> <td> Mobile Number :<div id="mobilenof' + k + '" name="mobileno" class="error"> </div> <input type="text" id="mobile_f" onkeyup="validationmobF()" name="c_contacts[]" placeholder="+91-9999999999" class="form-control name_list" required="" /> </td></tr>',
				'<tr id="row33' + k + '" class="dynamic-added"><td><button type="button" name="remove" id="' + k + '" class="btn btn-danger btn_remove">Remove</button></td></tr></tr>',

			);
		});

		$('#addy').click(function() {
			l++;
			$('#dynamic_fieldy').append('<tr id="row11' + l + '" class="dynamic-added"> <td> <b>Enter Your Another Mobile Numbers </b></td></tr>',
				'<tr id="row22' + l + '" class="dynamic-added"> <td>Mobile Number : <input type="text" name="c_contacts[]" placeholder="Enter your mobile number"class="form-control name_list" required="" /></td></tr>',
				'<tr id="row33' + l + '" class="dynamic-added"><td><button type="button" name="remove" id="' + l + '" class="btn btn-danger btn_remove">Remove</button></td></tr></tr>',

			);
		});

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			$('#row11' + button_id + '').remove();
			$('#row22' + button_id + '').remove();
			$('#row33' + button_id + '').remove();

		});

	});

	function bankDetails(id) {
		// let url = "";
		// id.forEach((id) => {
		// 	url += (id + "_");
		// });
		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>VendorManagement/getBankDetails/" + id,
			success: function(response) {
				// console.log(response);
				$("#bankTbl").html(response);
				currentBanksId = id;
			}
		});
	}

	function contactDetails(id) {
		// alert(id);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>VendorManagement/getContactDetails/" + id,
			success: function(response) {
				// alert(response);
				$("#contactTbl").html(response);
				currentVendorId = id;
			}
		});
	}

	function venUpdate(id) {
		$.ajax({
			method: "POST",
			url: "<?php echo base_url(); ?>VendorManagement/fetchVen/" + id,
			success: function(response) {
				// just for response, and quick debugging...
				console.log("Vendor Details :", (JSON.parse(response)));

				let data = JSON.parse(response);

				$("#ven").val(data.c_id);
				$("#edit_c_name").val(data.c_fname + " " + data.c_lname);
				$("#edit_c_nickname").val(data.c_nickname);
				$("#edit_c_address").text(data.c_address);
				$("#edit_c_gstno").val(data.c_gstno);
				$("#edit_c_panno").val(data.c_panno);
				$("#edit_c_email").val(data.c_email);
				$("#edit_c_designation").val(data.c_designation);
				$("#edit_c_tags").val(data.c_tags);
			}
		});
	}

	$("#addVen").submit(function(e) {
		e.preventDefault();
		const form = new FormData(document.getElementById('addVen'));
		var add = document.getElementById("c_address").value;
		form.append("c_address", add);
		// console.log(...form);
		$.ajax({
			method: 'POST',
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: `<?php echo base_url() ?>VendorManagement/addVendor`,
			data: form,
			success: function(response) {
				loadVen();
				// document.getElementById("addVen").reset();
			}
		});
	});

	function loadVen() {
		$.ajax({
			url: "<?php echo base_url() ?>VendorManagement/index",
			method: "POST",
			success: function(data) {
				// alert(data);
				$("#tblBody").html(data);
				$(document).ready(function() {
					$('#vendor').DataTable({
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
	loadVen();

	$("#editVenBasic").submit(function(e) {
		e.preventDefault();
		const form = new FormData(document.getElementById('editVenBasic'));
		let t_area = document.getElementById('edit_c_address');
		form.append(t_area.name, t_area.value);
		$.ajax({
			method: "POST",
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: `<?php echo base_url() ?>VendorManagement/editVendor`,
			data: form,
			success: function(response) {
				if (response == "SUCCESS") {
					swal("Basic Details Of Vendor Are Updates Successfully!", "", "success").then(() => {
						// call back function, after success something to be done... goes here...
						loadVen();
					});
				}
			}
		});
	});

	function validationGST() {

		var c_gstno = document.getElementById("c_gstno");
		var GSt = document.getElementById("GSt");
		var regexm = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/;
		if (regexm.test(c_gstno.value)) {
			GSt.innerHTML = "";
			return true;
		} else {
			GSt.innerHTML = "*Invalid GST Number";
			return false;
		}


	}

	function validationmob() {

		var mobileNumber = document.getElementById("c_contacts");
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

	function validationmobF() {

		var mobileNumber = document.getElementById("mobile_f");
		var mobileno = document.getElementById("mobilenof");
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

		var txtPANCard = document.getElementById("c_gstno");
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

	function validationGSTE() {

		var c_gstno = document.getElementById("edit_c_gstno");
		var GSt = document.getElementById("GStE");
		var regexm = /\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1}/;
		if (regexm.test(c_gstno.value)) {
			GSt.innerHTML = "";
			return true;
		} else {
			GSt.innerHTML = "*Invalid GST Number";
			return false;
		}


	}

	function validationmobE() {

		var mobileNumber = document.getElementById("c_contacts");
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

	function validationmobFE() {

		var mobileNumber = document.getElementById("mobile_f");
		var mobileno = document.getElementById("mobilenof");
		var regexm = /^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$/;
		if (regexm.test(mobileNumber.value)) {
			mobileno.innerHTML = "";
			return true;
		} else {
			mobileno.innerHTML = "*Invalid Mobile Number";
			return false;
		}


	}

	function validationPanE() {

		var txtPANCard = document.getElementById("edit_c_panno");
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
</script>

<!-- script table Data  -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

</body>

</html>