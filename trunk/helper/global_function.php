<?php
	
	/**
	 * a wrapper for echo() or print()
	 */
	function e($string, $return = false)
	{
		if($return)
			return $string;
		else
			echo($string);
	}

?>
