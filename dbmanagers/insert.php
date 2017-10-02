<?php
require('dbconnect.php');
$sql =<<<EOF
INSERT INTO users (id,username,password, name,email,phone,role,active,last)
VALUES (1, 'Riyad', 'riyad0123', 'Wahidul Islam Riyad',  'admin@r-server.com', '+1 (303) 499-7111', 'admin', 'No', '15 Sep' );

INSERT INTO users (id,username,password, name,email,phone,role,active,last)
VALUES (2, 'Guest', 'guestpass', 'Guest Users', 'guest@mail.com', '+111', 'guest', 'No', '28 Sep' );

INSERT INTO users (id,username,password, name,email,phone,role,active,last)
VALUES (3, 'User', 'psss', 'Another User', 'user@mail.com', '+111', 'user', 'No', '21 Sep' );
EOF;
$ret = $db->exec($sql);
if ($ret == '1') {
    echo 'Databases inserted successfully';
} else {
    echo 'Could not insert databases';
}
?>
