<?php

// pMachine needs this file in order to communicate with your web pages.  
// One copy of this file must remain in EVERY directory containing pMachine 
// enabled pages.
	
// Name of your main script ("pm") directory:

	$script_directory_name = "pm";
	
// Relative path to this directory:
// The path is from the perspective of the directory containing THIS file.

	$script_directory_path = "../";
	

// ----------------------------------------------------------
// 			DO NOT EDIT BEYOND THIS POINT
// ----------------------------------------------------------

$pm_path = $script_directory_path . $script_directory_name;

if (!eregi('/$',$pm_path)) 
	$pm_path = "$pm_path"."/";

if (!include("{$pm_path}inc.sfx.inc"))
{
	echo "The information is set incorrectly in the following file: \"pm_inc.php\"<br />";
	echo "Please open \"pm_inc.php\" with a text editor and correct the path.<br />";
	echo "You'll find instructions located inside that file";
	exit;
}
    include ("{$pm_path}inc.lib$sfx");

//END
?>