<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Expense Management-Login</title>
  <!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style-side.css" />
 </head>

<body>
  <div class="container-x">
    <!-- <div class="form-side">
      <h5>WELCOME TO</h5>
      <h1>Expense Management</h1>
    </div> -->

    <div class="main-container">
      <div class="form-container">
        <h4 class="title-xy"> WELCOME TO </h4>
      <h1 class="title-x"><b> Expense Management </b></h1>

        <div class="form-body">
          <h2 class="title"><b> LOG IN </b></h2>

          <form class="the-form" id="loginForm">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" />

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" />

            <input type="submit" value="Log In" />
          </form>
        </div>
        <!-- FORM BODY-->
      </div>
      <!-- FORM CONTAINER -->
    </div>
  </div>
  </div>
</body>
<script>
  $("#loginForm").submit(function(e){
    e.preventDefault();
    // alert();
  });
</script>
</html>