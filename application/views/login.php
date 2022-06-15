<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Expense Management-Login</title>
  <!-- jQuery library -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style-side.css" />
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
          <div class="alert alert-danger" role="alert" id="alertBox" style="display: none;"></div>

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
    let form = new FormData(document.getElementById('loginForm'));
    $.ajax({
      url : "<?php echo base_url(); ?>LoginController/index",
      method : "POST",
      processData: false,
			contentType: false,
			cache: false,
			enctype: 'multipart/form-data',
      data : form,
      success: function(response) {
        let res = JSON.parse(response);
        // console.log(response);
        if(res['error']) {
          $("#alertBox").css("display","block");
          $("#alertBox").html("Check your username and password and try again!");
        } else {
          window.location = "<?php echo base_url(); ?>";
        }
      }
    });
  });
</script>
</html>