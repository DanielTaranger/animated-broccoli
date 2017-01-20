<?php
	define('LOCK', TRUE);
	require_once 'accessDB.php';
	require_once 'utils/session.php';
	require_once 'utils/buttoncode.php';
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


	/*
	** If course id is delivered through GET,
	** it stores it in a local variable which will be used when the head.html is added
	*/
	$cid = "";
	if(isset($_GET["cid"])){
		$cid = $_GET["cid"];
	}
	$title = $cid;
	require 'templates/head.html';


	/*
	** Query that generates information about the course from the database,
	** and also genereates links to more information and to create your own review of the course.
	*/
	global $dbLink;
	$sqlString = "SELECT * FROM courses WHERE course_id='" . $cid . "'";
	$result = mysqli_query($dbLink, $sqlString) or die("Could not get items.." . mysqli_error($dbLink));
	while ($row = mysqli_fetch_assoc($result)) {
		echo  '<div id="heading">' . $row["course_id"] . ' '.  $row["course_name"] . '</div>'. '<div class="courses">' .'<p id="ctext">' . $row["course_desc"] .'</p>' .
		'<div class="button"><a href="http://www.uib.no/emne/'. $row["course_id"] . '" target="_blank" >More information</a></div>' .
		'<div class="button"><a href="createreview.php?cid='. $row["course_id"] . '">Create review</a></div>' .
		'</div>';
	}


	/*
	** Query that gathers information about reviews for the course displayed
	** If the user is logged in or out it generates edit and delete buttons if the review author is the same as logged in user.
	*/
	$sqlString2 = "SELECT * FROM reviews WHERE course_id='" . $cid . "' ORDER BY course_rating DESC LIMIT 30";
	$result2 = mysqli_query($dbLink, $sqlString2) or die("Could not get items.." . mysqli_error($dbLink));
	if (mysqli_num_rows($result2) > 0) {
		echo '<div id="heading">Reviews:</div>';
	}else{
		echo '<div id="heading">No reviews yet...</div>';
	}
	while ($row2 = mysqli_fetch_assoc($result2)) {
		$delete = "";
		$edit = "";
		$revid = $row2["review_id"];
		$revUsr = $row["user_id"];
		if(isset($_SESSION['userid'])){
			if($_SESSION['userid'] == $row2["user_id"]){
				$edit = '<div class="button"><a href="edit.php?pid='. $row2["review_id"] . '&amp;cid=' . $row2["course_id"] . '&amp;mrev=r">edit</a></div>';
				$delete = '<div class="button"><a href="utils/delete.php?pid='. $row2["review_id"] . '&amp;cid=' . $row2["course_id"] .'&amp;crev=r">delete</a></div>';
			}else {
				echo "";
			}
		}
		echo '<div class="review">' .  "\n" .
		'<div class="cid">' . '<a class="courselink" href="course.php?cid=' . $row2["course_id"] . '">' . $row2["course_id"] . '</a>' .'</div>' . '<p class="formh">' . $row2["course_semester"] .'</p>' . '<p id="formy">Posted: ' . $row2["review_date"] . '</p>' .
		'<div class="uname">' . '<a href="user.php?uid='. $row2["user_name"] . '">' . $row2["user_name"] . '</a> ' . '</div>' .
		'<div class="rtext">' . '<p>' . $row2["review_text"] . '</p>' . '</div>' .
		'<div class="rvote">'  . '<a class="up" href="utils/vote.php?pid=' . $row2["review_id"] .'&amp;crev=r&amp;vote=1&amp;cid=' . $cid . '">' . btnUp($revid,$revUsr) .
		'</a>' . '<a class="down" href="utils/vote.php?pid=' . $row2["review_id"] .'&amp;crev=r&amp;vote=-1&amp;cid=' . $cid . '">' . btnDown($revid, $revUsr) .'</a>' . '<p>'.$row2["course_rating"].'</p>' . '<p>Users found this useful</p>' . '</div>' . "\n" .
		$edit . $delete . "</div>";
	}


	//footer for closing up the html page
	require 'templates/foot.html';
?>
