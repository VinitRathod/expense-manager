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
								<span id="warn_amount" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="invoice" class="font-weight-regular">
									Invoice Number
								</label>
								<input type="number" name="invoice" class="form-control" pattern="[a-zA-Z0-9]{3,}" id="invoice" min="0" autocomplete="off" required />
								<span id="warn_invoice" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="ecategory"> Expense Category :</label>
								<select id="c_category" name="c_category" class="form-control">
									<!-- <option value="ev1">Vendorcat-1</option>
									<option value="ev2">Vendorcat-2</option>
									<option value="ev3">Vendorcat-3</option> -->
								</select>
								<span id="warn_category" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="document" class="font-weight-regular"> Document </label>
								<input type="file" name="document" class="form-control" id="document" accept="application/pdf" />
								<span id="warn_doc" class="text-danger font-weight-regular"> </span>
							</div>

							<div class="form-group">
								<label for="references" class="font-weight-regular">
									References
								</label>
								<input type="text" name="references" pattern="[a-z A-Z]{3,}" class="form-control" id="references" autocomplete="off" required />
								<span id="warn_ref" class="text-danger font-weight-regular">
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
								<span id="warn_tags" class="text-danger font-weight-regular"> </span>
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
			<div class="spinnerDIV" style="display: none;">
				<svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
					<circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
				</svg>
			</div>
			<div class="table-responsive-md mt-4" style="overflow-x:auto; z-index: -1;" id="tblBlur">
				<table class="table" id="payout">
					<thead>
						<tr>
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
	let csrf_token = "";
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
		if (csrf_token == "") {
			csrf_token = "<?= $csrf['value'] ?>";
		}
		$.ajax({
			url: "<?php echo base_url() ?>VendorPayout/getAllVen",
			method: "POST",
			data: {
				'<?= $csrf['name'] ?>': csrf_token,
			},
			success: function(response) {
				// alert(response);
				let res = JSON.parse(response);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$("#c_venid").html(res.response);
			}
		});
	}

	function getBanks(id) {
		// alert(id);
		if (csrf_token == "") {
			csrf_token = "<?= $csrf['value'] ?>";
		}
		$.ajax({
			url: "<?php echo base_url() ?>VendorPayout/getVendorBanks/" + id,
			method: "POST",
			data: {
				'<?= $csrf['name'] ?>': csrf_token,
			},
			success: function(response) {
				// alert(response);
				let res = JSON.parse(response);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$("#c_banks").html(res.response);
			}
		});
	}

	function getAllExpCat() {
		if (csrf_token == "") {
			csrf_token = "<?= $csrf['value'] ?>";
		}
		$.ajax({
			url: "<?php echo base_url(); ?>VendorPayout/getExpCat",
			method: "POST",
			data: {
				'<?= $csrf['name'] ?>': csrf_token,
			},
			success: function(response) {
				let res = JSON.parse(response);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$("#c_category").html(res.response);
			}
		});
	}

	$("#add_ven_payout").submit(function(e) {
		if (csrf_token == "") {
			csrf_token = "<?= $csrf['value'] ?>";
		}
		e.preventDefault();
		const form = new FormData(document.getElementById("add_ven_payout"));
		form.append('<?= $csrf['name'] ?>', csrf_token);
		$.ajax({
			method: "POST",
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: "<?php echo base_url(); ?>VendorPayout/addVenPay",
			data: form,
			success: function(response) {
				let res = JSON.parse(response);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				if (res.error) {
					for(let key in res.error) {
						console.log(key+" "+res.error[key]);
						$("#"+key).text(res.error[key]);
					}
				} else {
					if (res.response == "SUCCESS") {
						swal("Vendor Payout created successfully!", "Action succeed!", "success").then(() => {
							location.reload();
							// loadVenPayouts();
						});
					}
				}
			}
		});
	});

	function loadVenPayouts() {
		if (csrf_token == "") {
			csrf_token = "<?= $csrf['value'] ?>";
		}
		$.ajax({
			url: "<?php echo base_url(); ?>VendorPayout/getAllPayouts",
			method: "POST",
			data: {
				'<?= $csrf['name'] ?>': csrf_token,
			},
			success: function(response) {
				// alert(response);
				let res = JSON.parse(response);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				$("#tblBody").html(res.response);
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
	$(document).on('click', '.payout', function(ex) {
		if (csrf_token == "") {
			csrf_token = "<?= $csrf['value'] ?>";
		}
		console.log("clicked");
		let pbar;
		// alert("Payout Clicked")
		// console.log($(this).attr("id"));
		$.ajax({
			url: "<?php echo base_url(); ?>PayoutController/payOutVen/" + $(this).attr("id"),
			method: "POST",
			data: {
				'<?= $csrf['name'] ?>': csrf_token,
			},
			// data: $(this).val(),
			success: function(data) {
				// alert(data);
				console.log(data);
				let res = JSON.parse(data);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				// loadVenPayouts();
				location.reload();
			},
			beforeSend: function(ex) {
				$("#tblBlur").css("filter", "blur(4px)");
				$(".spinnerDIV").css("display", "block");
			},
			complete: function(ex) {
				$("#tblBlur").css("filter", "blur(0px)");
				$(".spinnerDIV").css("display", "none");
			},
		});
	});
</script>
<!-- script table Data  -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>

</html>