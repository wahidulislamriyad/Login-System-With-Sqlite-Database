<?php
require('dbconnect.php');
$sql =<<<EOF
CREATE TABLE users (id INT PRIMARY KEY     NOT NULL, username           TEXT    NOT NULL, password            TEXT     NOT NULL, name           TEXT    NOT NULL, email        TEXT     NOT NULL, phone        TEXT     NOT NULL, role        TEXT     NOT NULL, active        TEXT     NOT NULL, last         TEXT     NOT NULL);
EOF;
$db->beginTransaction();
$ret = $db->exec($sql);
if ($ret == '1') {
    echo 'Tables are created successfully';
} else {
    echo 'Could not create tables';
}
?>
