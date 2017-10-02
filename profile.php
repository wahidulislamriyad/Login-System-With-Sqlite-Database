<?php
require('_login.php');
require('dbconnect.php');
//Same as index.php
if (isset($_SESSION['UserData']['username'])) {
    $user = $_SESSION['UserData']['username'];
    $query = "SELECT email FROM users WHERE email = '$user'";
    foreach($db->query($query) as $data) {
        if ($user == $data['email']) {
            $query = "SELECT username FROM users WHERE email = '$user'";
            $user = '';
            foreach($db->query($query) as $data) {
                $user = $data['username'];
            }
        }
    }
} else {
    $user = base64_decode($_COOKIE["UserData"]);
    $query = "SELECT username FROM users WHERE email = '$user'";
    foreach($db->query($query) as $data) {
        $user = $data['username'];
    }
}
//------------------------------
$query = "SELECT name FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $name = $data['name'];
}
if (!isset($name)) {
    $query = "SELECT name FROM users WHERE email = '$user'";
    foreach($db->query($query) as $data) {
        $name = $data['name'];
    }
}


$query = "SELECT id FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $id = $data['id'];
}
$query = "SELECT password FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $password = base64_decode($data['password']);
}
$query = "SELECT email FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $email = $data['email'];
}
$query = "SELECT phone FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $phone = $data['phone'];
}
$query = "SELECT role FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $role = $data['role'];
}
$query = "SELECT name FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $name = $data['name'];
}
?>
<?php
$pp = "databases/pictures/$user.png";
if (!file_exists($pp)) {
    $pp = "databases/pictures/none.png";
}
?>
<!doctype html>
<html>
<head>
<script src="js/jquery-2.0.3.min.js" type="text/javascript"></script>
<script src="js/jquery.form.min.js"></script>
<script src="js/sweetalert.js"></script>
<link rel="stylesheet" href="css/sweetalert.css">
<link rel="stylesheet" href="css/btn-classes.css">
<!-- Profile Picture Upload Script -->
<script type="text/javascript">
		$(document).ready(function () {
			$('#uploadForm').submit(function (e) {
				if ($('#file').val()) {
					e.preventDefault();
					$('#progress-div').slideDown(900);
					$(this).ajaxSubmit({
						target: '#targetLayer',
						beforeSubmit: function () {
							$("#progress-bar").width('0%');
						},
						uploadProgress: function (event, position, total, percentComplete) {
							$("#progress-bar").width(percentComplete + '%');
							$("#progress-bar").html('<div id="progress-status">' + percentComplete + ' %</div>');
						},
						success: function () {
							$('.dot-drops').replaceWith('<input type="submit" id="btnSubmit" value="Submit" class="btnSubmit" />');
							$('#progress-div').slideUp(3000);
						},
						resetForm: true
					});
					return false;
				}
			});
		});
	</script>
<script>
//Profile picture auto submit script
function sF() {
	$('#uploadForm').submit();
}
</script>
<title>Stylish Deco Profile</title>
<link href="css/stylepp.css" rel='stylesheet' type='text/css' media="all" />
<link href="css/styleinput.css" rel='stylesheet' type='text/css' media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Stylish Deco Profile" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfonts-->
  <script src= "js/moment-2.2.1.js"></script>
<link href='//fonts.googleapis.com/css?family=Ubuntu:300,700italic,300italic,400,400italic,500,500italic,700' rel='stylesheet' type='text/css'>
<!--/webfonts-->
<!--Profile picture form-->
<script>
$(document).ready(function() { 
      $("#submit").click(function(event){ 
		  var id = $("#id").val();
		  var name = $("#name").val(); 
          var phone = $("#phone").val(); 
          var password = $("#password").val(); 
		  var passwordold = $("#passwordold").val(); 
		  $("#response").replaceWith('<div id="response">Updating...</div>');
		  $("#submit").slideUp();
          $("#response").load('change', {"id":id, "name":name,"phone":phone,"password":password,"passwordold":passwordold} ); 
		  $("#Form").slideUp();
      }); 
   });
</script>
</head>
<body>
<div class="UploadForm" hidden>
	<form id="uploadForm" action="upload.php" method="post">
		<div class="fileInput"><br><br>
			<input name="file" id="file" onchange="sF()" type="file" class="inputBox" required />
		</div><br>
		<p id="targetLayer"></p>
		<div id="progress-div">
			<div id="progress-bar"></div>
		</div>
	</form>
</div>
	<form method="POST" action="change" autocomplete="off">
		<input type="text" name="id" id="id" value="<?php echo $id; ?>" required hidden>
	<div class="wrap">
	<header>
		<h1>&nbsp;</h1>
	</header>
		<div class="profile">
			<div class="user">
				<div class="star"> </div>
				<div class="men">
				<label for="file"><img class="pp" height="100px" width="100px" src="<?php echo $pp; ?>"></label>
				</div>
				<label for="file" class="pencil"> </label>
					<div id="dd1" class="wrapper-dropdown-3" tabindex="1">
	<span><img src="images/menu.png" alt="Navbar"/></span>
			<ul class="dropdown">
				<li><a href="index">Home</a></li>
				<li><a href="#">Alarm</a></li>
				<li><a href="#">Dual Clock</a></li>
				<li><a href="#">Notes</a></li>
				<li><a href="#">Reminder</a></li>
				<li><a href="#">To-Do List</a></li>
				<li><a href="#">World Clock</a></li>
				<li><a href="logout">Logout</a></li>
			</ul>
			<script type="text/javascript">
				function DropDown(el) {
				this.dd = el;
				this.initEvents();
				}
				DropDown.prototype = {
				initEvents : function() {
				var obj = this;					
				obj.dd.on('click', function(event){
				$(this).toggleClass('active');
				event.stopPropagation();
				});	
				}
				}
				$(function() {
				var dd = new DropDown( $('#dd1') );
				$(document).click(function() {
				// all dropdowns
				$('.wrapper-dropdown-3').removeClass('active');
				});
				});
				function buttonVisible() {
					$('.button').slideDown();
				}
			</script>
			</div>
			<div class="clear"> </div>
			<h2><input type="text" class="name" name="name" id="name" onkeyup="buttonVisible()" value="<?php echo $name; ?>" required></h2>
			</div>
		</div>
		<div class="sub-profile">
			<div class="sp1">
				<div class="phone">
					<a href="tel:<?php echo $phone; ?>"><img src="images/ph.png" alt=""/></a>
				</div>
				<div class="ph-text">
					<span>Mobile</span>
					<p class="group"><input name="phone" id="phone" type="text" onkeyup="buttonVisible()" value="<?php echo $phone; ?>">
						<span class="highlight"></span>
						<span class="bar"></span></p>
				</div>
				<div class="msg">
					<a href="sms:<?php echo $phone; ?>"><img src="images/msg.png" alt=""/></a>
				</div>
				<div class="clear"> </div>
			</div>
			<div class="sp2">
				<div class="mail">
					<a href="mailto:<?php echo $email; ?>"><img src="images/mail.png" alt=""/></a>
				</div>
				<div class="mail-text">
					<span>E-mail</span>
					<p class="group"><?php echo $email; ?></p>
				</div>
				<div class="clip">
					<a href="mailto:<?php echo $email; ?>"><img src="images/clip.png" alt=""/></a>
				</div>
				<div class="clear"> </div>
			</div>
			<div class="sp2">
				<div class="mail">
					<label for="pw"><img src="images/pw.png" alt=""/></label>
				</div>
				<div class="mail-text">
					<span>Password</span>
					<p class="group"><input type="text" name="passwordold" id="passwordold" value="<?php echo $password; ?>" hidden required><input type="text" name="password" id="password" value="<?php echo $password; ?>" id="pw" onkeyup="buttonVisible()" data-type="password" required>
						<span class="highlight"></span>
						<span class="bar"></span></p>
				</div>
				<div class="clip">
					<label for="pw"><img src="images/edit.png" alt=""/></label>
				</div>
				<div class="clear"> </div>
			</div>
			</div>
			<div class="social">
		<ul align="right">
			<div id="response"></div>
			<li><input class="button" type="button" id="submit" value="Update" hidden></a></li>
			</ul>
			<div class="clear"> </div>
	</div>
		<div class="footer">
			<p>&nbsp;</p>
		</div>
	</form>
</body>
</html>