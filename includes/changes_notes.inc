<?php

	$message = "Updated by ".$_SESSION['username']."\n";

$new_proj_name = $proj_name2;

if ($old_proj_name2 <> $new_proj_name) {

	if(strlen($old_proj_name2) < '1') { $old_proj_name = 'none'; }
	if(strlen($new_proj_name) < '1') { $new_proj_name = 'none'; }

	$message .= "Name changed from [ $old_proj_name ] to [ $new_proj_name ]\n";
}

$new_proj_status = $proj_status;

if ($old_proj_status <> $new_proj_status) {

	if(strlen($old_proj_status) < '1') { $old_proj_status = 'none'; }
	if(strlen($new_proj_status) < '1') { $new_proj_status = 'none'; }

	$message .= "Status changed from [ $old_proj_status ] to [ $new_proj_status ]\n";
}

$new_proj_due_dt = $proj_due_dt;

if ($old_proj_due_dt <> $new_proj_due_dt) {

	if($old_proj_due_dt == '12/31/2010') { $old_proj_due_dt = 'none'; }
	if($new_proj_due_dt == '12/31/2010') { $new_proj_due_dt = 'none'; }

	$message .= "Due Date changed from [ $old_proj_due_dt ] to [ $new_proj_due_dt ]\n";
}

$new_proj_priority = $proj_priority;

if ($old_proj_priority <> $new_proj_priority) {

	if(strlen($old_proj_priority) < '1') { $old_proj_priority = 'none'; }
	if(strlen($new_proj_priority) < '1') { $new_proj_priority = 'none'; }

	$message .= "Priority changed from [ $old_proj_priority ] to [ $new_proj_priority ]\n";
}

$new_proj_assignee = $proj_assignee;

if ($old_proj_assignee <> $new_proj_assignee) {

	if(strlen($old_proj_assignee) < '1') { $old_proj_assignee = 'none'; }
	if(strlen($new_proj_assignee) < '1') { $new_proj_assignee = 'none'; }

	$message .= "Assignee changed from [ $old_proj_assignee ] to [ $new_proj_assignee ]\n";
}

$new_proj_type = $proj_type;

if ($old_proj_type <> $new_proj_type) {

	if(strlen($old_proj_type) < '1') { $old_proj_type = 'none'; }
	if(strlen($new_proj_type) < '1') { $new_proj_type = 'none'; }

	$message .= "Type changed from [ $old_proj_type ] to [ $new_proj_type ]\n";
}

$new_parent_id = $parent_id;

if ($old_parent_id <> $new_parent_id) {

	if($old_parent_id < '1') { $old_parent_id = 'none'; }
	if($new_parent_id < '1') { $new_parent_id = 'none'; }

	$message .= "Parent ID changed from [ $old_parent_id ] to [ $new_parent_id ]\n";
}

	$message .= "\n";

?>