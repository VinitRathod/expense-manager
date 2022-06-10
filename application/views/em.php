<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<div id="maincontent" class="contentblock" style="width:100%">

	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold ml-5" style="font-size: 20px">
			Employee Management
		</h2>
		<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#exampleModal">
			Add Employee
		</button>
	</div>


	<div class="container">
		<!-- Button trigger modal -->
		

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Employee Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form action="<?php echo base_url(); ?>add" method="post" onsubmit="return validation()" name="add_name" id="add_name" class="bg-light">
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
								<!-- ...  -->


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
	<!-- BEGIN: Main Table  -->
	<div class="table-responsive-md mt-4">
	<table class="table" >
    <thead>
    <tr>
	<th scope="col">Employee ID</th>
	<th scope="col">Employee Name</th>
	<th scope="col">PAN Number</th>
	<th scope="col">Mobile Number</th>
	<th scope="col">Bank Details</th>
	<th scope="col">Contact Details</th>
	<th scope="col">Designation</th>
	<th scope="col">Tags</th>
    </tr>
  </thead>
  <tbody>
	  <tr>
  <td>1</td>
  <td>mahi</td>
  <td>16496495611</td>
  <td>5445645644</td>
  <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bank">
view Bank Details
</button></td>
  <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contact">
view Contact Details
</button></td>
  <td>bfid</td>
  <td>dvtyf</td>
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
<!-- </body>

</html> -->