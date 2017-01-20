	<?php
	/*
	** This class uses javascript to generate a xml document containing the date for the ajax quick search
	** I is only run when a admin insert a new course into the database.
	*/
	define('LOCK', TRUE);
	require_once '../accessDB.php';
	require_once '../utils/session.php';
	session_start();

	//creates a new DOM document
	$xml = new DOMDocument();
	$courses = $xml->createElement( 'courses' );

	//query the database for courses
	$sqlString = "SELECT * FROM courses ORDER BY course_id DESC";
	$result = mysqli_query($dbLink, $sqlString) or die("Could not get items.." . mysqli_error($dbLink));
	while ($row = mysqli_fetch_assoc($result)) {

		//generate xml structure
		$course = $xml->createElement( 'course' );
		$coursename = $xml->createElement( 'coursename' );
		$courselink = $xml->createElement( 'courselink' );

		$courses->appendChild( $course );
		$course->appendChild( $coursename );
		$course->appendChild( $courselink );

		//assign values from the sql into the xml elements.
		$coursename->nodeValue = $row["course_id"] . ' ' . $row["course_name"];
		$courselink->nodeValue = $row["course_id"];
	}

  $xml->appendChild( $courses );
	$xml->save("courselinks.xml");

	//sends the admin back to the insertcourses tool
	header('Location: ../insertcourses.php');

	?>
