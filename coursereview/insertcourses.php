<?php
	/*
	** NB! This php document is only used for an administrator to populate the database with new course entries
	** Also note that the ajax quick search function has code snippets taken from w3c ajax example
	** Although it is open to browse to now, this document would never be visible to a normal user.
	*/
	define('LOCK', TRUE);
	require_once 'accessDB.php';
	require_once 'utils/session.php';

	$acc = '';
	$logon = '';
	$title = 'Database insert';
	include 'templates/head.html';
	include 'include/createcourse.php';


	if (count($_POST) > 0) {
		if(isset($_POST['courseid'])){
			$courseid = $_POST['courseid'];
		}if(isset($_POST['coursename'])){
			$coursename = $_POST['coursename'];
		}if(isset($_POST['coursedesc'])){
			$coursetext = $_POST['coursedesc'];
		}
		 global $dbLink;
		$sqlString = "INSERT INTO courses (course_id, course_name, course_desc) VALUES ('$courseid', '$coursename', '$coursetext')";
		mysqli_query($dbLink, $sqlString) or die("Could not register new post.." . mysqli_error($dbLink));
			echo $courseid . $coursename  . $coursetext;

		//Sends the user of this class to a class that genereates the xml used for ajax.
		header('Location: coursedatalinks/generatexml.php');
	}

	//footer for closing up the html page
	require "templates/foot.html";
?>
