<?php
session_start();
require('functions/function.php');
$con=con();
if(isset($_POST['submit'])){
		echo $name = $_POST['u_name'];
		echo $pass = $_POST['u_pass'];
		echo $email = $_POST['u_email'];
		echo $country = $_POST['u_country'];
		echo $gender = $_POST['u_gender'];
		echo $b_day = $_POST['u_birthday'];
		// $password = $_POST[''];
		echo $date = date("d-m-y");
		echo $status = "unverified";
		echo $posts = "No";

		$get_email = "SELECT * FROM users WHERE user_email='$email' ";
		$run_email = mysqli_query($con, $get_email);
		$check = mysqli_num_rows($run_email);

		if($check == 1){
			echo "<script>alert('This email is already registered. Please login!');location.href='index.php';</script>";
			// header('location: index.php');
			exit();
		}

		else if(strlen($pass)<8)
		{
			echo "<script>alert('Password should be greater than 8 characters.');location.href='index.php';</script>";
			exit();
		}
		
		
			// echo "adkcfhjdgcjh";
		$con=con();
			$insert1 = "INSERT into users (user_name, user_pass, user_email, user_country, user_gender, user_bday, user_image, register_date, last_login, status, posts) values ('$name', '$pass', '$email', '$country', '$gender', '$b_day', 'default.jpg','$date', '$date', '$status', '$posts') ";
			echo "string\n";
			echo $run_insert = mysqli_query($con, $insert1);
			if($run_insert)
			{
				echo "<script>alert('Registration successful');window.location='index.php';</script>";
			}
		
	}

?>	