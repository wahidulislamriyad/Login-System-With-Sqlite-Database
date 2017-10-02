<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Day 001 Login Form</title>
  <script src="js/jquery-2.0.3.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js/sweetalert.js"></script>
  <link rel="stylesheet" href="css/sweetalert.css">
  <link rel="stylesheet" href="css/btn-classes.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

  <link rel="stylesheet" href="css/style.css">
<!-- Script for autofocus to login panel -->
<script>
$(document).ready(function() { 
	$('#user1').focus(); 
});
</script>
<!-- Jquery AJAX submit funcion -->
<script>
$(document).ready(function() { 
      $("#submit").click(function(event){ 
		  var name = $("#name").val();
		  var email = $("#email").val();
		  var username = $("#username").val();
		  var password = $("#password").val(); 
          $("#response").replaceWith('<div id="response">Processing...</div>');
          $("#response").load('signup', {"name":name,"email":email,"username":username,"password":password} ); 
		  $(".form").slideUp();
      }); 
   });
</script>

</head>

<body>
  <div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
			<form action="" method="POST" autocomplete="off">
				<div class="group">
					<label for="user1" class="label">Username Or Email</label>
					<input id="user1" name="username" type="text" class="input" required>
				</div>
				<div class="group">
					<label for="pass1" class="label">Password</label>
					<input id="pass1" name="password" type="text" class="input" data-type="password" required>
				</div>
				<div class="group">
					<input id="check" name="checkbox" value="checked" type="checkbox" class="check">
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<div class="group">
					<input type="submit" class="button" name="Submit" value="Sign In">
				</div>
			</form>
				<div class="group">
				    <center>
					<?php if (isset($msg)) {echo '<b><font color="red">'.$msg.'</font></b>';} ?>
					</center>
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="forgot-pass">Forgot Password?</a>
				</div>
			</div>
			<div class="sign-up-htm">
   				<div class="form">
				<div class="group">
					<label for="name" class="label">Name</label>
					<input id="name" type="text" class="input" required>
				</div>
				<div class="group">
					<label for="email" class="label">Email Address</label>
					<input id="email" type="email" class="input" required>
				</div>
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="username" type="text" class="input" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="password" type="text" class="input" data-type="password" required>
				</div>
				<div class="group">
					<input type="button" id="submit" name="Submit" class="button" value="Sign Up">
				</div>
				</div>
				<p id="response"></p>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Member?</a>
				</div>
			</div>
		</div>
	</div>
</div>
  
  
</body>
</html>
