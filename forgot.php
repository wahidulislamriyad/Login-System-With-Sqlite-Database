<?php 
//Collects the submitted email from forgot-page
$email = $_POST['email'];

//Connects to Database
require('dbconnect.php');

//
require('databases/config.php');

//Check if given email exists on the database
$query = "SELECT email FROM users";
$next = '';
foreach($db->query($query) as $data) {
  if($email == $data["email"]) {
    $query = "SELECT password FROM users WHERE email = '$email'";
    foreach($db->query($query) as $data) {
        $pass = $data['password'];
        $next = 'userfound'; /* If email is found then is logs in $next variable */
    }
  } elseif (!$email == $data["email"]) {
      $next = '0'; /* If email is not found then is logs 0 in $next variable */
  }
}
if (!preg_match("/\buserfound\b/i", $next)) {
    echo "<font color='orange'><b><h4>This email doesn't not seems to be registered on this site.</h4></b></font><br><script>$('.form').slideDown();</script>";
    exit; /* If 'userfound' string doesn't match with log variavle $next then will exit by a message */
}
$query = "SELECT username FROM users WHERE email = '$email'";
foreach($db->query($query) as $data) {
    $username = $data['username']; /* If user is found then it will collect username from database */
}
$query = "SELECT name FROM users WHERE email = '$email'";
foreach($db->query($query) as $data) {
    $name = $data['name']; /* It will collect also the name of user */
}

// Email body for the email
$body = "Hi $name,\r\n
This is an automated message to let you know that someone requested a password reset for the $domain_name user account with user name '".$username."', which is linked to this email address.\r\n
We've sent you your account password, so make sure to copy/paste it without any leading or trailing spaces:\r\n\r\n
$pass\r\n\r\n
If you didn't even know this account existed, now is the time to log in and delete it. How dare people use your email address to register accounts! Of course, if you did register it yourself, but you didn't request the reset, some jerk is apparently reset-spamming. We hope he gets run over by a steam shovel driven by rabid ocelots or something.\r\n
Then again, it's far more likely that you did register this account, and you simply forgot the password so you asked for it yourself, in which case: here's your password, and thank you for your patronage at $domain_name!\r\n\r\n
- the $domain_name team
";

// Email headers
$from_name = "X-Mailer: PHP/" . phpversion() . " of $domain_name"; /* $donaim_name from the config.php in /databases */
$from_mail = $from_email; /* config.php */
$to = $email;
$subject = "Did you forgot you password? - $domain_name";
$mail_body = $body;
$message = $mail_body ;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "From: ".$from_name." <".$from_mail.">\r\n";
$sendmail=mail($to,$subject,$message,$headers);

// Sends the email with the password to the user
if($sendmail)
{
    echo '<font color="green"><h4>Hi '.$name.'.<br>We have sent your password to your email.<br>Please check out your inbox</h4></font><br><a href="index">Click here to Sign In</a>';
}
else
{
    echo '<font color="red"><b><h2>Error</h2></b></font><br>
    <h5>Could not send the mail.</h5><p>Something is not right..</p><br>
    <h5><p>Please try later</p></h5>';  
 }
?>