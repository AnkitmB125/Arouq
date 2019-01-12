<?php
session_start();
include("../functions/function.php");

if(!isset($_SESSION['admin_email']))
{
	header("location: admin_login.php");
}
else{

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Admin Panel!</title>
		<link rel="stylesheet" href="admin_style.css" media="all">
		<style>
			.ff input{
	margin-bottom: 5px;
}

.ff select{
	margin-bottom: 5px;
}


#f input {
	padding: 7px;
	border: 1px solid black;
	border-radius: 5px;
	font-weight: bolder;
}

#f textarea {
	padding: 8px;
	border: 1px solid black;
	border-radius: 5px;
	font-weight: bolder;
}

#f select {
	padding: 8px;
	border: 1px solid black;
	border-radius: 5px;
	font-weight: bolder;	
}

#f select:hover, input:hover, textarea:hover {
	background-color: #FFF8DC;
}

#f h2 {
	color: gray;
	font-family: Sansational;   
}


		</style>
	</head>

<body>
	<div class="container">
		<div id="head">
			<a href="index.php"><div style="width: 1000px;height: 100px; background-color: skyblue; text-align: center;"><h1 style="font-size: 50px;color: black;">ADMIN PANEL</h1></div></a>

		</div>
		
		<div id="sidebar">
		<h2>Manage Content:</h2>
		<ul id="menu"> 
			<li><a href="index.php?view_users">View Users</a></li>
			<li><a href="index.php?view_posts">View Posts</a></li>
			<li><a href="index.php?view_comments">View Comments</a></li>
			<li><a href="index.php?view_topics">View Topics</a></li>
			<li><a href="index.php?add_topic">Add new topic</a></li>
			<li><a href="admin_logout.php">Admin Logout</a></li>
		</ul>		
		</div>

		<div id="content">
			<h1 style="color: blue; text-align: center;padding: 10px;">Welcome Admin: Manage Your content!</h1>
			<?php
			if(isset($_GET['view_users']))
			{
				include("includes/view_users.php");
			}
			if(isset($_GET['view_posts']))
			{
				include("includes/view_posts.php");
			}

			?>
		</div>
		<div id="foot">
			<h2 style="color: white; padding:15px ;text-align: center;">&copy; Ankit Bhadage</h2>
		</div>
	</div>	




</body>

</html
<?php } ?>