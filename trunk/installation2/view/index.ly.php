<?php
	$error = array();
	if($_POST)
	{
		//check admin_id
		if(empty($_POST['admin_id']))
			$error['admin_id'] = 'Please enter the Administrator ID';
		//@todo - check admin_id against regular expression
		//check password
		if(empty($_POST['admin_password']))
			$error['admin_password'] = 'Please enter the password';
		//password confirmation
		if($_POST['admin_password'] !== $_POST['admin_password_confirmation'])
			$error['admin_password_confirmation'] = 'Passwords do not match.';
		//db_server
		if(empty($_POST['db_server']))
			$error['db_server'] = 'Please enter the server name. If you are not sure, then enter <tt><b>localhost</b></tt>';
		//db_name
		if(empty($_POST['db_name']))
			$error['db_name'] = 'Please enter the database name';
		if(count($error) > 0)
		{
			function print_error($string)
			{
				print "<tr><td>&nbsp;</td><td><span style=\"color:red;font-size:12px;\">" . $string . "</span></td></tr>";
			}
		}
		else
		{
			require(INST_PATH . 'create_database.php');
			require(INST_PATH . 'create_config.php');
			//@todo - if config.php is not writeable, print the config.php code in a <textarea> and let the user manually create it.
			print("Swifttide is now installed. <a href=\"..\">Visit Homepage</a>");
			exit();
		}
	}
?>
<h1> Welcome to Swifttide installation. </h1>

<style>
	fieldset { border:none; };
</style>
<form method="post">
<fieldset> <legend>Administrator account - </legend>
	<table>
		<tr>
			<td> <label for="admin_id">Administrator ID</label> - </td>
			<td> <input type="text" name="admin_id" id="admin_id" value="<?php print $_POST['admin_id'] ?>" /> </td>
		</tr>
		<?php if($error['admin_id']) print_error($error['admin_id']); ?>
		<tr>
			<td> <label for="admin_password">Administrator password</label> - </td>
			<td> <input type="password" name="admin_password" id="admin_password" /> </td>
		</tr>
		<?php if($error['admin_password']) print_error($error['admin_password']); ?>
		<tr>
			<td> <label for="admin_password_confirmation">Retype password</label> - </td>
			<td> <input type="password" name="admin_password_confirmation" id="admin_password_confirmation" /> </td>
		</tr>
		<?php if($error['admin_password_confirmation']) print_error($error['admin_password_confirmation']); ?>
	</table>
</fieldset>

<fieldset> <legend>Database configuration</legend>
	<table>
		<tr>
			<td> <label for="db_adapter">Database adapter</label> - </td>
			<td> <select name="db_adapter" id="db_adapter"><option value="mysql">MySQL</option></select> </td>
		</tr>
		<?php if($error['db_adapter']) print_error($error['db_adapter']); ?>
		<tr>
			<td> <label for="db_server">Database server</label> - </td>
			<td> <input type="text" name="db_server" id="db_server" value="<?php print $_POST['db_server']; ?>" /> </td>
		</tr>
		<?php if($error['db_server']) print_error($error['db_server']); ?>
		<tr>
			<td> <label for="db_name">Database name</label> - </td>
			<td> <input type="text" name="db_name" id="db_name" value="<?php print $_POST['db_name']; ?>" /> </td>
		</tr>
		<?php if($error['db_name']) print_error($error['db_name']); ?>
		<tr>
			<td> <label for="db_user">Database Username</label> - </td>
			<td> <input type="text" name="db_user" id="db_user" value="<?php print $_POST['db_user']; ?>" /> </td>
		</tr>
		<?php if($error['db_user']) print_error($error['db_user']); ?>
		<tr>
			<td> <label for="db_password">Database password</label> - </td>
			<td> <input type="text" name="db_password" id="db_password" value="<?php print $_POST['db_password']; ?>" /> </td>
		</tr>
		<?php if($error['db_password']) print_error($error['db_password']); ?>
	</table>
</fieldset>

<table> <tr> <td>&nbsp;</td> <td> <input type="submit" value="Submit" /> </td> </tr> </table>

</form>

