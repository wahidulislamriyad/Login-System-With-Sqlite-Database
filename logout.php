<?php
session_start(); /* Starts the session */

//Connects to Database 
require('dbconnect.php');

if (isset($_SESSION['UserData']['username'])) {
    $user = $_SESSION['UserData']['username'];
    $query = "SELECT email FROM users WHERE email = '$user'";
    foreach($db->query($query) as $data) {
        if ($user == $data['email']) {
            $query = "SELECT username FROM users WHERE email = '$user'";
            $user = '';
            foreach($db->query($query) as $data) {
                $user = $data['username']; //If email was used to login, then it will fetch the username from database
            }
        }
    }
} else {
    $user = base64_decode($_COOKIE["UserData"]);
    $query = "SELECT email FROM users WHERE email = '$user'";
    foreach($db->query($query) as $data) {
        if ($user == $data['email']) {
            $query = "SELECT username FROM users WHERE email = '$user'";
            $user = '';
            foreach($db->query($query) as $data) {
                $user = $data['username']; //If email was used to login, then it will fetch the username from database
            }
        }
    }
}

if (isset($_SESSION['UserData']['username'])) {
    $username = $user;
    $sql = "UPDATE users SET active = 'No' WHERE username='$username'"; // Updates user as Inactive
    $db->exec($sql);
    $last = date("g:i A, j F o", time());
    $sql = "UPDATE users SET last = '$last' WHERE username='$username'"; // Stores last activity of the user
    $db->exec($sql);
    session_destroy(); /* Destroy started session */
} else {
    $username = $user;
    $sql = "UPDATE users SET active = 'No' WHERE username='$username'"; // Updates user as Inactive
    $db->exec($sql);
    $last = date("g:i A, j F o", time());
    $sql = "UPDATE users SET last = '$last' WHERE username='$username'"; // Stores last activity of the user
    $db->exec($sql);
    setcookie( "UserData", "", time()- 60, "/","", 0); //$_COOKIE expires
}
echo '<meta http-equiv="refresh" content="0; url=login" />';
exit;
?>