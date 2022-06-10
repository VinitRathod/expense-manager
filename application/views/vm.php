<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock" style="width:100%">



	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold ml-5" style="font-size: 20px">
			Vendor Management
		</h2>
		<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#VMModal">
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

						<form action="#" onsubmit="return validation()" class="bg-light" name="add_name" id="add_name">
							<div class="form-group">
								<label class="font-weight-regular"> Vendor ID </label>
								<input type="text" name="vendorid" class="form-control" id="vendorId" autocomplete="off" disabled />
								<span id="vendorid" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="vendorname" class="font-weight-regular">
									Vendor Name
								</label>
								<input type="text" name="Vendorname" pattern="[a-z A-Z]{3,}" class="form-control" id="Vendorname" autocomplete="off" required />
								<span id="VName" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="nickname" class="font-weight-regular">
									Nick Name
								</label>
								<input type="text" name="nickname" pattern="[a-z A-Z]{3,}" class="form-control" id="nickname" autocomplete="off" required />
								<span id="NName" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="Address" class="font-weight-regular"> Address </label>
								<br />
								<textarea rows="4" cols="50" name="address" form="usrform" required>
						</textarea>
							</div>

							<div class="form-group">
								<label for="gst" class="font-weight-regular"> GST </label>
								<input type="text" name="gst" pattern="[a-z A-Z]{16}" minlength="16" class="form-control" id="gst" autocomplete="off" required />
							</div>
							<div class="form-group">
								<label for="pan" class="font-weight-regular"> PAN Number </label>
								<input type="text" name="pan" class="form-control" id="pan" autocomplete="off" required />
							</div>
							<div class="form-group">
								<label class="font-weight-regular"> Email </label>
								<input type="email" name="email" class="form-control" id="emails" autocomplete="off" />
								<span id="emailids" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label class="font-weight-regular"> Mobile Number </label>
								<input type="number" pattern="[0-9]{10}" maxlength="10" max="9999999999" step="1" name="mobile" class="form-control" id="mobileNumber" required />
								<span id="mobileno" class="text-danger font-weight-regular"> </span>
							</div>
							<div class="form-group">
								<label for="document" class="font-weight-regular"> Document </label>
								<input type="file" name="document" class="form-control" id="document" accept="application/pdf" />
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

		
	</div>
		<!-- BEGIN: Main Table  -->
		<div class="table-responsive-md mt-4 mr-2">
	<table class="table" >
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
  <tbody>
	  <tr>
  <td>1</td>
  <td>mahi</td>

  <td>Adfff</td>
  <td>16496495611</td>

  <td>.025.325.355</td>
  <td>gnfbvhnh</td>
  <td>bfid</td>

  <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bank">
  BankDetails
</button></td>
  <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contact">
ContactDetails
</button></td>
<td><a href="" style ="text-decoration : none">edit</a><a href="" style ="text-decoration : none">delete</a></td>
<!-- <td><img src="https://img.icons8.com/material-outlined/24/undefined/edit--v1.png"/><a href="" style ="text-decoration : none">edit</a><img src="https://img.icons8.com/ios-glyphs/30/undefined/filled-trash.png"/><a href="" style ="text-decoration : none">delete</a> -->
<!-- </td> -->
  
  </tr>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="table-responsive-md mt-4">
	<table class="table" >
    <thead >
    <tr>
	<th scope="col">Name</th>
	<th scope="col">Mobile Number</th>
	<th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
  <tr>
  <td>dff</td>
  <td>275425454</td>
  <td>ghfbgfgf@gg.com</td>
  </tr>
  <tr>
  <td>dff</td>
  <td>275425454</td>
  <td>ghfbgfgf@gg.com</td>
  </tr>
    
  </tbody>
</table>	
</div>
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <div class="table-responsive-md mt-4">
	<table class="table" >
    <thead >
    <tr>
	<th scope="col">Bank Name</th>
	<th scope="col">IFSC Code </th>
	<th scope="col">Account Number </th>
	<th scope="col">Account Status </th>
    </tr>
  </thead>
  <tbody>
  <tr>
  <td>cdusdgf</td>
  <td>mahdd4ei</td>
  <td>16496495611</td>
  <td>active</td>
  </tr>
  <tr>
  <td>cdusdgf</td>
  <td>mahdd4ei</td>
  <td>16496495611</td>
  <td>active</td>
  </tr>
  </tbody>
</table>	
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<!-- END: bank Details Table  -->
</div>

<script type="text/javascript">
	function validation() {
		var emails = document.getElementById("emails").value;

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
