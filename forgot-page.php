<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Day 001 Forgot Form</title>
    <script src="js/jquery-2.0.3.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>

    <link rel="stylesheet" href="css/style.css">
<!-- Autofocus to input on body load -->
<script>
$(document).ready(function() { 
	$('#email').focus(); 
});
</script>
<!-- Jquery AJAX submit function -->
<script>
$(document).ready(function() { 
      $("#submit").click(function(event){ 
		  var email = $("#email").val(); 
          $("#response").replaceWith('<div id="response">Sending...</div>');
          $("#response").load('forgot', {"email":email} ); 
		  $(".form").slideUp();
      }); 
   });
</script>

</head>

<body>
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Forgot Password</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up" hidden><label class="tab" hidden><a href="../login">Sign In</a></label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <div class="group form">
                        <label for="user" class="label">Email</label>
                        <input id="email" type="text" class="input">
                    </div>
                    <div class="group form">
                        <input type="button" id="submit" class="button" value="Send Code">
                    </div>
                    <div class="group">
                        <b id="response"></b>
                    </div>
                    <div class="hr"></div>
                </div>
                <div class="sign-up-htm">
                <form action="" method="POST" autocomplete="off">
                    <div class="group">
                        <label for="user" class="label">Username Or Email</label>
                        <input id="user" name="username" type="text" class="input" required>
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" name="password" type="password" class="input" data-type="password" required>
                    </div>
                    <div class="group">
                        <input id="check" name="checkbox" value="checked" type="checkbox" class="check">
                        <label for="check"><span class="icon"></span> Keep me Signed in</label>
                    </div>
                    <div class="group">
                        <input type="submit" class="button" name="Submit" value="Sign In">
                    </div>
                </form>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <label for="tab-1">Forgot Password?</a>
				</div>
			</div>
		</div>
	</div>
</div>
  
  
</body>
</html>