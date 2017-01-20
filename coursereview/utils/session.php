<?php
	/*
	** This session.php document was provided to us students by our seminar leader for us to use
	** I do not take credit for the code written here, you will see that most students use this session code in their projects.
	*/
	if(!defined('LOCK')) {
			die('Direct access not permitted');
	}

function destroySession() {

    $_SESSION = array();

    # Get cookie parameters so that we may unset it
    $sessioncookie = session_get_cookie_params();

    # Unsetting the sessioncookie (This could be reinforced by a check for default session creation - ini_get(session.use_cookies))
    setcookie(session_name(), '', time() - 86400,
      $sessioncookie["path"], $sessioncookie["domain"],
      $sessioncookie["secure"], $sessioncookie["httponly"]
    );


    session_destroy();
}

?>
