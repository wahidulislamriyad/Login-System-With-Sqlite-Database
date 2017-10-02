<?php
if(!empty($_FILES)) {
    if(is_uploaded_file($_FILES['file']['tmp_name'])) {
        $sourcePath = $_FILES['file']['tmp_name'];
        //Requires Login Script
        require('_login.php');
        //Connects to Database
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

        $targetPath = "databases/pictures/".$user.".png"; //Storage location for userpics
        $type = mime_content_type($sourcePath);
        if (preg_match("/\bimage\b/i", $type)) {
            if(move_uploaded_file($sourcePath,$targetPath)) {
                echo '<meta http-equiv="refresh" content="0; url="profile.php />';
            } else {
                echo '<script>swal("Error", "Error uploading picture", "error");</script>';
            }
        } else {
            echo '<script>swal("Error", "Please choose a picture file", "error");</script>';
        }
    }
} else {
    echo '<script>swal("Error", "File is not attached!", "error");</script>';
}
?>