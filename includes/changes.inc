<?php

$new_emp_name = $emp_name;

if ($old_emp_name <> $new_emp_name) {

	if(strlen($old_emp_name) < '1') { $old_emp_name = 'none'; }
	if(strlen($new_emp_name) < '1') { $new_emp_name = 'none'; }

	print "Name changed from <b>$old_emp_name</b> to <b>$new_emp_name</b><br>";
}

$new_emp_email = $emp_email;

if ($old_emp_email <> $new_emp_email) {

	if(strlen($old_emp_email) < '1') { $old_emp_email = 'none'; }
	if(strlen($new_emp_email) < '1') { $new_emp_email = 'none'; }

	print "Email changed from <b>$old_emp_email</b> to <b>$new_emp_email</b><br>";
}

$new_emp_title = $emp_title;

if ($old_emp_title <> $new_emp_title) {

	if(strlen($old_emp_title) < '1') { $old_emp_title = 'none'; }
	if(strlen($new_emp_title) < '1') { $new_emp_title = 'none'; }

	print "Title changed from <b>$old_emp_title</b> to <b>$new_emp_title</b><br>";
}

$new_emp_group = $emp_group;

if ($old_emp_group <> $new_emp_group) {

	if(strlen($old_emp_group) < '1') { $old_emp_group = 'none'; }
	if(strlen($new_emp_group) < '1') { $new_emp_group = 'none'; }

	print "Group changed from <b>$old_emp_group</b> to <b>$new_emp_group</b><br>";
}

$new_emp_address = $emp_address;

if ($old_emp_address <> $new_emp_address) {

	if(strlen($old_emp_address) < '1') { $old_emp_address = 'none'; }
	if(strlen($new_emp_address) < '1') { $new_emp_address = 'none'; }

	print "Address changed from <b>$old_emp_address</b> to <b>$new_emp_address</b><br>";
}

$new_emp_phone_hm = $emp_phone_hm;

if ($old_emp_phone_hm <> $new_emp_phone_hm) {

	if(strlen($old_emp_phone_hm) < '1') { $old_emp_phone_hm = 'none'; }
	if(strlen($new_emp_phone_hm) < '1') { $new_emp_phone_hm = 'none'; }

	print "Home Phone changed from <b>$old_emp_phone_hm</b> to <b>$new_emp_phone_hm</b><br>";
}

$new_emp_phone_cell = $emp_phone_cell;

if ($old_emp_phone_cell <> $new_emp_phone_cell) {

	if(strlen($old_emp_phone_cell) < '1') { $old_emp_phone_cell = 'none'; }
	if(strlen($new_emp_phone_cell) < '1') { $new_emp_phone_cell = 'none'; }

	print "Cell Phone changed from <b>$old_emp_phone_cell</b> to <b>$new_emp_phone_cell</b><br>";
}

$new_emp_notes = $emp_notes;

if ($old_emp_notes <> $new_emp_notes) {

	if(strlen($old_emp_notes) < '1') { $old_emp_notes = 'none'; }
	if(strlen($new_emp_notes) < '1') { $new_emp_notes = 'none'; }

	print "Notes changed from <b>$old_emp_notes</b> to <b>$new_emp_notes</b><br>";
}

$new_auth_level = $auth_level;

if ($old_auth_level <> $new_auth_level) {

	if(strlen($old_auth_level) < '1') { $old_auth_level = 'none'; }
	if(strlen($new_auth_level) < '1') { $new_auth_level = 'none'; }

	print "Auth Level changed from <b>$old_auth_level</b> to <b>$new_auth_level</b><br>";
}

$new_proj_name = $proj_name2;

if ($old_proj_name2 <> $new_proj_name) {

	if(strlen($old_proj_name2) < '1') { $old_proj_name = 'none'; }
	if(strlen($new_proj_name) < '1') { $new_proj_name = 'none'; }

	print "Name changed from <b>$old_proj_name2</b> to <b>$new_proj_name</b><br>";
}

$new_proj_status = $proj_status;

if ($old_proj_status <> $new_proj_status) {

	if(strlen($old_proj_status) < '1') { $old_proj_status = 'none'; }
	if(strlen($new_proj_status) < '1') { $new_proj_status = 'none'; }

	print "Status changed from <b>$old_proj_status</b> to <b>$new_proj_status</b><br>";
}

$new_proj_due_dt = $proj_due_dt;

if ($old_proj_due_dt <> $new_proj_due_dt) {

	if($old_proj_due_dt == '12/31/2010') { $old_proj_due_dt = 'none'; }
	if($new_proj_due_dt == '12/31/2010') { $new_proj_due_dt = 'none'; }

	print "Due Date changed from <b>$old_proj_due_dt</b> to <b>$new_proj_due_dt</b><br>";
}

$new_proj_priority = $proj_priority;

if ($old_proj_priority <> $new_proj_priority) {

	if(strlen($old_proj_priority) < '1') { $old_proj_priority = 'none'; }
	if(strlen($new_proj_priority) < '1') { $new_proj_priority = 'none'; }

	print "Priority changed from <b>$old_proj_priority</b> to <b>$new_proj_priority</b><br>";
}

$new_proj_assignee = $proj_assignee;

if ($old_proj_assignee <> $new_proj_assignee) {

	if(strlen($old_proj_assignee) < '1') { $old_proj_assignee = 'none'; }
	if(strlen($new_proj_assignee) < '1') { $new_proj_assignee = 'none'; }

	print "Assignee changed from <b>$old_proj_assignee</b> to <b>$new_proj_assignee</b><br>";
}

$new_proj_type = $proj_type;

if ($old_proj_type <> $new_proj_type) {

	if(strlen($old_proj_type) < '1') { $old_proj_type = 'none'; }
	if(strlen($new_proj_type) < '1') { $new_proj_type = 'none'; }

	print "Type changed from <b>$old_proj_type</b> to <b>$new_proj_type</b><br>";
}

if ($old_parent_id <> $new_parent_id) {

	if($old_parent_id < '1') { $old_parent_id = 'none'; }
	if($new_parent_id < '1') { $new_parent_id = 'none'; }

	print "Parent ID changed from <b>$old_parent_id</b> to <b>$new_parent_id</b><br>";
}

print "<p>";

?>