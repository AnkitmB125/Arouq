<?php

if(isset($_GET['u_id']))
{
	$u_id = $_GET['u_id'];
	echo "<script>window.open('messages.php?u_id=$u_id', '_self');</script>";
}

?>