
<h1> Welcome to Swifttide installation. </h1>

<form method="post">
<fieldset> <legend>Administrator account - </legend>
	<table>
		<tr>
			<td> <label for="admin_id">Administrator ID</label> - </td>
			<td> <input type="text" name="admin_id" id="admin_id" /> </td>
		</tr>
		<tr>
			<td> <label for="admin_password">Administrator password</label> - </td>
			<td> <input type="password" name="admin_password" id="admin_password" /> </td>
		</tr>
		<tr>
			<td> <label for="admin_password_confirmation">Retype password</label> - </td>
			<td> <input type="password" name="admin_password_confirmation" id="admin_password_confirmation" /> </td>
		</tr>
	</table>
</fieldset>

<fieldset> <legend>Database configuration</legend>
	<table>
		<tr>
			<td> <label for="db_adapter">Database adapter</label> - </td>
			<td> <select name="db_adapter" id="db_adapter"><option value="mysql">MySQL</option></select> </td>
		</tr>
		<tr>
			<td> <label for="db_name">Database name</label> - </td>
			<td> <input type="text" name="db_name" id="db_name" /> </td>
		</tr>
		<tr>
			<td> <label for="db_username">Database Username</label> - </td>
			<td> <input type="text" name="db_username" id="db_username" /> </td>
		</tr>
		<tr>
			<td> <label for="db_password">Database password</label> - </td>
			<td> <input type="text" name="db_password" id="db_password" /> </td>
		</tr>
	</table>
</fieldset>

<table> <tr> <td>&nbsp;</td> <td> <input type="submit" value="Submit" /> </td> </tr> </table>

</form>

