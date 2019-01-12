<!DOCTYPE html>
<?php 
session_start();
include('includes/connection.php');
include('functions/function.php');

if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
else {

?>
<html>
	<head>
		<title>Welcome User!</title>
		<link rel="stylesheet" href="styles/home_style.css" media="all">
	</head>
	<body>
		<!--Container strats-->
		<div class="container">
			<!--head warper starts-->
			<div id="head_wrap">
				<!--Header starts-->
				<div id="header">
					<ul id="menu">
						<li><a href="home.php">Home</a></li>
						<li><a href="members.php">Members</a></li>
						<strong>Topics: </strong>
						<?php
						$get_topics = "SELECT * FROM topics";
						$run_topics = mysqli_query($con, $get_topics);
						while($row=mysqli_fetch_array($run_topics))
						{
							$topic_id = $row['topic_id'];
							$topic_title = $row['topic_title'];
							echo "<li><a href='topics.php?topic=$topic_id'>$topic_title</a></li>";
						}
						?>
						
					</ul>
					<form method="get" action="results.php" id="form1">
						<input type="text" name="user_query" placeholder="Search a topic"/>
						<input type="submit" name="search" value="Search">
					</form>
				</div>
			</div>
			<!--head wrapper ends-->
			<!-- Content area starts --> 
			<div class="content">
				<!-- user timeline starts -->
				<div id="user_timeline">
					<div id="user_details">
						<?php
						$user = $_SESSION['user_email'];
						$get_user = "SELECT * FROM users WHERE user_email='$user' ";
						$run_user = mysqli_query($con, $get_user);
						$row = mysqli_fetch_array($run_user);
						$user_id = $row['user_id'];
						$user_name = $row['user_name'];
						$user_country = $row['user_country'];
						$user_image = $row['user_image'];
						$register_date = $row['register_date'];
						$last_login = $row['last_login'];

						$user_posts = "SELECT * FROM posts WHERE user_id='$user_id' ";
						$run_posts = mysqli_query($con, $user_posts);
						$posts = mysqli_num_rows($run_posts);

						//getting number of unread msgs

						$sel_msg = "SELECT * FROM messages WHERE receiver='$user_id' AND status='unread' ORDER BY 1 DESC";
				 		$run_msg = mysqli_query($con,$sel_msg);

				 		$count_msg = mysqli_num_rows($run_msg);

						echo "
							<center><img src='user/user_images/$user_image' width='200px' height='200px'/></center>			
							<div id='user_mention'>
							<p><strong>Name: </strong>$user_name</p>
							<p><strong>Country: </strong>$user_country</p>
							<p><strong>Last login:</strong>$last_login</p>
							<p><strong>Member Since: </strong>$register_date</p>

							<p><a href='my_messages.php?inbox&
							u_id=$user_id'>My Messages ($count_msg)</a></p>
							<p><a href='my_posts.php?u_id=$user_id'>My Posts ($posts)</a></p>
							<p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
							<p><a href='logout.php'>Logout</a></p>
							</div>
						";
						?>
					</div>
				</div>
				<!-- user timeline ends -->
				<!-- content timeline strats -->
				<div id="content_timeline">
					<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f">
					<h2>What's your question today? Let's Discuss!</h2>
					<input type="text" name="title" placeholder="Write a title..." size="90"/ required="required"><br>
					<textarea cols="69" rows="4" name="content" placeholder="Write description..." required="required"></textarea><br>
					<select name="topic">
						<option>Select Topic</option>
						<?php getTopics(); ?>
					</select>
					<input type="submit" name="sub" value="Post to timeline"/>
					</form>
					<?php insertPost(); ?>
					<!-- <div id="posts"> -->
						<h3>Most Recent Discussions</h3>
						<?php get_posts(); ?>
					<!-- </div> -->
				</div>
				<!-- content timeline ends -->
			</div>
			<!-- content area ends -->


		</div>
	</body>
<html>
<?php } ?>