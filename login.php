<?php
/* A Simple and Stylish Login System with SQLite by Wahidul Islam Riyad
*/


/* Check Login form submitted */	
if(isset($_POST['Submit'])){		
		/* Check and assign submitted Username and Password to new variable */
		$username = $_POST['username'];
    $password = base64_encode($_POST['password']); /* Password is encoded using base64 */

    if (isset($_POST['checkbox'])) {
      $checkbox = $_POST['checkbox'];
    } else {
      $checkbox = '';
    }
        
    // Connects to Dabtabase
    require('dbconnect.php');
    $next = '';    
    $query = "SELECT username FROM users";
    foreach($db->query($query) as $data) {
      if($username == $data["username"]) {
        $next = $next." userfound"; /* Check which is found (Username or Email) */
      }
    }
    $query = "SELECT email FROM users";
    foreach($db->query($query) as $data) {
      if($username == $data["email"]) {
        $next = $next." emailfound"; /* Check which is found (Username or Email) */
      }
    }
    if (preg_match("/\buserfound\b/i", $next)) {
      /* Fetch username and associated password from the database */
      $query = "SELECT password FROM users WHERE username = '$username'";
      foreach($db->query($query) as $data) {
        if($password == $data["password"]) {
          // Success: Set session variables and redirect to Protected page
          if ($checkbox == 'checked') {
            $username_base64 = base64_encode($username);
            setcookie("UserData", $username_base64, time()+78840000, "/","", 0); // If remember me option is selected, it will login the user with the $_COOKIE
          } else { 
            $_SESSION['UserData']['username']=$username; // If remember me option is not selected, it will login the user with the $_SESSION
          }
          $sql = "UPDATE users SET active = 'Yes' WHERE username='$username'"; // Updates user as Active
          $db->exec($sql);
          $last = date("g:i A, j F o", time());
          $sql = "UPDATE users SET last = '$last' WHERE username='$username'"; // Stores last activity of the user
          $db->exec($sql);
          echo '<meta http-equiv="refresh" content="0; url=index" />'; // Redirects to currect page using meta tag
          exit;
        }
        $msg = '<script>swal("Error", "Invalid Password for Username '.$username.'", "error");</script>';
      }
    }
    if (preg_match("/\bemailfound\b/i", $next)) {
      /* Fetch username of the email and associated password from the database */
      $query = "SELECT password FROM users WHERE email = '$username'";
      foreach($db->query($query) as $data) {
        if($password == $data["password"]) {
          // Success: Set session variables and redirect to Protected page 
          if ($checkbox == 'checked') {
            $username_base64 = base64_encode($username);
            setcookie("UserData", $username_base64, time()+78840000, "/","", 0); // If remember me option is selected, it will login the user with the $_COOKIE
          } else {
            $_SESSION['UserData']['username']=$username; // If remember me option is not selected, it will login the user with the $_SESSION
          }
          $sql = "UPDATE users SET active = 'Yes' WHERE email='$username'"; // Updates user as Active
          $db->exec($sql);
          $last = date("g:i A, j F o", time());
          $sql = "UPDATE users SET last = '$last' WHERE email='$username'"; // Stores last activity of the user
          $db->exec($sql);
          echo '<meta http-equiv="refresh" content="0; url=index" />'; // Redirects to currect page using meta tag
          exit;
        }
        $msg = '<script>swal("Error", "Invalid Password for Email '.$username.'", "error");</script>';
      }
    }
    if (!isset($msg)) {
      $msg = '<script>swal("Error", "Invalid Username or Email", "error");</script>';
    }
}
include('login-page.php'); // Login Page
exit;
?>