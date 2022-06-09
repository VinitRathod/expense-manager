<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div id="maincontent" class="contentblock" style="width:100%">



	<h4 class="text-blue text-center font-weight-bold" style="font-size: 20px">
		Vendor Management
	</h4>

	<div class="container">
		<br />

		<div class="col-lg-5 m-auto d-block">
			<form action="#" onsubmit="return validation()" class="bg-light">
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

				<div class="form-group" id="formField"></div>

				<input type="submit" name="submit" value="Submit" class="btn btn-primary" autocomplete="off" />
				<input type="reset" name="reset" value="Reset" class="btn btn-secondary" autocomplete="off" />
			</form>

			<br /><br />
		</div>
	</div>
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
</body>

</html>