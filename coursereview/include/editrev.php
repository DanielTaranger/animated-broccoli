<?php if(!defined('LOCK')) {
		die('Direct access not permitted');
}
?>
<form id="review" name="review" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
    <input type="hidden" name="mode" value="update">

			<p class="formp">Course id:</p>
            <input id="cinput" type="text" name="courseid" size="68" value="<?php echo $ID; ?>"/>

            <p class="formp">Your evaluation:</p><textarea name="textReview" rows="4" cols="50"><?php echo $rText; ?></textarea>

			<div id="subbutton"><input type="submit" value="Update"></div>
</form>
