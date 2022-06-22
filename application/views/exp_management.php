<?php
defined('BASEPATH') or exit('No direct script access allowed');
$csrf = array(
	'name' => $this->security->get_csrf_token_name(),
	'value' => $this->security->get_csrf_hash(),
);
?>
<div id="maincontent" class="contentblock mr-4" style="width:80vw">
	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold ml-5" style="font-size: 20px">
			Expense Management
		</h2>
		<button type="button" class="btn btn-x mr-5" data-toggle="modal" data-target="#EXPModal">
			Add New Expense
		</button>
	</div>

	<div class="container" id="modalContainer">
		<!-- Modal -->
		<div class="modal fade" id="EXPModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form action="<?php echo base_url(); ?>ExpenseManagement/addExpCat" onsubmit="return validation()" id="add_exp" class="bg-light" method="post">
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
								<textarea id="expDesc" rows="4" cols="50" name="expDesc" required></textarea>
							</div>

							<div class="form-group">
								<label for="exptype"> Select Expense Type :</label>
								<select id="expType" name="expType">
									<option value="vendor">Vendor</option>
									<option value="employee">Employee</option>
								</select>
								<span id="warnExpType" class="text-danger font-weight-regular"> </span>
							</div>




							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" data-tw-dismiss="modal" />
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
						</form>




					</div>

				</div>
			</div>
		</div>
		<!-- modal end  -->
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

						<form onsubmit="return validation()" id="edit_exp" class="bg-light" method="post">
							<div class="Expid">
								<input type="text" name="ExpID" id="expId" hidden>
							</div>
							<div class="form-group">
								<label for="expid" class="font-weight-regular"> Expense Code </label>
								<input type="text" name="expCode" class="form-control" id="EditexpCode" autocomplete="off" required />
								<span id="warnExpCode" class="text-danger font-weight-regular">

								</span>
							</div>

							<div class="form-group">
								<label for="expcode" class="font-weight-regular">
									Expense Category
								</label>
								<input type="text" name="expCat" pattern="[a-z A-Z0-9]{1,}" class="form-control" id="EditexpCat" autocomplete="off" required />
								<span id="warnFExpCat" class="text-danger font-weight-regular">

								</span>
							</div>

							<div class="form-group">
								<label for="expdesc" class="font-weight-regular"> Expense Description </label>
								<br />
								<textarea id="EditexpDesc" rows="4" cols="50" name="expDesc" required></textarea>
							</div>

							<div class="form-group">
								<label for="exptype"> Select Expense Type :</label>
								<select id="EditexpType" name="expType">
									<option value="vendor">Vendor</option>
									<option value="employee">Employee</option>
								</select>
								<span id="warnExpType" class="text-danger font-weight-regular"> </span>
							</div>
							<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" data-tw-dismiss="modal" />
							<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="card" style="width: 95%;">
		<div class="card-body">
			<div class="table-responsive-md mt-4" style="overflow-x:auto;">
				<table class="table" id="expense">
					<thead>
						<tr>
							<th scope="col">Expense_Code</th>
							<th scope="col">Expense_Category</th>
							<th scope="col">Expense_Description</th>
							<th scope="col">Select_Expense_Type</th>
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
<script>
	function validation() {}
	let csrf_token = "";
	$("#add_exp").submit(function(e) {
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		e.preventDefault();
		const form = new FormData(document.getElementById('add_exp'));
		form.append("csrf_token", csrf_token);
		// console.log(...form);
		$.ajax({
			method: 'POST',
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: "<?php echo base_url() ?>ExpenseManagement/addExpCat",
			data: form,
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				swal("New Expense Category Added Successfully.", "Insert Action Succeed.", "success").then(() => {
					location.reload();
					// loadExp();
					// $("#expCode").val("");
					// $("#expCat").val("");
					// $("#expType").val("").change();
					// $("#expDesc").val("");
				});
			}
		});
	});

	function Reset() {

	}

	$("#edit_exp").submit(function(e) {
		// alert();
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		e.preventDefault();
		const form = new FormData(document.getElementById('edit_exp'));
		form.append('csrf_token', csrf_token);
		// console.log(form.get("ExpID"));
		let id = form.get("ExpID");
		$.ajax({
			method: 'POST',
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: "<?php echo base_url() ?>ExpenseManagement/expUpdate/" + id,
			data: form,
			success: function(data) {
				let res = JSON.parse(data);
				// console.log(res);
				if (res.csrf) {
					csrf_token = res.csrf;
				}
				swal("Expense Category Updated Successfully.", "Update Action Succeed.", "success").then(() => {
					// loadExp();
					location.reload()
					// expEdit(id);
				});
			}
		});
	});

	var csrf_token = "";
	function loadExp() {

		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}

		$.ajax({
			url: "<?php echo base_url() ?>ExpenseManagement/index",
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
					$('#expense').DataTable({
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
				$(".tblBody").html(res.response);
			}
		});
	}
	loadExp();

	function expEdit(id) {
		// alert(id);
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		$.ajax({
			url: "<?php echo  base_url(); ?>ExpenseManagement/editExp/" + id,
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
				// console.log(JSON.parse(response));
				// let data = JSON.parse(response);
				$("#EditexpCode").val(res.result.c_expcode);
				$("#EditexpCat").val(res.result.c_category);
				$("#EditexpType").val(res.result.c_type).change();
				$("#expId").val(res.result.c_expid);
				$("#EditexpDesc").html(res.result.c_description);
			}
		});
	}

	function expDelete(id) {
		if (csrf_token == "") {
			csrf_token = '<?= $csrf['value'] ?>';
		}
		swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this expense type!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: `<?php echo base_url(); ?>/ExpenseManagement/expDelete/${id}`,
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
								swal("Poof! Your expense type has been deleted!", {
									icon: "success",
								});
								loadExp();
							}
						}
					});
				} else {
					swal("Your expense type is safe!", {
						icon: "info",
					});
				}
			});
	}
</script>
<!-- script table Data  -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>

</html>