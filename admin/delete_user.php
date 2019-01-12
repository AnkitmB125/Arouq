<?php
	include('includes/connection.php');
	if(isset($_GET['user_id']))
	{
		$user_id = $_GET['user_id'];
		$delete = "DELETE FROM users WHERE user_id='$user_id' ";
		$run_delete = mysqli_query($con, $delete);

		$del_posts = "DELETE FROM posts WHERE user_id='$user_id' ";
		$run_posts = mysqli_query($con, $del_posts);

		echo "<script>
		alert('User has been deleted');window.open('index.php?view_users','_self');</script>";
	}

?>