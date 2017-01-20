<?php if(!defined('LOCK')) {
	die('Direct access not permitted');
}
?>

<form id="review" name="review" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
<p class="formp" ><span id="alert">NB!</span>Please use course codes that corresponds with the real codes, <br>for example: type INFO205 instead of info205 or info 205.</p><br>
    <input type="hidden" name="mode" value="review">

				<p class="formp">Course id:</p>
               <input id="cinput" type="text" name="courseid" size="68" value="<?php echo $cid ?>" placeholder="Id of the course, for example: INFO205" />

                <p class="formp">Your evaluation:</p>
				<textarea name="textReview" maxlength="500" rows="4" cols="50" placeholder="Write your review here"></textarea>
				<div id="subbutton"><input type="submit" value="Post"></div>

				<p id="formu">Semester: </p>
				<select name="semester">
					<option value="Spring">Spring</option>
					<option value="Autumn">Autumn</option>
				</select>

				
				<select name="year">
					<option value="2015">2015</option>
					<option value="2014">2014</option>
					<option value="2013">2013</option>
					<option value="2012">2012</option>
					<option value="2011">2011</option>
					<option value="2010">2010</option>
				</select>
</form>
