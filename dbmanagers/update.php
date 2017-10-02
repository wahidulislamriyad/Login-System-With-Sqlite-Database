<?php
require('dbconnect.php');
$sql =<<<EOF
UPDATE users set active = 'Yes' where ID=1;
EOF;
$ret = $db->exec($sql);
if ($ret == '1') {
    echo 'Updated successfully<br>';
} else {
    echo 'Could not update databases<br>';
}
$sql =<<<EOF
SELECT * from users;
EOF;
$ret = $db->query($sql);
foreach($ret as $row){
    echo "ID = ". $row['id'] . "<br>";
    echo "Username = ". $row['username'] ."<br>";
    echo "Password = ". $row['password'] ."<br>";
    echo "Name = ". $row['name'] ."<br>";
    echo "Email = ". $row['email'] ."<br>";
    echo "Role = ". $row['role'] ."<br>";
    echo "Active = ". $row['active'] ."<br>";
    echo "Last Activity =  ".$row['last'] ."<br><br>";
    }
?>
