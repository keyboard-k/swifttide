<?php
	
	$m = mysql_connect($_POST['db_server'], $_POST['db_user'], $_POST['db_password']);
	mysql_select_db($_POST['db_name']) or die('Database ' . $_POST['db_name'] . ' does not exist. Please create it first.');
	
	populate_database(INST_PATH . '/database_structure.sql');
	
	//add Administrator
	mysql_query('INSERT INTO web_users SET web_users_username = "' . 
		mysql_escape_string($_POST['admin_id']) . 
		'", web_users_password = "' . 
		mysql_escape_string($_POST['admin_password']) .
		'", web_users_type = "A" ');
	
	/**
	 * Following two functions populate_database() and split_sql() were taken from Joomla!
	 * From the file /installation/installer/helper.php of release 1.5.6
	 */
	function populate_database($sqlfile)
	{
		if( !($buffer = file_get_contents($sqlfile)) )
		{
			return -1;
		}

		$queries = split_sql($buffer);

		foreach ($queries as $query)
		{
			$query = trim($query);
			if ($query != '' && $query {0} != '#')
			{
				mysql_query($query);
				if(mysql_error())
					die(mysql_error());
			}
		}
	}

	/**
	 * @param string
	 * @return array
	 */
	function split_sql($sql)
	{
		$sql = trim($sql);
		$sql = preg_replace("/\n\#[^\n]*/", '', "\n".$sql);
		$buffer = array ();
		$ret = array ();
		$in_string = false;

		for ($i = 0; $i < strlen($sql) - 1; $i ++) {
			if ($sql[$i] == ";" && !$in_string)
			{
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i +1);
				$i = 0;
			}

			if ($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\")
			{
				$in_string = false;
			}
			elseif (!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset ($buffer[0]) || $buffer[0] != "\\"))
			{
				$in_string = $sql[$i];
			}
			if (isset ($buffer[1]))
			{
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		}

		if (!empty ($sql))
		{
			$ret[] = $sql;
		}
		return ($ret);
	}

?>