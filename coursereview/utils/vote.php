<?php
	define('LOCK', TRUE);
	require_once '../accessDB.php';
	require_once 'session.php';
	session_start();
	global $dbLink;

	/*
	** If userid is set the user is allowed to vote and the code runs
	** A series of variables keep track if the vote is +1 or -1 and updates the
	** reviews vote count by the new amount after.
	**
	** The votes table in the database keeps track of which user has voted in which review
	** so that a user can not spam the vote button and increase a posts rating, the user also cannot vote on its own reviews
	** This is a very important feature of the site because it gives the users a true indication of the quality of the review
	** Quite a lot of time was put into this code and im really proud of it.
	*/
	if(isset($_SESSION['userid'])){

		$pid = 0;
		$vote = 0;
		$uservote = 0;
		$userid = $_SESSION['userid'];
		$cid = "";
		if(isset($_GET['pid'])){
			$pid = $_GET['pid'];
		}if (isset($_GET['vote'])){
			$vote = $_GET['vote'];
		}if (isset($_GET['cid'])){
			$cid = $_GET['cid'];
		}

		//Fetches the vote that matches the user and that post
		$sqlString = "SELECT * FROM votes WHERE user_id=" . $userid . " AND " . "review_id=" . $pid ;
		$result = mysqli_query($dbLink, $sqlString) or die("Could not get items.." . mysqli_error($dbLink));
		
			// If no match is found, a new entry is inserted into votes what that user voted (-1 or +1)
			if(mysqli_num_rows($result) == 0){
				$sqlString = "INSERT INTO votes (user_id, review_id, user_vote) VALUES ('". $userid ."', '" . $pid . "', '" . $vote ."')";
				mysqli_query($dbLink, $sqlString) or die("Could not register new post.." . mysqli_error($dbLink));
				
				// The review that is vote on is then updated to its rating +1 or rating -1 depending on what the user clicked
				$sqlStr = "SELECT * FROM reviews WHERE review_id=" . $pid . "";
				$result = mysqli_query($dbLink, $sqlStr) or die("Could not get items.." . mysqli_error($dbLink));
				while ($row = mysqli_fetch_assoc($result)) {			
					if ($vote == 1){
						$uservote = $row["course_rating"] + 1;
					}else if ($vote == -1 AND $row["course_rating"] > 0){
						$uservote = $row["course_rating"] - 1;
					}else{
						$uservote = $row["course_rating"];
					}
				}
				// The review rating is updated after the process above	
				$sqlStr = "UPDATE reviews SET course_rating=" . $uservote . " WHERE review_id=" . $pid . "";
				mysqli_query($dbLink, $sqlStr) or die("Could not get items.." . mysqli_error($dbLink));
				
				//If the code detects that the user has already voted he is given the opportunity to change his vote
			}else if(mysqli_num_rows($result) > 0){
				while ($row = mysqli_fetch_assoc($result)) {	
					
					//if the new vote is different from the previous one, change it
					if ($vote != $row[user_vote]){
						$sqlStr = "SELECT * FROM reviews WHERE review_id=" . $pid . "";
						$result = mysqli_query($dbLink, $sqlStr) or die("Could not get items.." . mysqli_error($dbLink));
						while ($row = mysqli_fetch_assoc($result)) {			
							if ($vote == 1){
								$uservote = $row["course_rating"] + 1;
							}else if ($vote == -1 AND $row["course_rating"] > 0){
								$uservote = $row["course_rating"] - 1;
							}else{
								$uservote = $row["course_rating"];
							}
						}
						
						//finally update the new user votes
						$sqlStr = "UPDATE reviews SET course_rating=" . $uservote . " WHERE review_id=" . $pid . "";
						mysqli_query($dbLink, $sqlStr) or die("Could not get items.." . mysqli_error($dbLink));
					}	
				}
				
				//also update the new vote from the user
				$sqlStr = "UPDATE votes SET user_vote=" . $vote . " WHERE review_id=" . $pid . "";
				mysqli_query($dbLink, $sqlStr) or die("Could not get items.." . mysqli_error($dbLink));
			}
	}
	
	// This code redirects the user to the correct page based on where the vote happened
	if(isset($_GET['mrev'])){
		header('location: ../myreviews.php');
	}else if (isset($_GET['rev'])){
		header('location: ../reviews.php');
		die();
	}else if (isset($_GET['crev'])){
		header('location: ../course.php?cid=' . $cid);
		die();
	}

?>
