<?php if(!defined('LOCK')) {
	die('Direct access not permitted');
}
?>

<form id="review" name="review" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
    <input type="hidden" name="mode" value="course">
    <table>
        <thead>
            <tr>
                <th colspan="1"></th>
            </tr>
        </thead>
        <tbody>
			<tr>
				 <td><p class="formp">Course id:</p></td>
			</tr>
			
            <tr>
                <td><input type="text" name="courseid" size="68"/></td>
            </tr>
			
			<tr>
				 <td><p class="formp">Course name:</p></td>
			</tr>
			
			<tr>
                <td><input type="text" name="coursename" size="68"/></td>
            </tr>
            <tr>
                <td><p class="formp">Course description:</p><textarea name="coursedesc" rows="4" cols="50"></textarea>
                </td>
            </tr>
			
			<tr>
				<td><div id="subbutton"><input type="submit" value="Insert"></div></td>
            </tr>
        </tbody>
    </table>
</form>