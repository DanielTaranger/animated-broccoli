<?php if(!defined('LOCK')) {
	die('Direct access not permitted');
}
?>

<form id="login" name="newuser" method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">

    <input type="hidden" name="mode" value="newuser">

                <p id="formr">Name:</p>
                <input class="field"  type="text" name="user_name"placeholder="Displayed to others" />

                   <p id="formr">E-Mail:</p>
                 <input class="field" type="text" name="user" placeholder="Use to log in" />

                   <p id="formr">Password:</p>
                 <input class="field" type="password" name="pwd" placeholder="Your password" />


                   <p id="formr">Retype:</p>
                 <input class="field" type="password" name="retype" placeholder="Retype password" />


                 <div id="subbutton"><input type="submit" value="Register"></div>

        </tfoot>
    </table>
</form>
