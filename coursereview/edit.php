<?php
  //NB! Editing of posts currently does not work
	define('LOCK', TRUE);
	require_once 'accessDB.php';
	require_once 'utils/session.php';
	session_start();

  /*
  **Checks if user is logged or not
  ** and generates links stored in variables to be used in the head.html
  */
	$username = "";
	$acc = '';
	$logon = '';
  if(isset($_SESSION['userid'])){
		$username = $_SESSION['username'];
		$acc = '<li><a href="myreviews.php">My Reviews</a></li>';
		$logon = '<li><a href="index.php?logout">Log Out</a></li>';
	}else {
		$logon = '<li><a href="index.php?login">Log In</a></li>';
	}
  $title = 'Editing..';
	require 'templates/head.html';



	/*
	** If review id is delivered through GET,
	** it stores it in a local variable $pid that will get the text from the database
  ** and then insert it into the editrev.php class
	*/
	$pid = "";
	$ID = "";
	$rText = "";
	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
	}else{
		die();
	}

  /*
	** Query that gathers the reqired information before editing can start
	*/
	global $dbLink;
	$sqlString = "SELECT * FROM reviews WHERE review_id='" . $pid . "'";
	$result = mysqli_query($dbLink, $sqlString) or die("Could not get items.." . mysqli_error($dbLink));
	while ($row = mysqli_fetch_assoc($result)) {
		$ID = $row["course_id"];
		$rText = $row["review_text"];
		 if(isset($_SESSION['userid']) AND $_SESSION['userid'] == $row["user_id"]) {
			include 'include/editrev.php';
		 }else {
			echo 'Your are not allowed to do that';
		 }
	}


  /* if the user has pressed the update button,
  ** the submit code will run and update the review in the database
  */
	if (count($_POST) > 0) {
			require_once 'utils/submit.php';
		}

  //footer for closing up the html page
  require 'templates/foot.html';
?>
