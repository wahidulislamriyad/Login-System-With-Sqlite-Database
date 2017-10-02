<?php
require('dbconnect.php');
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
    echo "Phone = ". $row['phone'] ."<br>";
    echo "Role = ". $row['role'] ."<br>";
    echo "Active = ". $row['active'] ."<br>";
    echo "Last Activity =  ".$row['last'] ."<br><br>";
    }
?>