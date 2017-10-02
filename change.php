<?php
//Collects submitted data that sent using POST method
$id = $_POST['id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$password = base64_encode($_POST['password']);
$passwordold = base64_encode($_POST['passwordold']);


//Updates data to database
require('dbconnect.php');
$sql = "UPDATE users set name = '$name', phone='$phone', password = '$password' where ID=$id;";
$ret = $db->exec($sql);
if ($ret == '1') {
    echo '<script>swal("Done!","Everything is Updated","success");</script>'; /* Sweet alert is used to stylize */
} else {
    echo '<script>swal("Error!","Could not update databases","error");</script>'; /* Sweet alert is used to stylize */
}

//Check if password is changed then logs user out
if ($passwordold == $password) {} else {
    echo '<script>swal("Updated!","You have changed your password. You will be logged out in 5 seconds.","success");</script>'; /* Sweet alert is used to stylize */
    echo '<meta http-equiv="refresh" content="5; url=logout" />'; /* It will redirect user to logout page */
}
?>