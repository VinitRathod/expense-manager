<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock" style="width:80%">
	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold ml-5" style="font-size: 20px">
			Expense Management
		</h2>
		<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#EXPModal">
			Add New Expense
		</button>
	</div>

	<div class="container">
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
								<input type="text" name="expCode1" class="form-control" id="expCode" autocomplete="off" required />
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
								<textarea id="expDesc" rows="4" cols="50" name="expDesc" required>
            		</textarea>
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


	<div class="table-responsive-md mt-4" style="overflow-x:auto;">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Expense Code</th>
					<th scope="col">Expense Category</th>
					<th scope="col">Expense Description</th>
					<th scope="col">Select Expense Type</th>
					<th scope="col">Action</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1656</td>
					<td>5546sa</td>
					<td>dddyg</td>
					<td>vstyf</td>
					<td><a href="" style="text-decoration : none">edit</a> <a href="" style="text-decoration : none">delete</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
</body>
<script>
	function validation() {}
	
	$("#add_exp").submit(function(e){
		e.preventDefault();
		const form = new FormData(document.getElementById('add_exp'));
		console.log(...form);
		$.ajax({
			method: 'POST',
			processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
			url: "<?php echo base_url() ?>ExpenseManagement/addExpCat",
			data: form,
			success: function() {
				
			}
		});
	});

</script>
</html>