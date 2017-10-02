<?php
$message = ""; // initial message 

// Includs database connection
include "db_connect.php";

// Updating the table row with submited data according to rowid once form is submited 
if( isset($_POST['submit_data']) ){

	// Gets the data from post
	$id = $_POST['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$username = $_POST['username'];
	$password = base64_encode($_POST['password']);
	$role = $_POST['role'];
	$active = $_POST['active'];
	$last = $_POST['last'];

	// Makes query with post data
	$query = "UPDATE users set name='$name', email='$email', phone='$phone', username='$username', password='$password', role='$role', active='$active', last='$last' WHERE id=$id";
	
	// Executes the query
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connection.php"
	if( $db->exec($query) ){
		$message = 'Data is updated successfully.<meta http-equiv="refresh" content="2; url=index.php" />';
	}else{
		$message = 'Sorry, Data is not updated.<meta http-equiv="refresh" content="2; url=index.php" />';
	}
}

$id = $_GET['id']; // rowid from url
// Prepar the query to get the row data with rowid
$query = "SELECT id, * FROM users WHERE id=$id";
$result = $db->query($query);
$data = $result->fetchArray(); // set the row in $data
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Data</title>
</head>
<body>
	<div>

		<!-- showing the message here-->
		<div><?php echo $message;?></div>

		<table width="100%" cellpadding="5" cellspacing="1" border="1">
			<form action="" method="post">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<tr>
				<td>Name:</td>
				<td><input name="name" type="text" value="<?php echo $data['name'];?>"></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input name="email" type="text" value="<?php echo $data['email'];?>"></td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td><input name="phone" type="text" value="<?php echo $data['phone'];?>"></td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input name="username" type="text" value="<?php echo $data['username'];?>"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input name="password" type="text" value="<?php echo base64_decode($data['password']);?>"></td>
			</tr>
			<tr>
				<td>Role:</td>
				<td><input name="role" type="text" value="<?php echo $data['role'];?>"></td>
			</tr>
			<tr>
				<td>Active:</td>
				<td><input name="active" type="text" value="<?php echo $data['active'];?>"></td>
			</tr>
			<tr>
				<td>Last Active:</td>
				<td><input name="last" type="text" value="<?php echo $data['last'];?>"></td>
			</tr>
			<tr>
				<td><a href="index.php">Back</a></td>
				<td><input name="submit_data" type="submit" value="Update Data"></td>
			</tr>
			</form>
		</table>
	</div>
</body>
</html>