<?php
	if(isset($_SESSION['user']))
	{
		header("Location: bidding.php");
	}
	else
	{
		header("Location: login_interface.php");
	}
?>