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
	$title = 'Recent reviews';
	require 'templates/head.html';

	/*
	** Query that gathers and prints out all of the reviews in the database,
	** Limited to 30 entries and supposed to order by date, although this does not work currently
	*/
	$sqlString = "SELECT * FROM reviews ORDER BY review_date DESC LIMIT 30";
	$result = mysqli_query($dbLink, $sqlString) or die("Could not get items.." . mysqli_error($dbLink));
	if (mysqli_num_rows($result) > 0) {
		echo '<div id="heading">New reviews:</div>';
	}else{
		echo '<div id="heading">No reviews yet...</div>';
	}
	while ($row = mysqli_fetch_assoc($result)) {
		$delete = "";
		$edit = "";
		$revid = $row["review_id"];
		$revUsr = $row["user_id"];
		if(isset($_SESSION['userid'])){
			if($_SESSION['userid'] == $row["user_id"]){
				$edit = '<div class="button"><a href="utils/edit.php?pid='. $row["review_id"] . '&amp;txt=' . '"&amp;mrev=r>edit</a></div>';
				$delete = '<div class="button"><a href="utils/delete.php?pid='. $row["review_id"] . ' &amp;mrev=r&amp;cid=' . $row["course_id"] . '">delete</a></div>';
			}else {
				echo "";
			}
		}
		echo '<div class="review">' .  "\n" .
		'<div class="cid">' . '<a class="courselink" href="course.php?cid=' . $row["course_id"] . '">' . $row["course_id"] . '</a>' .'</div>' . '<p class="formh">' . $row["course_semester"] .'</p>' . '<p id="formy">Posted: ' . $row["review_date"] . '</p>' .
		'<div class="uname">' . '<a href="user.php?uid='. $row["user_name"] . '">' . $row["user_name"] . '</a>' .'</div>' . "\n" .
		'<div class="rtext">' . '<p>' . $row["review_text"] . '</p>' . '</div>' .
		'<div class="rvote">'  . '<a class="up" href="utils/vote.php?pid=' . $row["review_id"] .'&amp;rev=r&amp;vote=1">' . btnUp($revid,$revUsr) .
		'</a>' . '<a class="down" href="utils/vote.php?pid=' . $row["review_id"] .'&amp;rev=r&amp;vote=-1">' . btnDown($revid, $revUsr) .'</a>' . '<p>'.$row["course_rating"].'</p>' . '<p>Users found this useful</p>' . '</div>' . "\n" .
		$edit . $delete . "</div>";
	}


	//footer for closing up the html page
	require 'templates/foot.html';
?>
