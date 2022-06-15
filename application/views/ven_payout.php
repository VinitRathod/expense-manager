<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock mr-4" style="width:75vw">

	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold" style="font-size: 20px">
			Vendor Payout
		</h2>
		<button type="button" class="btn btn-x mr-5" data-toggle="modal" data-target="#VPModal">
			Add New Payout
		</button>
	</div>

	<div class="container">
		<!-- Modal -->
		<div class="modal fade" id="VPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Vendor Payout</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form onsubmit="return validation()" class="bg-light" name="add_name" id="add_ven_payout">
							<div class="form-group">
								<label for="vendor"> Select Vendor :</label>
								<select id="c_venid" name="c_venid" onchange="getBanks(this.value)" class="form-control">
									<!-- <option value="v1">Vendor-1</option>
									<option value="v2">Vendor-2</option>
									<option value="v3">Vendor-3</option> -->
								</select>
								<span id="warn_c_venid" class="text-danger font-weight-regular"> </span>
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

							<div class="form-group">
								<label for="amount" class="font-weight-regular"> Amount </label>
								<input type="number" name="amount" class="form-control" id="amount" min="0" autocomplete="off" required />
								<span id="amount-s" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="invoice" class="font-weight-regular">
									Invoice Number
								</label>
								<input type="number" name="invoice" class="form-control" pattern="[a-zA-Z0-9]{3,}" id="invoice" min="0" autocomplete="off" required />
								<span id="amount-s" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="ecategory"> Expense Category :</label>
								<select id="c_category" name="c_category" class="form-control">
									<!-- <option value="ev1">Vendorcat-1</option>
									<option value="ev2">Vendorcat-2</option>
									<option value="ev3">Vendorcat-3</option> -->
								</select>
								<span id="vendorid" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="document" class="font-weight-regular"> Document </label>
								<input type="file" name="document" class="form-control" id="document" accept="application/pdf" />
							</div>

							<div class="form-group">
								<label for="references" class="font-weight-regular">
									References
								</label>
								<input type="text" name="references" pattern="[a-z A-Z]{3,}" class="form-control" id="references" autocomplete="off" required />
								<span id="Reference" class="text-danger font-weight-regular">
								</span>
							</div>

							<!-- <div class="form-group">
								<label class="font-weight-regular"> Payment Due Date</label>
								<input type="date" name="paydd" class="form-control" id="paydd" autocomplete="off" required />
								<span id="paymentdd" class="text-danger font-weight-regular">
								</span>
							</div> -->

							<div class="form-group">
								<label class="font-weight-regular"> Payment Mode</label><br />
								<input class="ml-3" type="radio" id="manual" name="pay_mode" value="manual" />
								<label for="manual">Manual</label><br />
								<input class="ml-3" type="radio" id="schedule" name="pay_mode" value="schedule" />
								<label for="schedule">Scheduled</label><br />
								<div id="payment-mode-schedule">

								</div>
							</div>

							<div class="form-group">
								<label for="Tag" class="font-weight-regular">
									Tags
								</label>
								<input type="text" name="Tags" pattern="[a-z A-Z]{1,}" class="form-control" id="Tags" autocomplete="off" required />
								<br />

							</div>

							<!-- ...  -->

							<div class="form-group" id="formField"></div>

							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
						</form>





					</div>

				</div>
			</div>
		</div>
		<!-- modal end  -->

	</div>

	<div class="card" style="width: 95%;">
		<div class="card-body">
			<div class="table-responsive-md mt-4" style="overflow-x:auto;">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Vendor ID</th>
							<th scope="col">Vendor Name</th>
							<th scope="col">Amount</th>
							<th scope="col">Payment Processing Date</th>
							<th scope="col">Payment Mode</th>
							<th scope="col">Payment Status</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody id="tblBody">
						<!-- <tr>
							<td>ff</td>
							<td>454</td>
							<td>rfdf</td>
							<td>fdf</td>
							<td>dfsdf</td>
							<td>dfb</td>
							<td>dv</td>
							<td>dwd</td>
							<td>
								<div class="dropdown">
									<button class="btn btn-x dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										...
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">Edit</a>
										<a class="dropdown-item" href="#">Delete</a>

									</div>
							</td>
						</tr> -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function validation() {}
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

		loadVenPayouts();
		loadAllVen();
		getAllExpCat();
	});

	function loadAllVen() {
		$.ajax({
			url: "<?php echo base_url() ?>VendorPayout/getAllVen",
			method: "POST",
			success: function(response) {
				// alert(response);
				$("#c_venid").html(response);
			}
		});
	}

	function getBanks(id) {
		// alert(id);
		$.ajax({
			url: "<?php echo base_url() ?>VendorPayout/getVendorBanks/" + id,
			method: "POST",
			success: function(response) {
				// alert(response);
				$("#c_banks").html(response);
			}
		});
	}

	function getAllExpCat() {
		$.ajax({
			url: "<?php echo base_url(); ?>VendorPayout/getExpCat",
			method: "POST",
			success: function(response) {
				$("#c_category").html(response);
			}
		});
	}

	$("#add_ven_payout").submit(function(e) {
		e.preventDefault();
		const form = new FormData(document.getElementById("add_ven_payout"));
		$.ajax({
			method: "POST",
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: "<?php echo base_url(); ?>VendorPayout/addVenPay",
			data: form,
			success: function(response) {
				if (response == "SUCCESS") {
					swal("Vendor Payout created successfully!", "Action succeed!", "success").then(() => {
						loadVenPayouts();
					});
				}
			}
		});
	});

	function loadVenPayouts() {
		$.ajax({
			url: "<?php echo base_url(); ?>VendorPayout/getAllPayouts",
			method: "POST",
			success: function(response) {
				// alert(response);
				$("#tblBody").html(response);
			}
		});
	}
</script>
</body>

</html>