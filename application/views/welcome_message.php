<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employees List</title>

	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>
	<!-- <h1>Hello from the View</h1> -->
	<div class="container">
		<div class="clear-fix">
			<h3 style="float:left">All Employees</h3>
			<a href="<?php echo base_url(); ?>employeeManagement" class="btn btn-primary" style="float:right">Add Data</a>
		</div>
		<br>
		<?php if ($emp_details) : ?>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>PAN</th>
						<th>Mobile Number</th>
					</tr>
				<tbody>
					<?php foreach ($emp_details as $emps) : ?>

						<tr>
							<td><?php echo $emps->c_fname; ?> <?php echo $emps->c_lname ?></td>
							<td><?php echo $emps->c_panno ?></td>
							<td><?php echo $emps->c_contactno ?></td>
						</tr>

					<?php endforeach; ?>
				</tbody>
				</thead>
			</table>
		<?php else : ?>
			No Records Found
		<?php endif; ?>
	</div>
	<!-- Bootstrap JS CDN -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>

<!-- <?php
		print_r($emp_details);

		?> -->

</html>