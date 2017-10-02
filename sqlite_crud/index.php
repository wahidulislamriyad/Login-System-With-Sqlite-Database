<?php

// Includs database connection
include "db_connect.php";

// Makes query with rowid
$query = "SELECT id, * FROM users";

// Run the query and set query result in $result
// Here $db comes from "db_connection.php"
$result = $db->query($query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Data List</title>
</head>
<body>
	<div>
		<table width="100%" cellpadding="5" cellspacing="1" border="1">
			<tr>
				<td>Name</td>
				<td>Email</td>
				<td>Phone</td>
				<td>Username</td>
				<td>Password</td>
				<td>Role</td>
				<td>Active</td>
				<td>Last Login</td>
				<td>Action</td>
			</tr>
			<?php while($row = $result->fetchArray()) {?>
			<tr>
				<td><?php echo $row['name'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><?php echo $row['phone'];?></td>
				<td><?php echo $row['username'];?></td>
				<td><?php echo base64_decode($row['password']);?></td>
				<td><?php echo $row['role'];?></td>
				<td><?php echo $row['active'];?></td>
				<td><?php echo $row['last'];?></td>
				<td>
					<a href="update.php?id=<?php echo $row['id'];?>">Edit</a> | 
					<a href="delete.php?id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure?');">Delete</a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>