<?php
	/*
	** Very rudimentary and maybe abit unsafe php for deleting a post,
	** I could not get a confirm page implemented
	** The user will get redirected back to where he or she was when the post was deleted
	** based on whether mrev for my reviews or rev for reviews or crev for course reviews page.
	*/
	define('LOCK', TRUE);
	require_once '../accessDB.php';
	require_once 'session.php';
	session_start();

	global $dbLink;
	$pid = "";
	$cid = "";

	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
	}if (isset($_GET['cid'])){
		$cid = $_GET['cid'];
	}else{
		die();
	}

	$sqlString = "DELETE FROM reviews WHERE review_id=" . $pid . "";
	mysqli_query($dbLink, $sqlString) or die("Could not delete post.." . mysqli_error($dbLink));
	if(isset($_GET['mrev'])){
		header('location: ../myreviews.php');
	}else if (isset($_GET['rev'])){
		header('location: ../reviews.php');
	}else if (isset($_GET['crev'])){
		if(isset($cid)){
		header('location: ../course.php?cid=' . $cid);
		}else{
		header('location: ../courses.php');
		}
	}

		//footer for closing up the html page
		require 'templates/foot.html';
?>
