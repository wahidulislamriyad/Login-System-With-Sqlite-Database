<?php
//Collects form data using $_POST method
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$password64 = base64_encode($password);
//Connects to SQLite3 DB
require('dbconnect.php');
//Loads the config
require('databases/config.php');
//Sets some temp variavles for continue
$next1 = '';
$next2 = '';

//Checks if given email exists in DB
$query = "SELECT email FROM users WHERE email LIKE '$email'";
foreach($db->query($query) as $data) {
    if ($email == $data['email']) {
        //On found sets temp data 'emailfound'
        $next1 = $next1.'emailfound';
    }
}

//Check if given username exists in DB
$query = "SELECT username FROM users WHERE username LIKE '$username'";
foreach($db->query($query) as $data) {
    if ($username == $data['username']) {
        //On found sets temp data 'userfound'
        $next2 = $next2.'userfound'; 
    }
}

//Now check that if it will continue or not
if (!preg_match("/\bemailfound\b/i", $next1)) {
    if (!preg_match("/\buserfound\b/i", $next2)) {
        //Sign up process here
        $count = '0';
        $query = "SELECT username FROM users";
        foreach($db->query($query) as $data) {
            $count = $count + 1;
        }
        $count = $count + 1;
        $sql = "INSERT INTO users (id,username,password,name,email,phone,role,active,last) VALUES ($count, '$username', '$password64', '$name',  '$email','+', 'guest', 'No', 'Never' );";
        $ret = $db->exec($sql);
        $body = "Hi $name,\r\n
        This is an automated message to let you know that someone signed up at $domain_name with the user name '$username', using this email address as mailing address.\r\n
        Password for username '$username' is:\r\n\r\n
        '$password'\r\n\r\n
        However, if you ever forget your password, you can click the 'I forgot my password' link in the log-in section for $domain_name and you will be sent an email containing older, ridiculously long and complicated password that you can use to log in. You can change your password after logging in, but that's up to you. No one's going to guess it, or brute force it, but if other people can read your emails, it's generally a good idea to change passwords.\r\n
        If you were not the one to register this account, you can either contact us the normal way or —much easier— you can ask the system to reset the password for the account, after which you can simply log in with the temporary password and delete the account. That'll teach whoever pretended to be you not to mess with you!\r\n
        Of course, if you did register it yourself, welcome to $domain_name!\r\n\r\n
        - the $domain_name team\r\n";
        $from_name = "X-Mailer: PHP/" . phpversion() . " of $domain_name";
        $from_mail = $from_email;
        $to = $email;
        $subject = "You new account has been created - $domain_name";
        $mail_body = $body;
        $message = $mail_body ;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "From: ".$from_name." <".$from_mail.">\r\n";
        $sendmail=mail($to,$subject,$message,$headers);
        if(!$sendmail)
        {
            $mailerror = "But something didn't worked correctly";
        } else {
            $mailerror = '';
        }
        if ($ret == '1') {
            echo '<font color="green"><h4>Your new account has created successfully.<br>'.$mailerror.'<br>You can sign in now. But your account is not activated.<br>To activate Your account, please contact with <a href="https://www.facebook.com/wahidulislamriyad" target="_blank">administrator</a>.</h4></font><br><label for="tab-1">Click here to Sign In</label>';
        } else {
            echo '<font color="red"><b><h2>Error</h2></b></font><br><h5><p>Something went wrong. <br> Please try later.</p></h5>';
        }
    } else {
        echo "<font color='orange'><b><h4>Your given username $username already exists in our Database. It could not be used to recreate.<br></h4></b></font><br><script>$('.form').slideDown();</script>";
    }
} else {
        echo "<font color='orange'><b><h4>Your email $email already exists in our Database. It could not be used to recreate.<br></h4></b></font><br><script>$('.form').slideDown();</script>";
}
?>