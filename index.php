<?php 
// Essential: Main login script to protect the page from unauthorized access
require('_login.php');

//Connects to Database
require('dbconnect.php');
if (isset($_SESSION['UserData']['username'])) {
    $user = $_SESSION['UserData']['username']; /* If isset $_SESSION, it will collect the username */
    $query = "SELECT email FROM users WHERE email = '$user'";
    foreach($db->query($query) as $data) {
        if ($user == $data['email']) {
            $query = "SELECT username FROM users WHERE email = '$user'";
            $user = '';
            foreach($db->query($query) as $data) {
                $user = $data['username']; /* If $_SESSION data is an email then it will fetch the username from database */
            }
        }
    }
} else {
    $user = base64_decode($_COOKIE["UserData"]);
    $query = "SELECT email FROM users WHERE email = '$user'"; /* If isset $_COOKIE, it will collect the username */
    foreach($db->query($query) as $data) {
        if ($user == $data['email']) {
            $query = "SELECT username FROM users WHERE email = '$user'";
            $user = '';
            foreach($db->query($query) as $data) {
                $user = $data['username']; /* If $_COOKIE data is an email then it will fetch the username from database */
            }
        }
    }
}
$query = "SELECT name FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $name = $data['name']; // Collects the name of the user
}
?>


Welcome <?php echo $name." ($user)" ?><br>

<?php
$query = "SELECT role FROM users WHERE username = '$user'";
foreach($db->query($query) as $data) {
    $role = $data['role']; // Role is to protect the content from guests or other users
}

if ($role == 'admin' || $role == 'user') { ?>

<!-- Protected content here -->
<p>Congratulation! You have logged into password protected page.</p>


<?php } elseif ($role == 'guest') { ?>

<!-- For guests -->
<mark>Note: Your account is not yet activated. Please contact <a target="_blank" href="https://www.facebook.com/wahidulislamriyad">administrator</a> to active.</mark>


<?php } ?>

<br>
<a href="logout">Logout</a><br><br>
<a href="profile">Profile</a><br>