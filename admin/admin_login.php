<?php
session_start();
include('includes/connection.php');

?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin login</title>
	<style>
		body{padding: 0;margin: 0; background:pink;}
		td, table{padding: 10px; }
	</style>
</head>
<body>
<form action="" method="post">
	<table align="center" bgcolor="skyblue" width="500">
		<tr align="center">
			<td colspan="3"><h2>Admin Login here!</h2></td>
		</tr>
		<tr>
			<td align="right"><strong>Admin email:</strong></td>
			<td><input type="text" name="email" placeholder="Enter Admin email">
		</tr>
		<tr>
			<td align="right"><strong>Admin Password:</strong></td>
			<td><input type="password" name="pass" placeholder="Enter Admin Password">
		</tr>
		<tr align="center">
			<td colspan="3">
				<input type="submit" name="admin_login" value="Admin Login">
			</td>
		</tr>
	</table>

</form>

<?php
if(isset($_POST['admin_login']))
{
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$pass = mysqli_real_escape_string($con, $_POST['pass']);

	$get_admin = "SELECT * FROM admin WHERE admin_email='$email' AND admin_pass='$pass' ";
	$run_admin = mysqli_query($con, $get_admin);
	$check_admin = mysqli_num_rows($run_admin);
	if($check_admin==0)
	{
		echo "<script>alert('Email or password is not correct');</script>";
	}
	else
	{
		$_SESSION['admin_email']=$email;
		echo "<script>window.open('index.php', '_self')</script>";
	}

}

?>


</body>
</html>