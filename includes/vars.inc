<?php

/* declare some relevant variables */
require 'db_info.inc';

$emp_id = $_REQUEST['emp_id'];
$emp_name = $_REQUEST['emp_name'];
$emp_email = $_REQUEST['emp_email'];
$emp_title = $_REQUEST['emp_title'];
$emp_group = $_REQUEST['emp_group'];
$emp_phone_hm = $_REQUEST['emp_phone_hm'];
$emp_phone_cell = $_REQUEST['emp_phone_cell'];
$emp_notes = $_REQUEST['emp_notes'];
$emp_login = $_REQUEST['emp_login'];
$emp_address = $_REQUEST['emp_address'];

$proj_id = $_REQUEST['proj_id'];
$proj_name = $_REQUEST['proj_name'];
$proj_submitter = $_REQUEST['proj_submitter'];
$proj_create_dt = $_REQUEST['proj_create_dt'];
$proj_status = $_REQUEST['proj_status'];
$proj_type = $_REQUEST['proj_type'];
$proj_desc = $_REQUEST['proj_desc'];
$proj_notes = $_REQUEST['proj_notes'];
$proj_assignee = $_REQUEST['proj_assignee'];
$proj_priority = $_REQUEST['proj_priority'];
$proj_update_dt = $_REQUEST['proj_update_dt'];
$proj_due_dt = $_REQUEST['proj_due_dt'];

$old_emp_name = $_REQUEST['old_emp_name'];
$old_emp_email = $_REQUEST['old_emp_email'];
$old_emp_title = $_REQUEST['old_emp_title'];
$old_emp_group = $_REQUEST['old_emp_group'];
$old_emp_address = $_REQUEST['old_emp_address'];
$old_emp_phone_hm = $_REQUEST['old_emp_phone_hm'];
$old_emp_phone_cell = $_REQUEST['old_emp_phone_cell'];
$old_emp_notes = $_REQUEST['old_emp_notes'];

$old_proj_name = $_REQUEST['old_proj_name'];
$old_proj_priority = $_REQUEST['old_proj_priority'];
$old_proj_status = $_REQUEST['old_proj_status'];
$old_proj_due_dt = $_REQUEST['old_proj_due_dt'];
$old_proj_assignee = $_REQUEST['old_proj_assignee'];
$old_proj_type = $_REQUEST['old_proj_type'];
$old_parent_id = $_REQUEST['old_parent_id'];
$old_auth_level = $_REQUEST['old_auth_level'];
$old_proj_notes = $_REQUEST['$old_proj_notes'];

$proj_name3 = stripslashes($proj_name);
$proj_name2 = htmlentities(stripslashes($proj_name));
$old_proj_name2 = htmlentities(stripslashes($old_proj_name));
$proj_desc2 = htmlentities(stripslashes($proj_desc));
$proj_notes2 = htmlentities(stripslashes($proj_notes));

$parent_id = $_REQUEST['parent_id'];
$type = $_REQUEST['type'];
$group = $_REQUEST['group'];
$cc_list = $_REQUEST['cc_list'];
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$more = $_REQUEST['more'];
$help = $_REQUEST['help'];
$helpindex = $_REQUEST['helpindex'];
$today = date("Y-m-d H:i:s"); 
$due_date = $_REQUEST['due_date'];
$view = $_REQUEST['view'];
$assignee = $_REQUEST['assignee'];
$month = $_REQUEST['month'];
$auth_level = $_REQUEST['auth_level'];

$m = $_REQUEST['m'];
$y = $_REQUEST['y'];
$d = $_REQUEST['d'];

?>