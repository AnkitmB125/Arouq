<?php

$con = mysqli_connect("localhost", "root", "", "soc") or die("Connection was not established");

//function for getting topics
function getTopics(){
	global $con;
	$get_topics = "SELECT * FROM topics";
	$run_topics = mysqli_query($con, $get_topics);
	while($row=mysqli_fetch_array($run_topics))
	{
		$topic_id = $row['topic_id'];
		$topic_title = $row['topic_title'];
		echo "<option value='$topic_id'>$topic_title</option> ";
	}

}

//function for inserting posts
function insertPost(){
	global $con;
	global $user_id;
	if(isset($_POST['sub'])){
		$title = addslashes($_POST['title']);
		$content = addslashes($_POST['content']);
		$topic = $_POST['topic'];
		if($content =='')
		{
			echo "<h2>Please write description</h2>";
			exit();
		}
		else {

		$insert = "INSERT INTO posts (user_id, topic_id, post_title, post_content, post_date) values ('$user_id', '$topic', '$title', '$content', NOW())";

		$run = mysqli_query($con, $insert);
		if($run)
		{
			echo "<h3>Posted to tiemline</h3>";
			$update = "UPDATE users set posts='yes' WHERE user_id='$user_id' ";
			$run_update = mysqli_query($con, $update);
		}
	}
	}
}

//function for displaying posts
function get_posts(){
	global $con;
	$per_page=5;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	else {
		$page = 1;
	}
	$start_from = ($page - 1) * $per_page;
	$get_posts = "SELECT * FROM posts ORDER by 1 DESC LIMIT $start_from, $per_page";
	$run_posts = mysqli_query($con, $get_posts);
	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		//getting the user who has posted the thread
		$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes' ";
		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		//now displaying all at once
		echo "<div id='posts'>
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?u_id=$user_id'>$user_name</a><h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content<p>
			<a href='single.php?post_id=$post_id' style='float:right;'><button>See replies or reply to this</button></a>
			</div><br/>
		";
	}

	include("pagination.php");
}


function single_post()
{
	if(isset($_GET['post_id']))
	{
		global $con;
			$get_id = $_GET['post_id'];

			$get_posts = "SELECT * FROM posts WHERE post_id='$get_id' " ;
			$run_posts = mysqli_query($con, $get_posts);
			$row_posts = mysqli_fetch_array($run_posts);
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		//getting the user who has posted the thread
		$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes' ";
		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		//gettin user session

		$user_com = $_SESSION['user_email'];
		$get_com = "SELECT * FROM users WHERE user_email='$user_com' ";
		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);
		$user_com_id = $row_com['user_id'];
		$user_com_name = $row_com['user_name'];		

		//now displaying all at once
		echo "<div id='posts'>
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a><h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content<p>
			</div>
			";
			include('comments.php');
			echo "
			<form action='' method='post' id='reply'>
			<textarea cols='50' rows='5' placeholder='Write your reply' name='comment'></textarea><br/>
			<input type='submit' name='reply' value='reply to this' />
			</form>

		";

		if(isset($_POST['reply'])){
			$comment = $_POST['comment'];
			$insert = "INSERT INTO comments (post_id, user_id, comment,comment_author, date) values ('$post_id', '$user_id', '$comment', '$user_com_name' , NOW()) ";
			$run = mysqli_query($con, $insert);
			echo "<h2>Your reply was added!</h2><script>window.location='single_re.php?q=$post_id'</script>";
			// header('location: abc.php');
			exit();
		}

	}
}



//function for getting categories
function get_Cats(){
	global $con;
	$per_page=5;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	else {
		$page = 1;
	}
	$start_from = ($page - 1) * $per_page;

	if(isset($_GET['topic']))
	{
		$topic_id = $_GET['topic'];
	}

	$get_posts = "SELECT * FROM posts WHERE topic_id = '$topic_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
	$run_posts = mysqli_query($con, $get_posts);
	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		//getting the user who has posted the thread
		$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes' ";
		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		//now displaying all at once
		echo "<div id='posts'>
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a><h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content<p>
			<a href='single.php?post_id=$post_id' style='float:right;'><button>See replies or reply to this</button></a>
			</div><br/>
		";
	}

	include("pagination.php");
}


//function for getting serach results

function get_results(){
	global $con;
	

	if(isset($_GET['user_query']))
	{
		$search_term = $_GET['user_query'];
	}

	$get_posts = "SELECT * FROM posts WHERE post_title LIKE '%$search_term%' OR post_content LIKE '%$search_term%' ORDER by 1 DESC LIMIT 5";
	$run_posts = mysqli_query($con, $get_posts);

	$count_result = mysqli_num_rows($run_posts);
	if($count_result == 0)
	{
		echo "<h3 style='background:black; color:white; padding:10px;'>Sorry, we do not have any results for this keyword.</h3>";
		exit();
	}
	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		//getting the user who has posted the thread
		$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes' ";
		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		//now displaying all at once
		echo "<div id='posts'>
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a><h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content<p>
			<a href='single.php?post_id=$post_id' style='float:right;'><button>See replies or reply to this</button></a>
			</div><br/>
		";
	}

	// include("pagination.php");
}

//function for displaying posts
function user_posts(){
	global $con;
	if(isset($_GET['u_id'])){
		$u_id = $_GET['u_id'];
	}
	$get_posts = "SELECT * FROM posts WHERE user_id='$u_id' ORDER by 1 DESC LIMIT 5";
	$run_posts = mysqli_query($con, $get_posts);
	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		//getting the user who has posted the thread
		$user = "SELECT * FROM users WHERE user_id='$user_id' AND posts='yes' ";
		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		//now displaying all at once
		echo "<div id='posts'>
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a><h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content<p>
			<a href='single.php?post_id=$post_id' style='float:right;'><button>View</button></a>
			<a href='edit_post.php?post_id=$post_id' style='float:right;'><button>Edit</button></a>
			<a href='functions/delete_posts.php?post_id=$post_id' style='float:right;'><button>Delete</button></a>
			</div><br/>
		";

		include("delete_posts.php");

	}

}

//function for user profile

function user_profile()
{
	if(isset($_GET['u_id']))
	{
		global $con;
		$user_id = $_GET['u_id'];
		$select = "SELECT * FROM users WHERE user_id='$user_id' ";
		$run = mysqli_query($con, $select);
		$row = mysqli_fetch_array($run);
		$id = $row['user_id'];
		$image = $row['user_image'];
		$name = $row['user_name'];
		$country = $row['user_country'];
		$gender = $row['user_gender'];
		$last_login = $row['last_login'];
		$register_date = $row['register_date'];

		if($gender == 'male')
		{
			$msg = "Send him a message";
		}
		else if($gender =='female')
		{
			$msg = "Send her a message";
		}
		else
		{
			$msg = "Send a message";
		}

		echo "
		<div id='user_profile' align='justify' style='padding: 10px;
	margin-left: 50px;
	background: #FFB6C1;
	height: 260px;
	border: 2px solid black;
	border-radius: 10px;'>
		<img src='user/user_images/$image' width='180' height='180' style='float: right;
	border:2px soli gray;' /><br/>
		<p style='margin:5px;'><strong>Name: </strong>$name</p><br/>
		<p style='margin:5px;'><strong>Gender: </strong>$gender</p><br/>
		<p style='margin:5px;'><strong>Country: </strong>$country</p><br/>
		<p style='margin:5px;'><strong>Last Login: </strong>$last_login</p><br/>
		<p style='margin:5px;'><strong>Member since: </strong>$register_date</p><br/>
		<a href='messages.php?u_id=$id'><button style='padding:5px;border:1px solid black; border-radius:5px;'>$msg</button></a><hr>
		";
	}
	new_members();
	
	echo "</div>";	
}

function new_members()
{
	global $con;
	$user = "SELECT * FROM users LIMIT 0,20";
	$run_user = mysqli_query($con, $user);
	echo "<br/><h2 color='blue'>New members on this site:</h2><br>";
	while($row_user=mysqli_fetch_array($run_user))
	{
		$user_id = $row_user['user_id'];
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		echo "
		<span>
		<a href='user_profile.php?u_id=$user_id'>
		<img src='user/user_images/$user_image' width='60' height='60' title='$user_name' style='float:left; border:2px solid gray;'/>
		</a>
		</span>

		";
	}

}



?>