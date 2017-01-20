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
    if(isset($_SESSION['userid'])){
		$acc = '<li><a href="myreviews.php">My Reviews</a></li>';
		$logon = '<li><a href="index.php?logout">Log Out</a></li>';
	}else {
		$logon = '<li><a href="index.php?login">Log In</a></li>';
	}
	$title = 'Courses';
	require 'templates/head.html';


	/*
	** Query that gathers and prints out all of the courses in the database,
	** this would be functioning different if all courses had been fed in to the database.
	** The courses are ordered by their ID although this does little to improve the visibility of them.
	*/
	$sqlString = "SELECT * FROM courses ORDER BY course_id DESC";
	$result = mysqli_query($dbLink, $sqlString) or die("Could not get items.." . mysqli_error($dbLink));
	if (mysqli_num_rows($result) > 0) {
		echo '<div id="heading">Courses:</div>';
	}else{
		echo '<div id="heading">No Courses yet...</div>';
	}
	echo '<div class="courses">';
	while ($row = mysqli_fetch_assoc($result)) {
		echo '<a href="course.php?cid=' . $row["course_id"] . '">' . $row["course_id"] . '</a><div class="divider">|</div>';
	}


	include 'include/search.html';
	echo '</div>';

	//footer for closing up the html page
	require 'templates/foot.html';
?>
