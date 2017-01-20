<?php
	define('LOCK', TRUE);
	require_once 'accessDB.php';
	require_once 'utils/session.php';


	$title = 'Introduction';

	session_start();

	//If the user has clicked the logout button, session is destroyed
	if(isset($_GET['logout'])){
		destroySession();
	}
	$logon ='';
	$acc = '';
	$intro = '<p> Welcome to UiB course review, on this site you will be able to review and rate on previous courses you have taken.<p>';

	/*
	** Based on what the user has done different versions of the introduction page will be displayed
	** If the user is logged in, only a welcome message and a search field will be displayed.
	** If register button has been pressed, the form responsible for registration will be included
	** If Login is pressed the user will be taken to the login form.
	** If none of these. The user will have a login form, introduction and the search field to choose from.
	*/
	if(isset($_SESSION['userid'])){
			$acc = '<li><a href="myreviews.php">My Reviews</a></li>';
			$logon = '<li><a href="index.php?logout">Log Out</a></li>';
			require 'templates/head.html';
			echo $intro;
			echo '<div id="searchicon"></div><p id="heading">Search for courses:</p>';
			include 'include/search.html';
	}else if(isset($_GET['register'])){
			$logon = '<li><a href="index.php?login">Log In</a></li>';
			require 'templates/head.html';
			echo "<h1>Registration is disabled in this demonstration";
	} else if(isset($_GET['login'])){
			$logon = '<li><a href="index.php?logout">Log In</a></li>';
			require 'templates/head.html';
			include 'include/loginform.php';
	}else {
			$logon = '<li><a href="index.php?login">Log In</a></li>';
			require 'templates/head.html';
			include 'include/loginform.php';
			echo $intro;
			echo '<p id="heading">Search for courses:</p>';
			include 'include/search.html';
	}

	if (count($_POST) > 0) {
		require_once 'utils/submit.php';
	}

	//footer for closing up the html page
	require "templates/foot.html";
?>
