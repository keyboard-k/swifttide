<?php
	//This file contains all the function needed to other files to function properly
	
	//following function goes through the language files and prints the translation
	//if second parameter is true return the translation instead of printing
	function _($string, $return=false)
	{
		global $E; //get the global $E variable inside function
		//if the culture is set and also we have file for it!
		require($E['path'] . '+culture/' . $E['default_culture'] . '/language.cu.php');
		if(isset($E['culture']) && is_file($E['path'] . '+culture/'. $E['culture'] . '/language.cu.php'))
		{
			require($E['path'] . '+culture/' . $E['culture'] . '/language.cu.php');
		}
		//note that we first load the deafult language and then chosen language, therefore
		//say we have to translate 'sample_string', if second language has a the variable $EC['sample_string'] it will simply overwrite the $EC['sample_string'] variable of default language
		//otherwise we'll use default language's
		if(isset($EC[$string]))
			$t_string = $EC[$string];
		else
			$t_string = $string; //we do not have translation for this string use it only
		
		if($return == true)
			return $t_string;
		else
			print $t_string;
	}
			
			
?>