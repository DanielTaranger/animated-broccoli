<?php
	/*
	** These php functions are used primarily in generating the vote up and vote down buttons on the review entries
	*/
	//This prevents users to access the document directly
	if(!defined('LOCK')) {
		die('Direct access not permitted');
	}

	/*
	** It checks if the post has the same author as the user that is logged in,
	** If the author of the post is the same as logged in user, the user will not be able to vote on that post.
	** Also if the user has already voted on a particular post, A different colored icon will appear,
	** indicating that the user already has upvoted or downvoted that particular review.
	*/
	function btnUp($revid, $revUsr){
			global $dbLink;
			$temp = '<img src="img/voteup.png" alt="Vote up button">';
			if(isset($_SESSION['userid']) AND $_SESSION['userid'] != $revUsr){
				$sqlStr = "SELECT * FROM votes WHERE user_id=" . $_SESSION['userid'] . " AND " . "review_id=" . $revid;
				$result = mysqli_query($dbLink, $sqlStr) or die("Could not get items.." . mysqli_error($dbLink));
				while ($row = mysqli_fetch_assoc($result)) {
					if ($row["user_vote"] == 1){
						$temp = '<img src="img/voteup2.png" alt="Vote up button">';
					}
				}
			}
		return $temp;
	}

	/*
	** It checks if the post has the same author as the user that is logged in,
	** If the author of the post is the same as logged in user, the user will not be able to vote on that post.
	** Also if the user has already voted on a particular post, A different colored icon will appear,
	** indicating that the user already has upvoted or downvoted that particular review.
	*/
	function btnDown($revid, $revUsr){
			global $dbLink;
			$temp = '<img src="img/votedown.png" alt="Vote down button">';

			if(isset($_SESSION['userid']) AND $_SESSION['userid'] != $revUsr){
				$sqlStr = "SELECT * FROM votes WHERE user_id=" . $_SESSION['userid'] . " AND " . "review_id=" . $revid;
				$result = mysqli_query($dbLink, $sqlStr) or die("Could not get items.." . mysqli_error($dbLink));
				while ($row = mysqli_fetch_assoc($result)) {
					if ($row["user_vote"] == -1){
						$temp = '<img src="img/votedown2.png" alt="Vote down button">';
					}
				}
			}

		return $temp;
	}
?>
