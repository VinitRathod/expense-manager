<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock" style="width:100%">

	<h4 class="text-blue text-center font-weight-bold" style="font-size: 20px">
		Vendor Payout
	</h4>

	<div class="container">
		<br />

		<div class="col-lg-5 m-auto d-block">
			<form action="#" onsubmit="return validation()" class="bg-light">
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

			<br /><br />
		</div>
	</div>
</div>
<script type="text/javascript">
	function validation() {}
</script>
</body>

</html>