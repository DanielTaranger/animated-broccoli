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
	$title = 'My Reviews';
	require 'templates/head.html';


  echo '<div id="heading"> My Reviews</div>';

	//If nothing returns from the database reviewtemp will print that there is no reviews
	//But if the sql search starts to go through the while loop, reviewtemp is emptied.
	$reviewtemp = '<p>No reviews yet...</p>';


	/*
	** Query that gathers and prints out all of the reviews from a user in the database,
	*/
	global $dbLink;
	$sqlString = "SELECT * FROM reviews WHERE user_name='" . $username . "'";
	$result = mysqli_query($dbLink, $sqlString) or die("Could not get items.." . mysqli_error($dbLink));
	while ($row = mysqli_fetch_assoc($result)) {
		$edit = '<div class="button"><a href="utils/edit.php?pid='. $row["review_id"] . '&amp;txt=' . '"&amp;mrev=r>edit</a></div>';
		$delete = '<div class="button"><a href="utils/delete.php?pid='. $row["review_id"] . ' &amp;mrev=r&amp;cid=' . $row["course_id"] . '">delete</a></div>';
		$revid = $row["review_id"];
		$revUsr = $row["user_id"];
		echo '<div class="review">' .  "\n" .
		'<div class="cid">' . '<a class="courselink" href="course.php?cid=' . $row["course_id"] . '">' . $row["course_id"] . '</a>' .'</div>'  . '<p class="formh">' . $row["course_semester"] .'</p>' . '<p id="formy">Posted: ' . $row["review_date"] . '</p>' .
		'<div class="uname">' . '<a href="user.php?uid='. $row["user_name"] . '">' . $row["user_name"] . '</a>' .'</div>' . "\n" .
		'<div class="rtext">' . '<p>' . $row["review_text"] . '</p>' . '</div>' .
		'<div class="rvote">'  . '<a class="up" href="utils/vote.php?pid=' . $row["review_id"] .'&amp;mrev=r&amp;vote=1&amp;cid=' . $row["course_id"] . '">' . btnUp($revid,$revUsr) .
		'</a>' . '<a class="down" href="utils/vote.php?pid=' . $row["review_id"] .'&amp;mrev=r&amp;vote=-1&amp;cid=' . $row["course_id"] . '">' . btnDown($revid, $revUsr) .'</a>' . '<p>'.$row["course_rating"].'</p>' . '<p>Users found this useful</p>' . '</div>' . "\n" .
		$edit . $delete . "</div>";
		 $reviewtemp = '';
	}

	echo $reviewtemp;

	//footer for closing up the html page
	require 'templates/foot.html';
?>
