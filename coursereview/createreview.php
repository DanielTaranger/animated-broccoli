<?php
	define('LOCK', TRUE);
	require_once 'accessDB.php';
	require_once 'utils/session.php';
	session_start();

	/*
	**Checks if user is logged or not
	** and generates links stored in variables to be used in the head.html
	*/
	$logon = '';
	$acc = '';
	$cid = '';
    if(isset($_SESSION['userid'])){
		$acc = '<li><a href="myreviews.php">My Reviews</a></li>';
		$logon = '<li><a href="index.php?logout">Log Out</a></li>';
	}else {
		$logon = '<li><a href="index.php?login">Log In</a></li>';
	}
	$title = 'Create review';
	require_once 'templates/head.html';

	/*
	** If course id is delivered through GET,
	** it stores it in a local variable $cid that will be included in the create review form
	*/
	if(isset($_GET["cid"])){
		$cid = $_GET["cid"];
	}
    if(isset($_SESSION['userid'])){
		include 'include/createrev.php';
		if (count($_POST) > 0) {
			require_once 'utils/submit.php';
		}
	}else {
		echo '<p>You must be signed in to type a review <a href="index.php?login">Log In here</a></p>';
	}

	//footer for closing up the html page
	require "templates/foot.html";
?>
