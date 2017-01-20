<?php
	/*
	** Some of the functions in this documents like login and logout was provided to us students for our own use by the seminar leader
	** I do not take credit for the login, Salting and registering code of this project
	** updatePost();  postReview(); Are my own methods in this php document
	*/
if(!defined('LOCK')) {
		die('Direct access not permitted');
}

switch ($_POST['mode']) {
    case 'login':
        goLoginUser(trim($_POST['user']));
        break;


	case 'update':
        updatePost();
        break;

    case 'review':
        postReview();
        break;

    default:
        echo "<p><strong>Internal error!</strong><p>";
        break;
}

function goLoginUser($userToLogin) {
    global $dbLink;
    $userEmail = mysqli_real_escape_string($dbLink, $_POST['user']);
    $userPassword = $_POST['pwd'];

    // Check if fields are not empty
    if (empty($userToLogin) || empty($userPassword)) {
        echo "<p><strong>You must enter both username and password!</strong><p>\n";
        return false;
    }

    $sqlString = "SELECT user_id, user_name, pw FROM users WHERE email='".$userEmail."' LIMIT 1";
    $result = mysqli_query($dbLink, $sqlString) or die("Could not check for existing user.." . mysqli_error($dbLink));
    $row = mysqli_fetch_assoc($result);

        // if the password and username is wrong
        if (($result->num_rows < 1) || ($row["pw"] == $userPassword )) {
            echo "<p><strong>Wrong username or password!</strong><p>\n";
        }
        else {
            $_SESSION['userid'] = $row['user_id'];
            $_SESSION['username'] = $row['user_name'];
        }
	header('Location: index.php');
}

// Function that inserts a user and password into a database
function goCreateNewUser() {
    global $dbLink;

    $userEmail = mysqli_real_escape_string($dbLink, $_POST['user']);
    $userPassword = $_POST['pwd'];
    $userRetypePassword = $_POST['retype'];
    $userName = mysqli_real_escape_string($dbLink, trim($_POST['user_name']));
    if (empty($userEmail) || empty($userPassword) || empty($userName)) {
        echo "<p><strong>Please enter email, name and password!</strong><p>";
        return false;
    }
    if ($userPassword != $userRetypePassword) {
        echo "<p><strong>Passwords do not match!</strong><p>";
        return false;
    }

    $sqlString = "INSERT INTO users (user_name, pw, email)
                  VALUES ('" . $userName ."', '" . $userPassword ."', '" . $userEmail ."')";
    mysqli_query($dbLink, $sqlString) or die("Could not register new user.." . mysqli_error($dbLink));

}

// Function responsible for constructing a sql string and inserting the post into the database
function postReview() {
  global $dbLink;
  $courseid = mysqli_real_escape_string($dbLink, $_POST['courseid']);
  $username = $_SESSION['username'];
	$reviewText = mysqli_real_escape_string($dbLink, $_POST['textReview']);
	$userid = $_SESSION['userid'];
	$postrate = 0;
	$date = date("d/m/Y");
	if(isset($_POST['semester'])){
		$semester = $_POST['semester'] . ' ' . $_POST['year'];
	}
    $sqlString = "INSERT INTO reviews(course_id, user_name, review_text, user_id, review_date, course_rating, course_semester)
                  VALUES ('" . $courseid ."',
				  '" . $username ."',
				  '" . $reviewText ."',
				  '" . $userid ."',
				  '" . $date ."',
				  '" . $postrate ."',
				  '" . $semester ."')";

    mysqli_query($dbLink, $sqlString) or die("Could not register new post.." . mysqli_error($dbLink));
	echo '<h3>Success!</h3>';

	if(isset($courseid )){
	header('Location: course.php?cid=' . $courseid .'');
	}else {
		header('Location: reviews.php');
	}
}

//Function used to update a review and send the user back to the correct page it was initiated from
function updatePost() {
  global $dbLink;
  $courseid = mysqli_real_escape_string($dbLink, $_POST['courseid']);
	$reviewText = mysqli_real_escape_string($dbLink, $_POST['textReview']);
  $sqlString = "UPDATE reviews SET course_id=" . $courseid . ", review_text=" . $reviewText  ." WHERE review_id='" . $pid . "'";
  mysqli_query($dbLink, $sqlString) or die("Could not register new post.." . mysqli_error($dbLink));
	echo '<h3>Success!</h3>';
	header('Location: myreviews.php');

	if(isset($_GET['mrev'])){
		header('location: ../myreviews.php');
	}else if (isset($_GET['rev'])){
		header('location: ../reviews.php');
	}else if (isset($_GET['crev'])){
		if(isset($cid)){
		header('location: ../course.php?cid=' . $cid);
		}else{
		header('location: ../courses.php');
		}
	}
}

?>
