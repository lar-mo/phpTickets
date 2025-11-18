<?php

print "
	<option value=\"MEETING\" ";
	if($theproj_type == 'MEETING') echo 'selected'; 
	print ">MEETING</option> 
	<option value=\"ADMINISTRATION\" ";
	if($theproj_type == 'ADMINISTRATION') echo 'selected'; 
	print ">ADMINISTRATION</option> 
	<option value=\"RESEARCH\" ";
	if($theproj_type == 'RESEARCH') echo 'selected'; 
	print ">RESEARCH</option> 
	<option value=\"DATA COLLECTION\" ";
	if($theproj_type == 'DATA COLLECTION') echo 'selected'; 
	print ">DATA COLLECTION</option> 
	<option value=\"SOFTWARE DEV\" ";
	if($theproj_type == 'SOFTWARE DEV') echo 'selected'; 
	print ">SOFTWARE DEV</option> 
	<option value=\"INTERNAL DEV\" ";
	if($theproj_type == 'INTERNAL DEV') echo 'selected'; 
	print ">INTERNAL DEV</option> 
	<option value=\"MAINTENANCE\" ";
	if($theproj_type == 'MAINTENANCE') echo 'selected'; 
	print ">MAINTENANCE</option> 
	<option value=\"PRODUCTION\" ";
	if($theproj_type == 'PRODUCTION') echo 'selected'; 
	print ">PRODUCTION</option> 
";

?>