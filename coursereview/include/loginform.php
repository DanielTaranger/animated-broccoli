<?php if(!defined('LOCK')) {
		die('Direct access not permitted');
}
?>
<form id="login" name="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
	<input type="hidden" name="mode" value="login">

   				<p class="formp">Username:</p>
            	<input class="field" type="text" name="user" placeholder="Your email">
				<p class="formp">Password:</p>
         		<input class="field" type="password" name="pwd" placeholder="Password">

              	<div id="logbutton"><input type="submit" value="Log in"></div>
				<div id="register"><a href="index.php?register">Register</a></div>
</form>
