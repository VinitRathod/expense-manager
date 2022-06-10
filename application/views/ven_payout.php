<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock" style="width:100%">

	<div id="top-header" style="display:flex; justify-content:space-between">
		<h2 class="text-blue text-left font-weight-bold ml-5" style="font-size: 20px">
			Vendor Payout
		</h2>
		<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#VPModal">
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

						<form action="#" onsubmit="return validation()" class="bg-light" name="add_name" id="add_name">
							<div class="form-group">
								<label for="vendor"> Select Vendor :</label>
								<select id="vendor" name="course">
									<option value="v1">Vendor-1</option>
									<option value="v2">Vendor-2</option>
									<option value="v3">Vendor-3</option>
								</select>
								<span id="vendorid" class="text-danger font-weight-regular"> </span>
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
								<select id="ecategory" name="course">
									<option value="ev1">Vendorcat-1</option>
									<option value="ev2">Vendorcat-2</option>
									<option value="ev3">Vendorcat-3</option>
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

							<div class="form-group">
								<label class="font-weight-regular"> Payment Due Date</label>
								<input type="date" name="paydd" class="form-control" id="paydd" autocomplete="off" required />
								<span id="paymentdd" class="text-danger font-weight-regular">
								</span>
							</div>

							<div class="form-group">
								<label class="font-weight-regular"> Payment Mode</label><br />
								<input class="ml-3" type="radio" id="manual" name="fav_language" value="manual" />
								<label for="manual">Manual</label><br />
								<input class="ml-3" type="radio" id="schedule" name="fav_language" value="schedule" />
								<label for="schedule">Scheduled</label><br />
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

	<div class="table-responsive-md mt-4">
	<table class="table" >
    <thead>
    <tr>
	<th scope="col">Select Vendor </th>
	<th scope="col">Amount</th>
	<th scope="col">Invoice Number</th>
	<th scope="col">Expense category</th>
	<th scope="col">Document</th>
	<th scope = "col">References</th>
	<th scope="col">Payment Due Date</th>
	<th scope="col">Payment Mode</th>
	<th scope="col">Action</th>
	</tr>
  </thead>
  <tbody>
	  <tr>
  <td>ff</td>
  <td>454</td>
  <td>rfdf</td>
  <td>fdf</td>
  <td>dfsdf</td>
  <td>dfb</td>
 <td>dv</td>
 <td>dwd</td>
<td><a href="" style ="text-decoration : none">edit</a><a href="" style ="text-decoration : none">delete</a>
</td>
  </tr>
  </tbody>
</table>	
</div>
</div>

<script type="text/javascript">
	function validation() {}
</script>
</body>

</html>